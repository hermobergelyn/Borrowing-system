<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        // Redirect to the dashboard matching the user's role
        return redirect()->route($role . '.dashboard');
    }
}