<?php

namespace Agenciafmd\Admix\Http\Controllers;

use Illuminate\Http\Request;
use Agenciafmd\Admix\Role;
use Illuminate\Support\Facades\Hash;
use Agenciafmd\Admix\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $query = QueryBuilder::for(Role::class)
            ->defaultSort('-is_active', 'name')
            ->allowedSorts($request->sort)
            ->allowedFilters((($request->filter) ? array_keys($request->get('filter')) : []));

        if ($request->is('*/trash')) {
            $query->onlyTrashed();
        }

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/admix::roles.index', $view);
    }

    public function create(Role $role)
    {
        $view['model'] = $role;

        return view('agenciafmd/admix::roles.form', $view);
    }

    public function store(RolesRequest $request)
    {
        if (Role::create($request->all())) {
            flash('Item inserido com sucesso.', 'success');
        } else {
            flash('Falha no cadastro.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }

    public function show(Role $role)
    {
        $view['model'] = $role;

        return view('agenciafmd/admix::roles.form', $view);
    }

    public function edit(Role $role)
    {
        $view['model'] = $role;

        return view('agenciafmd/admix::roles.form', $view);
    }

    public function update(Role $role, RolesRequest $request)
    {
        if ($role->update($request->all())) {
            flash('Item atualizado com sucesso.', 'success');
        } else {
            flash('Falha na atualização.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }

    public function destroy(Role $role)
    {
        if ($role->delete()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }

    public function restore($id)
    {
        $role = Role::onlyTrashed()
            ->find($id);

        if (!$role) {
            flash('Item já restaurado.', 'danger');
        } elseif ($role->restore()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }

    public function batchDestroy(Request $request)
    {
        if (Role::destroy($request->get('id', []))) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }

    public function batchRestore(Request $request)
    {
        $roles = Role::onlyTrashed()
            ->whereIn('id', $request->get('id', []))
            ->restore();

        if ($roles) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.roles.index');
    }
}
