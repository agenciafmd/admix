<?php

namespace Agenciafmd\Admix\Http\Controllers;

use Agenciafmd\Admix\Http\Requests\UsersRequest;
use Agenciafmd\Admix\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $query = QueryBuilder::for(User::class)
            ->defaultSort('-is_active', 'name')
            ->allowedSorts($request->sort)
            ->allowedFilters(array_merge((($request->filter) ? array_keys(array_diff_key($request->filter, array_flip(['id', 'is_active', 'role_id']))) : []), [
                AllowedFilter::exact('id'),
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('role_id'),
            ]));

        if ($request->is('*/trash')) {
            $query->onlyTrashed();
        }

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/admix::users.index', $view);
    }

    public function create(User $user)
    {
        $view['model'] = $user;

        return view('agenciafmd/admix::users.form', $view);
    }

    public function store(UsersRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if (User::create($data)) {
            flash('Item inserido com sucesso.', 'success');
        } else {
            flash('Falha no cadastro.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }

    public function show(User $user)
    {
        $view['model'] = $user;

        return view('agenciafmd/admix::users.form', $view);
    }

    public function edit(User $user)
    {
        $view['model'] = $user;

        return view('agenciafmd/admix::users.form', $view);
    }

    public function update(User $user, UsersRequest $request)
    {
        $data = $request->validated();
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($user->update($data)) {
            flash('Item atualizado com sucesso.', 'success');
        } else {
            flash('Falha na atualização.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()
            ->find($id);

        if (!$user) {
            flash('Item já restaurado.', 'danger');
        } elseif ($user->restore()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }

    public function batchDestroy(Request $request)
    {
        if (User::destroy($request->get('id', []))) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }

    public function batchRestore(Request $request)
    {
        $users = User::onlyTrashed()
            ->whereIn('id', $request->get('id', []))
            ->restore();

        if ($users) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.users.index');
    }
}
