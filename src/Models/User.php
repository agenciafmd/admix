<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Database\Factories\UserFactory;
use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Components\Traits\InteractsWithMediaUploads;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, WithScopes;

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
    ];

    public array $mappedMedia = [
        'avatar' => [
            'single' => true,
            'rules' => [
                'bail', /* usar até o livewire 3, porque a implementação do dimensions funciona somente nele */
                'max:5120',
                'image',
                'dimensions:min_width=400,min_height=400',
            ],
        ],
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('type', static function (Builder $builder) {
            $builder->where($builder->getModel()
                    ->getTable() . '.type', 'admix');
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
            get: fn () => !(isset($this->attributes['role_id'])
                && $this->attributes['role_id']),
        );
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    protected static function newFactory(): UserFactory
    {
        if (class_exists(\Database\Factories\UserFactory::class)) {
            return \Database\Factories\UserFactory::new();
        }

        return UserFactory::new();
    }
}
