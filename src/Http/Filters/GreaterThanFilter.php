<?php

namespace Agenciafmd\Admix\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GreaterThanFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        return $query->where(substr($property, 0, -3), '>=', $value);
    }
}