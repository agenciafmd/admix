<?php

namespace Agenciafmd\Admix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Agenciafmd\Admix\Http\Requests\ProfilesRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $view['user'] = auth('admix-web')->user();

        return view('agenciafmd/admix::pages.profile', $view);
    }

    public function update(ProfilesRequest $request)
    {
        $data = $request->validated();
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user = auth('admix-web')->user();

        if ($user->update($data)) {
            flash('Item atualizado com sucesso', 'success');
        } else {
            flash('Falha na atualização', 'danger');
        }

        return redirect()->route('admix.profile');
    }
}
