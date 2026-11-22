<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        $role = strtolower(trim((string) Auth::user()->role));

        return match ($role) {
            'admin', 'administrator' => redirect()->route('admin.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            'staff', 'pe_instructor', 'pe instructor' => redirect()->route('staff.dashboard'),
            default => abort(403, 'The account does not have a supported role.'),
        };
    }
}
