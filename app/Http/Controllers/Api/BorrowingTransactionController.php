<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BorrowingTransactionController extends Controller
{
    /**
     * READ: Kuhaa ang tanang transaksiyon sa paghulam.
     */
    public function index()
    {
        $transactions = Borrowing::with(['user', 'equipment'])->latest()->get();
        
        return response()->json([
            'success' => true,
            'data' => $transactions
        ], 200);
    }

    /**
     * CREATE: Pagdugang og bag-ong borrowing transaction gamit ang Postman.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'equipment_id' => 'required|integer|exists:equipment,id',
            'quantity' => 'required|integer|min:1',
            'borrowed_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrowed_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction = null;

        try {
            DB::transaction(function () use ($request, &$transaction) {
                $item = Equipment::lockForUpdate()->findOrFail($request->equipment_id);

                // Suriin kung sapat pa ang available stock
                if ($item->available_quantity < $request->quantity) {
                    abort(422, "Only {$item->available_quantity} unit(s) of {$item->name} available.");
                }

                // Bawasan ang stock ng equipment
                $item->decrement('available_quantity', $request->quantity);

                // I-save gamit ang Borrowing model para lumabas din sa Web UI
                $transaction = Borrowing::create([
                    'user_id' => $request->user_id,
                    'equipment_id' => $request->equipment_id,
                    'quantity' => $request->quantity,
                    'borrowed_date' => $request->borrowed_date,
                    'due_date' => $request->due_date,
                    'status' => 'borrowed', // Lowercase para sakto sa web view
                    'borrowed_at' => now(),
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Borrowing transaction created successfully.',
            'data' => $transaction->load(['user', 'equipment'])
        ], 201);
    }

    /**
     * READ: Kuhaa ang usa ka piho nga transaksiyon gamit ang ID.
     */
    public function show($id)
    {
        $transaction = Borrowing::with(['user', 'equipment'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ], 200);
    }

    /**
     * UPDATE: Usba ang kasamtangang transaksiyon.
     */
    public function update(Request $request, $id)
    {
        $transaction = Borrowing::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|integer',
            'equipment_id' => 'sometimes|required|integer',
            'quantity' => 'sometimes|required|integer|min:1',
            'borrowed_date' => 'sometimes|required|date',
            'due_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|string|in:borrowed,return_pending,returned,overdue',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $transaction->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Borrowing transaction updated successfully.',
            'data' => $transaction->load(['user', 'equipment'])
        ], 200);
    }

    /**
     * DELETE: Pagtangtang sa transaksiyon.
     */
    public function destroy($id)
    {
        $transaction = Borrowing::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Borrowing transaction deleted successfully.'
        ], 200);
    }
}