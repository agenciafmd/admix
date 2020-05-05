<?php

namespace Agenciafmd\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules()
    {
        $rules = [
            'is_active' => ['required', 'boolean'],
            'name' => ['required', 'max:150'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['min:6', 'same:password_confirmation'],
            'media' => ['array', 'nullable'],
        ];

        if (request()->isMethod('PUT')) {
            $rules['email'] = ['required', 'email', 'unique:users,email,' . request()->route()->user->id];
            $rules['password'] = ['nullable', 'min:6', 'same:password_confirmation'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'is_active' => 'ativo',
            'name' => 'nome',
            'password' => 'senha',
            'password_confirmation' => 'confirmação de senha',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
