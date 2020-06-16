<?php

namespace Agenciafmd\Admix\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\Filters\Filter;

class ExcludeIdsFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $value = Arr::wrap($value);

        return $query->whereNotIn('id', $value);
    }
}
