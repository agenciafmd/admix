<?php

namespace Agenciafmd\Admix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules()
    {
        return [
            'is_active' => 'required|boolean',
            'name' => 'required|max:150',
            'rules' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'is_active' => 'ativo',
            'name' => 'nome',
            'rules' => 'permissões',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
