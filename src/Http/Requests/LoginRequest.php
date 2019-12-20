<?php

namespace Agenciafmd\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'senha',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
