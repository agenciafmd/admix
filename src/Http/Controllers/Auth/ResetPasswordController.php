<?php

namespace Agenciafmd\Admix\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

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

//    public function reset(Request $request)
//    {
//        $this->validate($request, $this->rules(), $this->validationErrorMessages());
//
//        $response = $this->broker()->reset(
//            $this->credentials($request), function ($user, $password) {
//            $this->resetPassword($user, $password);
//        }
//        );
//
//        if ($response === Password::PASSWORD_RESET) {
//            return response()->json([
//                'message' => 'Senha atualizada com sucesso',
//            ]);
//        }
//
//        return response()->json(['message' => $response], 202);
//    }
//
//    protected function resetPassword($user, $password)
//    {
//        $user->forceFill([
//            'password' => bcrypt($password),
//            'remember_token' => str_random(60),
//        ])->save();
//    }

    protected function redirectTo()
    {
        return (session()->has('admix.intended')) ? session('admix.intended') : '/' . config('admix.url');
    }

    protected function guard()
    {
        return Auth::guard('admix-web');
    }
}
