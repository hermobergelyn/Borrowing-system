<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;

class StaffController extends Controller
{
    public function index()
    {
        $pendingBorrowings = Borrowing::with(['user', 'equipment'])
                                    ->where('status', 'Pending')
                                    ->get();

        $activeBorrowings = Borrowing::with(['user', 'equipment'])
                                   ->where('status', 'Approved')
                                   ->get();

        return view('staff.dashboard', compact('pendingBorrowings', 'activeBorrowings'));
    }
}