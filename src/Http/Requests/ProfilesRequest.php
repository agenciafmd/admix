<?php

namespace Agenciafmd\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilesRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules()
    {
        return [
            'name' => 'required|max:150',
            'email' => 'required|email|unique:users,email,' . auth('admix-web')->user()->id,
            'password' => 'nullable|min:6|same:password_confirmation',
            'media' => 'array|nullable',
        ];
    }

    public function attributes()
    {
        return [
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
