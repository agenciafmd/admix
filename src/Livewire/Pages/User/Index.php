<?php

namespace Agenciafmd\Admix\Livewire\Pages\User;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Index extends BaseIndex
{
    protected $model = User::class;

    protected string $indexRoute = 'admix.users.index';

    protected string $trashRoute = 'admix.users.trash';

    protected string $creteRoute = 'admix.users.create';

    protected string $editRoute = 'admix.users.edit';

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
                    $builder->where($builder->qualifyColumn('email'), 'like', "%{$value}%");
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
