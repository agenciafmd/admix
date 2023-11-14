<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Components\Traits\WithMediaUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Redirector;

class MyAccount extends Component
{
    use WithMediaUploads;

    public User $model;
//    public array $media = [];
//
    protected $listeners = [
        'deleteMedia' => 'deleteMedia',
    ];

    public function mount(): void
    {
//        $this->listeners = array_merge($this->listeners, [
//            'refreshPlugins' => '$refresh',
//        ]);
//
//        dd($this->listeners);

        $this->model = Auth::guard('admix-web')
            ->user();

//        dd($this->model->media->where('collection_name', 'avatara'));

//        dd($this->model->attach['avatar']);

        $this->media = $this->model->loadMappedMedia();
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
            'model.name' => [
                'required',
                'max:255',
            ],
            'model.email' => [
                'required',
//                Rule::unique('users', 'email')
//                    ->where(fn(Builder $query) => $query->where('users.type', $this->model->type))
//                    ->ignore($this->model->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'model.can_notify' => [
                'boolean',
            ],
//            'media.avatar' => [
//                'nullable',
//                'image',
//                'max:5120',
//            ],
        ];

        return array_merge($rules, $this->model->loadMappedMediaRules($this->media));
//
//        collect($this->model->mappedMedia)->each(function ($media, $collection) use (&$rules) {
//            $this->media[$collection] instanceof TemporaryUploadedFile
//                ? $rules["media.{$collection}"] = $media['rules']
//                : $rules["media.{$collection}"] = [
//                'nullable',
//                'array',
//            ];
//        });
//
//        return $rules;
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
            if ($this->model->save()) {
                $this->model->syncMedia($this->media);

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
    }
}
