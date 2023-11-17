<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Http\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Index extends BaseIndex
{
    protected $model = User::class;
    protected string $indexRoute = 'admix.user.index';
    protected string $trashRoute = 'admix.user.trash';
    protected string $creteRoute = 'admix.user.create';
    protected string $editRoute = 'admix.user.edit';

    public function configure(): void
    {
        $this->packageName = __(config('admix.user.name'));

        parent::configure();
    }

    public function filters(): array
    {
        $this->setAdditionalFilters([
            TextFilter::make(__('admix::fields.email'), 'email')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.email', 'LIKE', "%{$value}%");
                }),
        ]);

        return parent::filters();
    }

    public function columns(): array
    {
        $this->setAdditionalColumns([
            Column::make(__('admix::fields.email'), 'email')
                ->sortable()
                ->searchable(),
        ]);

        return parent::columns();
    }
}