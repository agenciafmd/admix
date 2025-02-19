<?php

namespace Agenciafmd\Admix\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithScopes
{
    public function scopeIsActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    public function scopeSort(Builder $query): void
    {
        $defaultSort = $this->defaultSort ?? [
            'is_active' => 'desc',
            'name' => 'asc',
        ];

        foreach ($defaultSort as $field => $direction) {
            if ($field === 'sort') {
                // https://www.designcise.com/web/tutorial/how-to-order-null-values-first-or-last-in-mysql#sort-in-ascending-order-with-null-values-last
                $query->orderByRaw($query->qualifyColumn('-sort') . ' DESC');
            } else {
                $query->orderBy($query->qualifyColumn($field), $direction);
            }
        }
    }
}
