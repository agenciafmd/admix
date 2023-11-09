<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MyAccount extends Component
{
    use WithFileUploads;

    public User $user;
    public array $media;

    public function mount(): void
    {
        $this->user = Auth::guard('admix-web')
            ->user();
//        $this->media['avatar'] = $this->user->getFirstMedia('avatar')
//            ?->toArray();
    }

    public function render(): View
    {
        return view('admix::pages.profile.my-account')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }

    public function updated(mixed $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function rules(): array
    {
        $rules = [
            'user.name' => [
                'required',
                'max:255',
            ],
            'user.email' => [
                'required',
                Rule::unique('users', 'email')
                    ->where(fn(Builder $query) => $query->where('type', $this->user->type))
                    ->ignore($this->user->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'user.can_notify' => [
                'boolean',
            ],
//            'media.avatar' => [
//                'nullable',
//                'image',
//                'max:5120',
//            ],
        ];

//        $this->media['avatar'] instanceof TemporaryUploadedFile
//            ? $rules['media.avatar'] = [
//            'nullable',
//            'image',
//            'max:5120',
//        ]
//            : $rules['media.avatar'] = [
//            'nullable',
//            'array',
//        ];

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'email' => __('admix::fields.email'),
            'password' => __('admix::fields.password'),
            'can_notify' => __('admix::fields.can_notify'),
            'media.avatar' => __('admix::fields.media.avatar'),
        ];
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        try {
            if ($this->user->save()) {
                $this->emit('toast', [
                    'level' => 'success',
                    'message' => __('crud.success.update'),
                ]);
            } else {
                $this->emit('toast', [
                    'level' => 'error',
                    'message' => __('crud.error.update'),
                ]);
            }
        } catch (\Exception $e) {
            $this->emit('toast', [
                'level' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }

        return null;

//        if ($this->media['avatar'] instanceof TemporaryUploadedFile) {
//            $user->clearMediaCollection('avatar')
//                ->addMedia($this->media['avatar']->getRealPath())
//                ->withResponsiveImages()
//                ->usingName($this->customNameMedia('avatar'))
//                ->usingFileName($this->customFileNameMedia('avatar'))
////            ->withCustomProperties(array_merge(['uuid' => uniqid()], $customProperties))
//                ->toMediaCollection('avatar');
//            $this->media['avatar'] = $user->getFirstMedia('avatar')
//                ->toArray();
//        }
    }

    public function removeMedia(mixed $field): void
    {
        if ($this->media[$field] instanceof TemporaryUploadedFile) {
            $this->media[$field] = null;

            return;
        }

        Media::query()
            ->where('uuid', $this->media[$field]['uuid'])
            ->first()
            ->delete();

        $this->media[$field] = null;

        return;
    }

    public function customNameMedia(string $field): string
    {
        return Str::of($this->name)
            ->slug()
            ->pipe(function (Stringable $string) use ($field) {
                return $string->toString() . '-' . $field;
            })
            ->limit(150, '');
    }

    public function customFileNameMedia(string $field): string
    {
        return $this->customNameMedia($field) . '.' . Str::of($this->media[$field]->getClientOriginalExtension())
                ->lower();
    }
}