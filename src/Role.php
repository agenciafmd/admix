<?php

namespace Agenciafmd\Admix;

//use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
//use Agenciafmd\Sortable\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
//use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends Model //implements AuditableContract
{
    use SoftDeletes; //, Sortable, Auditable;

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
        $query->where('is_active', 1)->sort();
    }
}
