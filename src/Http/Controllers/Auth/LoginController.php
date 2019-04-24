<?php

namespace Agenciafmd\Admix\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('agenciafmd/admix::auth.login');
    }

    public function logout(Request $request)
    {
//        $error = session('error');

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

//        flash(($error) ?: 'Você saiu do sistema!')->overlay();

        return redirect()->route('admix.login.form');
    }

    protected function redirectTo()
    {
        return (session()->has('admix.intended')) ? session('admix.intended') : '/' . config('admix.url');
    }

    protected function guard()
    {
        return Auth::guard('admix-web');
    }
}
