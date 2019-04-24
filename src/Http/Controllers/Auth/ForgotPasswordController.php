<?php

namespace Agenciafmd\Admix\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('agenciafmd/admix::auth.recover');
    }

    public function broker()
    {
        return Password::broker('admix-users');
    }

//    public function redirectPath()
//    {
//        return '/' . config('admin.url');
//    }

    protected function redirectTo()
    {
        return '/' . config('admix.url');
    }
}
