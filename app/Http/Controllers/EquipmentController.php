<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $equipments = Equipment::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.equipment.index', compact(
            'equipments',
            'search'
        ));
    }

    public function create()
    {
        return view('admin.equipment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:1',
        ]);

        Equipment::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'total_quantity' => $validated['total_quantity'],
            'available_quantity' => $validated['total_quantity'],
        ]);

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment added successfully.');
    }

    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:1',
        ]);

        // Calculate how many units are currently borrowed
        $borrowedQuantity =
            $equipment->total_quantity - $equipment->available_quantity;

        // Do not allow total stock to become lower
        // than the number of currently borrowed units
        if ($validated['total_quantity'] < $borrowedQuantity) {
            return back()
                ->withInput()
                ->withErrors([
                    'total_quantity' =>
                        "Total quantity cannot be lower than {$borrowedQuantity} because some units are currently borrowed."
                ]);
        }

        // Calculate new available stock
        $newAvailableQuantity =
            $validated['total_quantity'] - $borrowedQuantity;

        $equipment->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'total_quantity' => $validated['total_quantity'],
            'available_quantity' => $newAvailableQuantity,
        ]);

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $equipment)
    {
        if ($equipment->borrowings()->exists()) {
            return redirect()
                ->route('equipment.index')
                ->with(
                    'error',
                    'This equipment cannot be deleted because it has borrowing records.'
                );
        }

        $equipment->delete();

        return redirect()
            ->route('equipment.index')
            ->with('success', 'Equipment deleted successfully.');
    }
}