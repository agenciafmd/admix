<?php

namespace Agenciafmd\Admix\Http\Filters;

use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GreaterThanFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {
        try {
            $value = Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
        } catch (\Exception $e) {
            //
        }

        return $query->where(substr($property, 0, -3), '>=', $value);
    }
}