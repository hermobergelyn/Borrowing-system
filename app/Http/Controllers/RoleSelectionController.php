<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoleSelectionController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        // Kung tapos na sa role at profile setup, diretso na sa dashboard
        if ($user && filled($user->role) && filled($user->profile_completed_at ?? null)) {
            return redirect()->route('dashboard');
        }

        // Kung may role na pero hindi pa tapos mag-set up ng profile
        if ($user && filled($user->role) && empty($user->profile_completed_at ?? null)) {
            return redirect()->route('profile.complete');
        }

        return view('auth.select-role', [
            'user' => $user,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'role' => ['required', 'string', Rule::in(['student', 'pe_instructor'])],
        ]);

        $user->forceFill([
            'role' => $validated['role'],
        ])->save();

        // Pagkatapos pumili ng role at mag-Continue, pupunta muna sa profile setup
        return redirect()->route('profile.complete');
    }
}
