<?php

namespace Agenciafmd\Admix\Http\Controllers;

use Agenciafmd\Admix\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Agenciafmd\Admix\User;
use Spatie\QueryBuilder\QueryBuilder;
#use Agenciafmd\Admix\Http\Resources\AuditResource;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Audit::class)
            ->defaultSort('-created_at')
            ->allowedFilters((($request->filter) ? array_keys($request->get('filter')) : []));

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/admix::audit.index', $view);
    }
}
