<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\TemporaryUploadedFile;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, AuditableContract
{
    use SoftDeletes, HasFactory, Notifiable, InteractsWithMedia, Auditable;

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
            $builder->where('users.type', 'admix');
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

    //------------------------------------------------------------------------------------------------------------------

    public function registerMediaCollections(): void
    {
        collect($this->mappedMedia)->each(function ($media, $collection) {
            $mediaCollection = $this->addMediaCollection($collection)
                ->withResponsiveImages();
            if ($media['single']) {
                $mediaCollection->singleFile();
            }
            if (in_array('image', $media['rules'], true)) {
                $mediaCollection->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);
            }
        });
    }

    public function attachMedia(string $file, string $collection = 'image', array $customProperties = []): void
    {
        $name = $this->defaultMediaName();
        $fileName = $name . '.' . Str::of(pathinfo($file)['extension'])
                ->lower();
        $contents = Storage::get($file);

        $this->addMediaFromString($contents)
            ->usingName($name)
            ->usingFileName($fileName)
            ->withCustomProperties(array_merge(['uuid' => Str::orderedUuid()], $customProperties))
            ->toMediaCollection($collection);
    }

    public function syncMedia(array $media): void
    {
        collect($media)->each(function ($file, $collection) {
            if ($file instanceof TemporaryUploadedFile) {
                $file = $file->store('tmp');
            }

            if (is_string($file)) {
                $this->attachMedia($file, $collection);
            }
        });
    }

    public function defaultMediaName(): string
    {
        return Str::of($this->attributes['name'])
                ->slug()
                ->limit(100, '')
                ->toString() . '-' . date('YmdHisv');
    }

    public function loadMappedMedia(): array
    {
        $media = [];
        collect($this->mappedMedia)->each(function ($file, $collection) use (&$media) {
            if ($file['single']) {
                $media[$collection] = $this->getFirstMedia($collection);
            } else {
                $media[$collection] = $this->getMedia($collection);
            }
        });

        return $media;
    }

    public function loadMappedMediaRules(mixed $media): array
    {
        $rules = [];
        collect($this->mappedMedia)->each(function ($mappedMedia, $collection) use ($media, &$rules) {
            $media[$collection] instanceof TemporaryUploadedFile
                ? $rules["media.{$collection}"] = $mappedMedia['rules']
                : $rules["media.{$collection}"] = [
                'nullable',
                'array',
            ];
        });

        return $rules;
    }

    protected function attach(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->loadMappedMedia(),
        );
    }
}
