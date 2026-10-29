<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        // Weather API Integration Variables
        $weatherData = null;
        $errorMessage = null;

        try {
            $apiUrl = config('services.weather.url', 'https://api.openweathermap.org/data/2.5/weather');
            $city = config('services.weather.city', 'Arakan');
            $apiKey = config('services.weather.key');

            if (empty($apiKey)) {
                throw new \Exception("Missing API Key in configuration or .env file.");
            }

            // Ginamit ang 'Arakan,PH' para masigurong mahanap ng OpenWeatherMap ang tamang siyudad sa Pilipinas
            $response = Http::timeout(5)->withoutVerifying()->get($apiUrl, [
                'q' => $city . ',PH', 
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $weatherData = [
                    'city'        => $data['name'] ?? $city,
                    'temperature' => $data['main']['temp'] ?? 0,
                    'description' => ucfirst($data['weather'][0]['description'] ?? 'N/A'),
                    'humidity'    => $data['main']['humidity'] ?? 0,
                    'wind_speed'  => isset($data['wind']['speed']) ? round($data['wind']['speed'] * 3.6, 1) : 0,
                ];
            } else {
                $errorBody = $response->json();
                $errorMessage = 'API Error: ' . ($errorBody['message'] ?? 'Failed to retrieve weather data.') . ' (Code: ' . $response->status() . ')';
            }
        } catch (ConnectionException $e) {
            $errorMessage = 'Connection timeout: The weather service is currently unreachable.';
        } catch (\Exception $e) {
            $errorMessage = 'Error: ' . $e->getMessage();
        }

        return view('admin.dashboard', compact('users', 'weatherData', 'errorMessage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'New user added successfully!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}