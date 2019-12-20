<?php

namespace Agenciafmd\Admix\Http\Controllers\Auth;

use Agenciafmd\Admix\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function login(LoginRequest $request)
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()
            ->logout();

        $request->session()
            ->flush();

        $request->session()
            ->regenerate();

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

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ])
            ->errorBag('admix');
    }
}
