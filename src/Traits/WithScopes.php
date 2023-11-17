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
                $query->orderByRaw('ISNULL(sort), sort ASC');
            } else {
                $query->orderBy($field, $direction);
            }
        }
    }
}