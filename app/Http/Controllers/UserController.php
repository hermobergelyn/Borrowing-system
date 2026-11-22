<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in([
                    'student',
                    'staff',
                    'admin',
                ]),
            ],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['required', 'string', 'max:30'],
        ];

        if ($request->input('role') === 'student') {
            $rules['course_section'] = ['required', 'string', 'max:80'];
        } elseif ($request->input('role') === 'staff') {
            $rules['department'] = ['required', 'string', 'max:120'];
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'course_section' => $validated['course_section'] ?? null,
            'department' => $validated['department'] ?? null,
        ]);

        $identifierField = $validated['role'] === 'student' ? 'student_id' : 'employee_id';
        $identifierPrefix = $validated['role'] === 'student' ? 'STU' : 'EMP';

        $user->forceFill([
            $identifierField => sprintf('%s-%06d', $identifierPrefix, $user->getKey()),
            'profile_completed_at' => now(),
        ])->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User added successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phone' => ['required', 'string', 'max:30'],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ];

        $role = strtolower(trim($user->role));

        if ($role === 'student') {
            $rules['course_section'] = ['required', 'string', 'max:80'];
        } elseif (in_array($role, ['staff', 'pe_instructor', 'pe instructor'], true)) {
            $rules['department'] = ['required', 'string', 'max:120'];
        }

        $validated = $request->validate($rules);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->gender = $validated['gender'];
        $user->phone = $validated['phone'];

        if ($role === 'student') {
            $user->course_section = $validated['course_section'];
        } elseif (in_array($role, ['staff', 'pe_instructor', 'pe instructor'], true)) {
            $user->department = $validated['department'];
        }

        if (! empty($validated['password'])) {
            $user->password = Hash::make(
                $validated['password']
            );
        }

        $identifierField = $role === 'student' ? 'student_id' : 'employee_id';
        $identifierPrefix = $role === 'student' ? 'STU' : 'EMP';

        if (blank($user->{$identifierField})) {
            $user->forceFill([
                $identifierField => sprintf('%s-%06d', $identifierPrefix, $user->getKey()),
            ]);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
