<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Admix\Traits\WithModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MyAccount extends Component
{
    use WithFileUploads;

    public $user;
    public string $name;
    public string $email;
    public bool $can_notify;
    public array $media;

    public function mount()
    {
        $this->user = Auth::guard('admix-web')
            ->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->can_notify = $this->user->can_notify;
        $this->media['avatar'] = $this->user->getFirstMedia('avatar')
            ?->toArray();
    }

    public function render(): View
    {
        return view('admix::pages.profile.my-account')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
            ],
            'can_notify' => [
                'boolean',
            ],
//            'media.avatar' => [
//                'nullable',
//                'image',
//                'max:5120',
//            ],
        ];

        $this->media['avatar'] instanceof TemporaryUploadedFile
            ? $rules['media.avatar'] = [
                'nullable',
                'image',
                'max:5120',
            ]
            : $rules['media.avatar'] = [
                'nullable',
                'array',
            ];

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
        $user = Auth::guard('admix-web')
            ->user();
        $user->update($data);

        if ($this->media['avatar'] instanceof TemporaryUploadedFile) {
            $user->clearMediaCollection('avatar')
                ->addMedia($this->media['avatar']->getRealPath())
                ->withResponsiveImages()
                ->usingName($this->customNameMedia('avatar'))
                ->usingFileName($this->customFileNameMedia('avatar'))
//            ->withCustomProperties(array_merge(['uuid' => uniqid()], $customProperties))
                ->toMediaCollection('avatar');
            $this->media['avatar'] = $user->getFirstMedia('avatar')
                ->toArray();
        }

        $this->emit('toast', [
            'level' => 'success',
            'message' => __('crud.success.update'),
        ]);

        return null;
    }

    public function removeMedia($field)
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

    public function customNameMedia(string $field)
    {
        return Str::of($this->name)
            ->slug()
            ->pipe(function (Stringable $string) use ($field) {
                return $string . '-' . $field;
            })
            ->limit(150, '');
    }

    public function customFileNameMedia(string $field)
    {
        return $this->customNameMedia($field) . '.' . Str::of($this->media[$field]->getClientOriginalExtension())
                ->lower();
    }
}
