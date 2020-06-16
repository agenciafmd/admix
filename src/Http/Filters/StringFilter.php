<?php

namespace Agenciafmd\Admix\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class StringFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        return $query->where(function ($subQuery) use ($value) {
            $subQuery->where('id', 'LIKE', '%' . $value . '%')
                ->orWhere('name', 'LIKE', '%' . $value . '%');
        });
    }
}
