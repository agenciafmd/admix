<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Components\LaravelLivewireTables\Columns\DeleteColumn;
use Illuminate\Support\Arr;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Table extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = [
        'bulkDelete' => 'bulkDelete',
    ];

    public function configure(): void
    {
//        $this->setPaginationMethod('simple');
//        $this->setPaginationStatus(false);
        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
//            'before-tools' => 'path.to.my.view',
//            'toolbar-left-start' => 'path.to.my.view',
//            'toolbar-left-end' => 'path.to.my.view',
//            'toolbar-right-start' => 'path.to.my.view',
//            'toolbar-right-end' => 'path.to.my.view',
            'before-toolbar' => 'admix::vendor.livewire-tables.before-toolbar',
            'after-toolbar' => 'admix::vendor.livewire-tables.after-toolbar',
//            'before-pagination' => 'path.to.my.view',
//            'after-pagination' => 'path.to.my.view',
        ]);
        $this->setTableAttributes([
            'class' => 'card-table table-vcenter text-nowrap datatable',
        ]);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'w-1',
                ];
            }

            return [];
        });
        $this->setTdAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-secondary',
                ];
            }

            return [];
        });
    }

    public function customView(): string
    {
        return 'admix-components::livewire-tables.includes.custom';
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
//            Column::make('Address', 'address.address')
//                ->sortable()
//                ->searchable()
//                ->collapseOnTablet(),

            ButtonGroupColumn::make('')
                ->excludeFromColumnSelect()
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => __('Edit'))
                        ->location(fn($row) => route('admix.user.edit', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn',
                            ];
                        }),
                    DeleteColumn::make('Delete')
                        ->title(fn($row) => __('Delete'))
                        ->location(fn($row) => $row->id)
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn',
                            ];
                        }),
                ]),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'bulkActivate' => __('Activate'),
            'bulkDeactivate' => __('Deactivate'),
            'bulkDelete' => __('Delete'),
        ];
    }

    public function bulkActivate(): void
    {
        $this->markIsActiveAs();
    }

    public function bulkDeactivate(): void
    {
        $this->markIsActiveAs(false);
    }

    public function bulkDelete(mixed $id = null): void
    {
        $id = $id ? Arr::wrap($id) : $this->getSelected();

        try {
            $model = User::query()
                ->whereIn('id', $id)
                ->get()->each->delete();

            if ($model->count()) {
                $this->emit('toast', [
                    'level' => 'success',
                    'message' => __('crud.success.delete'),
                ]);
            } else {
                $this->emit('toast', [
                    'level' => 'error',
                    'message' => __('crud.error.delete'),
                ]);
            }
        } catch (\Exception $e) {
            $this->emit('toast', [
                'level' => 'danger',
                'message' => $e->getMessage(),
            ]);
        }

        $this->clearSelected();
    }

    private function markIsActiveAs(bool $flag = true): void
    {
        try {
            $model = User::query()
                ->whereIn('id', $this->getSelected())
                ->get()->each->update(['is_active' => $flag]);

            if ($model->count()) {
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

        $this->clearSelected();
    }
}