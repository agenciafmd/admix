<?php

namespace Agenciafmd\Admix\Traits;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Traits that eases the use of ORDER BY FIELD with an eloquent model.
 * https://github.com/laravel/ideas/issues/1066
 * https://gist.github.com/andreshg112/b359089878bdb2269321838d8921f429
 */

trait OrderByField
{
    /**
     * Scope orderByField(string $field, array $values).
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string $field
     * @param mixed $values
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOrderByField($query, string $field, $values)
    {
        if ($values instanceof Arrayable) {
            $values = $values->toArray();
        }

        if (empty($values)) {
            return $query;
        }

        $placeholders = implode(', ', array_fill(0, count($values), '?'));

        return $query->orderByRaw("FIELD({$field}, {$placeholders})", $values);
    }
}