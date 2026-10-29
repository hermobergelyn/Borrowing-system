<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Borrowing;

class StudentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::where('available_quantity', '>', 0)->get();
        $myBorrowings = Borrowing::with('equipment')
                                 ->where('user_id', auth()->id())
                                 ->latest()
                                 ->get();

        return view('student.dashboard', compact('equipments', 'myBorrowings'));
    }
}