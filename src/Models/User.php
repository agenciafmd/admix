<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Database\Factories\UserFactory;
use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Ui\Casts\AsMediaLibrary;
use Agenciafmd\Ui\Casts\AsSingleMediaLibrary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements AuditableContract, HasMedia
{
    use Auditable, HasFactory, InteractsWithMedia, Notifiable, Prunable, SoftDeletes, WithScopes;

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
        'can_notify' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'library' => AsMediaLibrary::class,
        'avatar' => AsSingleMediaLibrary::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('type', static function (Builder $builder) {
            $builder->where($builder->qualifyColumn('type'), 'admix');
        });
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasAbility(string $ability): bool
    {
        if (!$this->role) {
            return false;
        }

        return in_array($ability, $this->role->rules, true);
    }

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn() => !(isset($this->attributes['role_id'])
                && $this->attributes['role_id']),
        );
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function prunable(): Builder
    {
        return static::where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): UserFactory|\Database\Factories\AdmixUserFactory
    {
        if (class_exists(\Database\Factories\AdmixUserFactory::class)) {
            return \Database\Factories\AdmixUserFactory::new();
        }

        return UserFactory::new();
    }
}
