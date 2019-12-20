<?php

namespace Agenciafmd\Admix\Http\Controllers;

use Agenciafmd\Admix\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Audit::class)
            ->defaultSort('-created_at')
            ->allowedSorts($request->sort)
            ->allowedFilters((($request->filter) ? array_keys($request->get('filter')) : []));

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/admix::audit.index', $view);
    }
}
