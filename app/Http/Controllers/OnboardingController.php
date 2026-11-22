<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function selectRole(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if (filled($user->role)) {
            return filled($user->profile_completed_at)
                ? redirect()->route('dashboard')
                : redirect()->route('profile.complete');
        }

        return view('auth.select-role', [
            'user' => $user,
        ]);
    }

    public function storeRole(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (filled($user->role)) {
            return filled($user->profile_completed_at)
                ? redirect()->route('dashboard')
                : redirect()->route('profile.complete');
        }

        $validated = $request->validate([
            'role' => ['required', 'in:student,pe_instructor'],
        ]);

        $role = $validated['role'];
        $identifierField = $role === 'student' ? 'student_id' : 'employee_id';
        $identifierPrefix = $role === 'student' ? 'STU' : 'EMP';
        $identifier = $user->{$identifierField};

        $user->forceFill([
            'role' => $role,
            $identifierField => filled($identifier)
                ? $identifier
                : sprintf('%s-%06d', $identifierPrefix, $user->getKey()),
        ])->save();

        return redirect()->route('profile.complete');
    }

    public function completeProfile(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if (blank($user->role)) {
            return redirect()->route('role.select');
        }

        if (filled($user->profile_completed_at)) {
            return redirect()->route('dashboard');
        }

        return view('profile.complete', [
            'user' => $user,
        ]);
    }

    public function storeProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (blank($user->role)) {
            return redirect()->route('role.select');
        }

        $rules = [];

        if (blank($user->gender)) {
            $rules['gender'] = ['required', 'in:male,female'];
        }

        if (blank($user->phone)) {
            $rules['phone'] = ['required', 'string', 'max:30'];
        }

        if ($user->role === 'pe_instructor') {
            $rules['department'] = ['required', 'string', 'max:120'];
        } else {
            $rules['course_section'] = ['required', 'string', 'max:80'];
        }

        $validated = $request->validate($rules);

        $user->forceFill([
            ...$validated,
            'profile_completed_at' => now(),
        ])->save();

        return redirect()->route('dashboard')->with('status', 'profile-completed');
    }
}
