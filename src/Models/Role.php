<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model implements AuditableContract
{
    use Auditable, Prunable, SoftDeletes, WithScopes;

    protected $guarded = [
        //
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rules' => 'array',
    ];

    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subYear());
    }
}
