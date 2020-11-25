<?php

namespace Agenciafmd\Admix\Models;

use Database\Factories\UserFactory;
use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Agenciafmd\Media\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Agenciafmd\Admix\Role;

class User extends Authenticatable implements AuditableContract, HasMedia, Searchable
{
    use Notifiable, SoftDeletes, HasFactory, Auditable, MediaTrait;

    protected $guarded = [
        'password_confirmation',
        'media',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        'type',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public $searchableType = 'Usuários';

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            "{$this->name} ({$this->email})",
            route('admix.users.edit', $this->id)
        );
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getAvatarAttribute()
    {
        $email = $this->attributes['email'];
        $md5 = md5($email); // md5 é base 16
        $base5 = base_convert($md5, 16, 5); // converte para base5, porque temos 50 avatares
        $fileName = Str::limit($base5, 2, ''); // pegamos os dois primeiros caracteres que deve ser algo entre 01 e 50
        $avatar = asset("/images/avatar-{$fileName}.svg");

        if (!app()->environment(['local', 'testing', 'develop'])) {
            $avatar = "https://unavatar.now.sh/{$email}?fallback=" . $avatar;
        }

        return $this->getFirstMediaUrl('image', 'thumb@2x') ?: $avatar;
    }

    public function hasAbility($ability)
    {
        if (!$this->role) {
            return false;
        }

        return in_array('\\' . $ability, $this->role->rules, true);
    }

    public function getIsAdminAttribute()
    {
        return (isset($this->attributes['role_id'])
            && $this->attributes['role_id']) ? false : true;
    }

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1);
    }

    public function scopeSort($query)
    {
        $sorts = default_sort([
            '-is_active',
            'name',
        ]);

        foreach ($sorts as $sort) {
            $query->orderBy($sort['field'], $sort['direction']);
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
