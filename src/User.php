<?php

namespace Agenciafmd\Admix;

use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;

class User extends Authenticatable implements AuditableContract, HasMedia
{
    use Notifiable, SoftDeletes, Auditable, HasMediaTrait, MediaTrait {
        MediaTrait::registerMediaConversions insteadof HasMediaTrait;
    }

    protected $guarded = [
        'password_confirmation', 'width', 'height', 'quality', 'crop', 'media'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token', 'type',
    ];

    protected $attributes = [
        'type' => 'admix',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('users.type', 'admix');
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasAbility($ability)
    {
        if (!$this->role) {
            return false;
        }

        return in_array('\\' . $ability, $this->role->rules, true);
    }

//    TODO: Deixar isso dinamico
//    public function getImageAttribute()
//    {
//        return $this->getFirstMedia('image');
//    }

    public function getIsAdminAttribute()
    {
        return (isset($this->attributes['role_id'])
            && $this->attributes['role_id']) ? false : true;
    }

    /*
    public function scopeSort($query, $fields = [])
    {
        if (count($fields) <= 0) {
            $fields = [
                'users.is_active' => 'asc'
            ];
        }

        if (request()->has('field') && request()->has('sort')) {
            $fields = [request()->get('field') => request()->get('sort')];
        }

        $query->select('users.*');

        foreach ($fields as $field => $order) {
            $query->orderBy($field, $order);
        }
    }
    */

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
