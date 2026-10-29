<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash; // <--- Idinagdag dito
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google Authentication page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in if account exists.
     */
    public function callback()
    {
        try {
            // Gamitin ang stateless() para maiwasan ang InvalidStateException sa local development
            $googleUser = Socialite::driver('google')->stateless()->user();

            // 1. Hanapin muna ang user sa database gamit ang google_id O email
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            // 2. KUNG WALA PA SA DATABASE (O nabura): Awtomatikong gagawa ng bagong account
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(uniqid()), // Random password dahil nag-google login sila
                    'role' => 'staff', // I-set sa default role (hal. student o user)
                ]);
            }


            // 3. Kung may nahanap na account pero wala pang nakakabit na google_id, i-update na natin ang google_id nito
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->id]);
            }

            // 4. I-login ang user sa session
            Auth::login($user);

            // 5. Suriin ang role para mailagay sa tamang dashboard
            $userRole = strtolower($user->role ?? '');

            if ($userRole === 'admin' || $userRole === 'administrator') {
                if (Route::has('admin.dashboard')) {
                    return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
                }
                return redirect('/admin/dashboard')->with('success', 'Welcome Admin!');
            }

            // Redirect para sa Student / Staff / iba pang roles
            if (Route::has('dashboard')) {
                return redirect()->route('dashboard')->with('success', 'Successfully logged in with Google!');
            }

            return redirect('/dashboard')->with('success', 'Successfully logged in with Google!');

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google. Please try again. Error: ' . $e->getMessage());
        }
    }
}