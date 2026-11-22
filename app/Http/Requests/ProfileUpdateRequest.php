<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'gender' => ['nullable', Rule::in(['male', 'female'])],
            'phone' => ['nullable', 'string', 'max:30'],
        ];

        $role = strtolower(trim($this->user()->role));

        if ($role === 'student') {
            $rules['course_section'] = ['nullable', 'string', 'max:80'];
        } elseif (in_array($role, ['staff', 'pe_instructor', 'pe instructor'], true)) {
            $rules['department'] = ['nullable', 'string', 'max:120'];
        }

        return $rules;
    }
}
