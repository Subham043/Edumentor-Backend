<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Validation\Rules\Password;


class UserUpdateRequest extends UserCreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $parentRules = parent::rules();
        return array_merge($parentRules, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->route('id'),
            'phone' => 'required|numeric|digits:10|unique:users,phone,'.$this->route('id'),
            'password' => ['nullable',
                'string',
                'required_with:password_confirmation',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
            ]
        ]);
    }
}
