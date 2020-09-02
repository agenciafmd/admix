<?php

namespace Agenciafmd\Admix\Services;

use Agenciafmd\Admix\Role;

class RoleService
{
    public function toSelect()
    {
        return Role::orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function rules()
    {
        $gate = collect(json_decode(json_encode(config('gate'))));
        $sorted = $gate->sortBy('sort');
        $rules = [];
        foreach ($sorted as $k => $groups) {
            $rules[$k]['name'] = $groups->name;
            foreach ($groups->abilities as $ability) {
                $rules[$k]['policies'][] = [
                    'name' => $ability->name,
                    'policy' => $groups->policy . '@' . $ability->method,
                ];
            }
        }

        return collect(json_decode(json_encode($rules)));
    }
}
