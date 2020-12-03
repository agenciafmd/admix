<?php

namespace Agenciafmd\Admix\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        $view['token'] = $token;
        $view['email'] = $request->email;

        return view('agenciafmd/admix::auth.reset', $view);
    }

    public function broker()
    {
        return Password::broker('admix-users');
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'O campo senha é obrigatório.',
        ];
    }

    protected function redirectTo()
    {
        return (session()->has('intended')) ? session('intended') : '/' . config('admix.url');
    }

    protected function guard()
    {
        return Auth::guard('admix-web');
    }
}
