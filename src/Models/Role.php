<?php

namespace Agenciafmd\Admix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $guarded = [
        //
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rules' => 'array',
    ];
}
