<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Profile;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Components\Traits\WithMediaUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Redirector;

class MyAccount extends Component
{
    use WithMediaUploads;

    public User $model;

    public array $media = [];

    public array $loadedMedia = []; //acho que da pra colocar no boot da trait

    public array $selectedMedia = [];

    protected $listeners = [
        'deleteMedia' => 'deleteMedia',
    ];

    public function mount(): void
    {
        $this->model = Auth::guard('admix-web')
            ->user();

        $this->loadedMedia = $this->model->loadMappedMedia(); //acho que da pra colocar no boot da trait
        $this->meta = $this->model->loadMappedMeta();
        $this->media = $this->model->initMappedMedia();
    }

    public function rules(): array
    {
        return array_merge([
            'model.name' => [
                'required',
                'max:255',
            ],
            'model.email' => [
                'required',
                Rule::unique('users', 'email')
                    ->where(fn (Builder $query) => $query->where('users.type', $this->model->type))
                    ->ignore($this->model->id ?? null),
                'email:rfc,dns',
                'max:255',
            ],
            'model.can_notify' => [
                'boolean',
            ],
        ], $this->model->loadMappedMediaRules($this->media));
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

    public function updated(mixed $field): void
    {
        $this->validateOnly($field, $this->rules(), [], $this->attributes());
    }

    public function render(): View
    {
        return view('admix::pages.profile.my-account')
            ->extends('admix::pages.profile.master')
            ->section('profile-content');
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        $data = $this->validate($this->rules(), [], $this->attributes());

        try {
            if ($this->model->save()) {

                $this->model->syncMedia($data['media'] ?? [], $data['meta'] ?? []);

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
