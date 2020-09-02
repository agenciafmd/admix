<?php

namespace Agenciafmd\Admix\Http\Controllers;

use App\Http\Controllers\Controller;

class AdmixController extends Controller
{
    public function dashboard()
    {
        if (class_exists(\Agenciafmd\Analytics\Providers\AnalyticsServiceProvider::class) && (config('analytics.view_id') !== '')) {
            return view('agenciafmd/analytics::dashboard');
        }

        return view('agenciafmd/admix::pages.dashboard');
    }

    public function offline()
    {
        return view('agenciafmd/admix::pages.offline');
    }

    public function redirect()
    {
        return redirect(route('admix.dashboard'), 301);
    }
}
