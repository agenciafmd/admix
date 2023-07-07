<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Components\LaravelLivewireTables\Columns\DeleteColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Rap2hpoutre\FastExcel\FastExcel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Table extends DataTableComponent
{
    protected $listeners = [
        'bulkDelete' => 'bulkDelete',
    ];

    public function builder(): Builder
    {
        return User::query();
    }

    public function configure(): void
    {
//        $this->setDebugStatus(true);
//        $this->setPaginationMethod('simple');
//        $this->setPaginationStatus(false);
        $this->setSortingPillsDisabled();
        $this->setFilterPillsDisabled();
        $this->setSearchVisibilityDisabled();

        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'toolbar-left-start' => 'admix::vendor.livewire-tables.toolbar-left-start',
            'before-toolbar' => 'admix::vendor.livewire-tables.before-toolbar',
            'after-toolbar' => 'admix::vendor.livewire-tables.after-toolbar',
        ]);
        $this->setTableAttributes([
            'class' => 'card-table table-vcenter text-nowrap datatable',
        ]);
        $this->setThAttributes(function (Column $column) {
            if (
                $column->isField('id') ||
                $column->isField('is_active') ||
                ($column->getField() === null)
            ) {
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

            if ($column->isField('is_active')) {
                return [
                    'align' => 'center',
                ];
            }

            return [];
        });
    }

    public function customView(): string
    {
        return 'admix-components::livewire-tables.includes.custom';
    }

    public function filters(): array
    {
        $strongTableFromBuilder = $this->builder()
            ->getModel()
            ->getTable();

        return [
            TextFilter::make(__('admix::fields.id'), 'id')
                ->config([
                    'maxlength' => '50',
                ])
                ->filter(function (Builder $builder, string $value) use ($strongTableFromBuilder) {
                    $builder->where("{$strongTableFromBuilder}.id", $value);
                }),
            SelectFilter::make(__('admix::fields.is_active'), 'is_active')
                ->options([
                    '' => __('-'),
                    'true' => __('Yes'),
                    'false' => __('No'),
                ])
                ->filter(function (Builder $builder, string $value) use ($strongTableFromBuilder) {
                    if ($value === 'true') {
                        $builder->where("{$strongTableFromBuilder}.is_active", true);
                    } else {
                        $builder->where("{$strongTableFromBuilder}.is_active", false);
                    }
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make(__('admix::fields.id'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.email'), 'email')
                ->sortable()
                ->searchable(),
//            Column::make('Address', 'address.address')
//                ->sortable()
//                ->searchable()
//                ->collapseOnTablet(),
            BooleanColumn::make(__('admix::fields.is_active'), 'is_active')
                ->setView('admix-components::livewire-tables.columns.boolean')
                ->sortable()
                ->searchable(),
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
            'bulkExport' => __('Export'),
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
            $model = $this->builder()
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

    public function bulkExport(): StreamedResponse
    {
        $builder = $this->builder();
        $selectedItems = $this->getSelected();
        $items = (static function () use ($builder, $selectedItems): \Generator {
            foreach ($builder->whereIn('id', $selectedItems)
                         ->cursor() as $item) {
                yield $item;
            }
        })();
        $this->clearSelected();

        return response()->streamDownload(function () use ($items) {
            return (new FastExcel($items)) // usa generator para diminuir o consumo de memória
            ->export('php://output', $this->fieldsToExport());
        }, sprintf('%s-%s.xlsx', date('YmdHi'), $this->builder()
            ->getModel()
            ->getTable()));
    }

    private function markIsActiveAs(bool $flag = true): void
    {
        try {
            $model = $this->builder()
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

    public function fieldsToExport(): null|\Closure
    {
        return null;
//        return static function($model) {
//            return [
//                __('admix::fields.id') => $model->id,
//                __('admix::fields.name') => $model->name,
//                __('admix::fields.email') => $model->email,
//            ];
//        };
    }
}