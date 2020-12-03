<?php

namespace Agenciafmd\Admix\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $guarded = [
        //
    ];

    protected $casts = [
        'rules' => 'object',
    ];

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1)
            ->sort();
    }
}
