<?php

namespace Agenciafmd\Admix\Http\Controllers;

use Agenciafmd\Admix\Models\Audit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Audit::class)
            ->defaultSort('-created_at')
            ->allowedSorts($request->sort)
            ->allowedFilters(array_merge((($request->filter) ? array_keys(array_diff_key($request->filter, array_flip(['id', 'user_id', 'auditable_id']))) : []), [
                AllowedFilter::exact('id'),
                AllowedFilter::exact('user_id'),
                AllowedFilter::exact('auditable_id'),
            ]));

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/admix::audit.index', $view);
    }
}
