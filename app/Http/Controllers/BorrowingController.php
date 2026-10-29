<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    /**
     * Display borrowing records.
     */
    public function index()
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role === 'admin' || $role === 'sports coordinator') {
            $borrowings = Borrowing::with(['user', 'equipment'])
                ->latest()
                ->paginate(10);
            $equipment = collect();
        } else {
            $borrowings = Borrowing::with(['user', 'equipment'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);

            $equipment = Equipment::where('available_quantity', '>', 0)->get();
        }

        return view('admin.borrowings.index', compact('borrowings', 'equipment'));
    }

    /**
     * Show the form for creating a new borrowing record (Hiwalay na page).
     */
    public function create()
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        $equipment = Equipment::where('available_quantity', '>', 0)->get();
        
        // Kunin ang mga users na puwedeng mag-borrow (students/staff) para mapagpilian kung sakaling Admin ang gumagawa
        $users = User::whereIn('role', ['student', 'staff'])->get();

        return view('admin.borrowings.create', compact('equipment', 'users'));
    }

    /**
     * Store a newly created borrowing record.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        $isAdmin = in_array($role, ['admin', 'sports coordinator'], true);
        $isStudentOrStaff = in_array($role, ['student', 'staff'], true);

        if (!$isAdmin && !$isStudentOrStaff) {
            abort(403, 'You are not authorized to borrow equipment.');
        }

        $validated = $request->validate([
            'equipment_id' => ['required', 'exists:equipment,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'user_id' => [$isAdmin ? 'required' : 'nullable', 'exists:users,id'],
            'borrowed_date' => ['nullable', 'date'],
        ]);

        // Kung Admin, ang piniling user sa dropdown ang gagamitin; kung Student/Staff, ang sarili nilang ID
        $borrowerId = $isAdmin ? $validated['user_id'] : $user->id;

        DB::transaction(function () use ($validated, $borrowerId) {
            $item = Equipment::lockForUpdate()->findOrFail($validated['equipment_id']);

            if ($item->available_quantity < $validated['quantity']) {
                abort(422, "Only {$item->available_quantity} unit(s) of {$item->name} available.");
            }

            $item->decrement('available_quantity', $validated['quantity']);

            Borrowing::create([
                'user_id' => $borrowerId,
                'equipment_id' => $item->id,
                'quantity' => $validated['quantity'],
                'status' => 'borrowed',
                'borrowed_date' => $validated['borrowed_date'] ?? now()->toDateString(),
            ]);
        });

        $redirectRoute = $isAdmin ? 'admin.borrowings.index' : 'borrowings.index';

        return redirect()->route($redirectRoute)->with('success', 'Equipment borrowed successfully.');
    }

    /**
     * Show the form for editing the specified borrowing record (Hiwalay na page).
     */
    public function edit(Borrowing $borrowing)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        // Admin lang ang pinapayagang mag-edit sa pamamagitan ng dedicated edit page
        if ($role !== 'admin' && $role !== 'sports coordinator') {
            abort(403, 'Unauthorized action.');
        }

        $equipment = Equipment::all();
        $users = User::whereIn('role', ['student', 'staff'])->get();

        return view('admin.borrowings.edit', compact('borrowing', 'equipment', 'users'));
    }

    /**
     * Update the specified borrowing record in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role !== 'admin' && $role !== 'sports coordinator') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'equipment_id' => ['required', 'exists:equipment,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'borrowed_date' => ['required', 'date'],
            'status' => ['required', 'in:borrowed,return_pending,returned'],
            'returned_at' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($validated, $borrowing) {
            $wasAlreadyReturned = ($borrowing->status === 'returned');
            $isNowReturned = ($validated['status'] === 'returned');

            // Kung binago ang equipment
            if ($borrowing->equipment_id != $validated['equipment_id']) {
                // Ibalik muna ang stock sa lumang equipment kung hindi pa ito dati returned
                if (!$wasAlreadyReturned) {
                    $borrowing->equipment->increment('available_quantity', $borrowing->quantity);
                }

                // Kunin ang bagong equipment at i-check ang stock kung hindi pa returned
                $newEquipment = Equipment::lockForUpdate()->findOrFail($validated['equipment_id']);
                
                if (!$isNowReturned) {
                    if ($newEquipment->available_quantity < $validated['quantity']) {
                        abort(422, "Not enough available stock for the selected equipment.");
                    }
                    $newEquipment->decrement('available_quantity', $validated['quantity']);
                }
            } else {
                // Kung pareho pa rin ang equipment
                $quantityDiff = $validated['quantity'] - $borrowing->quantity;

                if (!$wasAlreadyReturned && !$isNowReturned) {
                    if ($quantityDiff > 0) {
                        $equipment = $borrowing->equipment;
                        if ($equipment->available_quantity < $quantityDiff) {
                            abort(422, "Not enough available stock to increase quantity.");
                        }
                        $equipment->decrement('available_quantity', $quantityDiff);
                    } elseif ($quantityDiff < 0) {
                        $borrowing->equipment->increment('available_quantity', abs($quantityDiff));
                    }
                }
            }

            // Pag-handle ng pagbabalik o hindi ng stock base sa pagbabago ng status
            if (!$wasAlreadyReturned && $isNowReturned) {
                // Kapag naging 'returned' mula sa hindi pa returned, idagdag ang stock
                if ($borrowing->equipment_id == $validated['equipment_id']) {
                    $borrowing->equipment->increment('available_quantity', $validated['quantity']);
                }
            } elseif ($wasAlreadyReturned && !$isNowReturned) {
                // Kapag binawi mula sa 'returned' patungong 'borrowed', bawasan ulit ang stock
                $currentEquipment = Equipment::lockForUpdate()->findOrFail($validated['equipment_id']);
                if ($currentEquipment->available_quantity < $validated['quantity']) {
                    abort(422, "Not enough available stock to revert status back to borrowed.");
                }
                $currentEquipment->decrement('available_quantity', $validated['quantity']);
            }

            // Pagtukoy ng tamang returned_at value
            $resolvedReturnedAt = null;
            if ($isNowReturned) {
                $resolvedReturnedAt = $validated['returned_at'] ?? $borrowing->returned_at ?? now();
            }

            $borrowing->update([
                'user_id' => $validated['user_id'],
                'equipment_id' => $validated['equipment_id'],
                'quantity' => $validated['quantity'],
                'borrowed_date' => $validated['borrowed_date'],
                'status' => $validated['status'],
                'returned_at' => $resolvedReturnedAt,
            ]);
        });

        return redirect()->route('admin.borrowings.index')->with('success', 'Borrowing record updated successfully.');
    }

    /**
     * Remove the specified borrowing record from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role !== 'admin' && $role !== 'sports coordinator') {
            abort(403, 'Unauthorized action.');
        }

        DB::transaction(function () use ($borrowing) {
            // Kung active pa ang hiram (hindi pa returned), ibalik ang stock bago i-delete
            if ($borrowing->status !== 'returned') {
                $borrowing->equipment->increment('available_quantity', $borrowing->quantity);
            }

            $borrowing->delete();
        });

        return redirect()->route('admin.borrowings.index')->with('success', 'Borrowing record deleted successfully.');
    }

    /**
     * Student/Staff requests to return equipment.
     */
    public function requestReturn(Borrowing $borrowing)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if (!in_array($role, ['student', 'staff'], true)) {
            abort(403, 'Only Student or Staff can request an equipment return.');
        }

        if ($borrowing->user_id !== $user->id) {
            abort(403, 'You can only return your own borrowed equipment.');
        }

        if ($borrowing->status === 'returned') {
            return back()->with('error', 'This equipment has already been returned.');
        }

        if ($borrowing->status === 'return_pending') {
            return back()->with('error', 'Return request is already waiting for admin confirmation.');
        }

        $borrowing->update([
            'status' => 'return_pending',
        ]);

        return back()->with('success', 'Return request submitted. Please wait for the Sports Coordinator to confirm.');
    }

    /**
     * Admin confirms the equipment return.
     */
    public function confirmReturn(Borrowing $borrowing)
    {
        $user = auth()->user();
        $role = strtolower(trim($user->role ?? ''));

        if ($role !== 'admin' && $role !== 'sports coordinator') {
            abort(403, 'Only the Sports Coordinator/Admin can confirm equipment returns.');
        }

        if ($borrowing->status === 'returned') {
            return back()->with('error', 'This equipment has already been confirmed as returned.');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->equipment()->increment('available_quantity', $borrowing->quantity);

            $borrowing->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);
        });

        return back()->with('success', 'Equipment return confirmed successfully. Stock has been updated.');
    }
}