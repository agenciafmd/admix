<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [
        'password_confirmation',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'type',
    ];

    protected $attributes = [
        'type' => 'admix',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('type', static function (Builder $builder) {
            $builder->where('users.type', 'admix');
        });
    }

//    public function role(): BelongsTo
//    {
//        return $this->belongsTo(Role::class);
//    }

//    public function hasAbility(string $ability): bool
//    {
//        if (!$this->role) {
//            return false;
//        }
//
//        return in_array('\\' . $ability, $this->role->rules, true);
//    }

//    public function getIsAdminAttribute(): bool
//    {
//        return !(isset($this->attributes['role_id'])
//            && $this->attributes['role_id']);
//    }


    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
