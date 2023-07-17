<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Components\LaravelLivewireTables\Columns\DeleteColumn;
use Agenciafmd\Components\LaravelLivewireTables\Columns\RestoreColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\View\View;
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
    protected string $pageTitle = '';
    public bool $isTrash;

    protected $listeners = [
        'bulkDelete' => 'bulkDelete',
        'bulkRestore' => 'bulkRestore',
    ];

    public function mount(): void
    {
        $this->isTrash = request()?->is('*/trash');
    }

    public function configure(): void
    {
        if ($this->isTrash) {
            $this->pageTitle = __('Trash of ');
        }
        $this->pageTitle .= __(config('admix.user.name'));

//        $this->setDebugStatus(true);
//        $this->setPaginationMethod('simple');
//        $this->setPaginationStatus(false);
        $this->setPerPageAccepted([50, 100, 200]);
        $this->setSortingPillsDisabled();
        $this->setFilterPillsDisabled();

        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'before-toolbar' => 'admix-components::livewire-tables.toolbar.before-toolbar',
            'after-toolbar' => 'admix-components::livewire-tables.toolbar.after-toolbar',
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

    public function builder(): Builder
    {
        return User::query()->when($this->isTrash, function (Builder $builder) {
            $builder->onlyTrashed();
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
            TextFilter::make(__('admix::fields.name'), 'name')
                ->filter(function (Builder $builder, string $value) use ($strongTableFromBuilder) {
                    $builder->where("{$strongTableFromBuilder}.name", 'LIKE', "%{$value}%");
                }),
            TextFilter::make(__('admix::fields.email'), 'email')
                ->filter(function (Builder $builder, string $value) use ($strongTableFromBuilder) {
                    $builder->where("{$strongTableFromBuilder}.email", 'LIKE', "%{$value}%");
                }),
        ];
    }

    public function columns(): array
    {
        $actionButtons = [];
        if ($this->isTrash) {
            $actionButtons = [
                RestoreColumn::make('Restore')
                    ->title(fn($row) => __('Restore'))
                    ->location(fn($row) => "window.livewire.emitTo('admix::user.table', 'bulkRestore', $row->id)")
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-0 ms-md-2',
                        ];
                    }),
            ];
        } else {
            $actionButtons = [
                LinkColumn::make('Edit')
                    ->title(fn($row) => __('Edit'))
                    ->location(fn($row) => route('admix.user.edit', $row))
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-2',
                        ];
                    }),
                DeleteColumn::make('Delete')
                    ->title(fn($row) => __('Delete'))
                    ->location(fn($row) => $row->id)
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-2',
                        ];
                    }),
            ];
        }

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
                ->buttons($actionButtons),
        ];
    }

    public function bulkActions(): array
    {
        if ($this->isTrash) {
            return [
                'bulkRestore' => __('Restore'),
            ];
        }

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

    public function bulkRestore(mixed $id = null): void
    {
        $id = $id ? Arr::wrap($id) : $this->getSelected();

        try {
            $model = $this->builder()
                ->whereIn('id', $id)
                ->get()->each->restore();

            if ($model->count()) {
                $this->emit('toast', [
                    'level' => 'success',
                    'message' => __('crud.success.restore'),
                ]);
            } else {
                $this->emit('toast', [
                    'level' => 'error',
                    'message' => __('crud.error.restore'),
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

    public function headerActions(): array
    {
        if ($this->isTrash) {
            return [
                '<x-btn href="' . route('admix.user.index') . '"
                    label="' . __('Back') . '"/>',
            ];
        }

        return [
            '<x-btn href="' . route('admix.user.create') . '" 
                label="' . __('Create :name', ['name' => __(config('admix.user.name'))]) . '"
                class="btn-primary" />',
            '<x-btn href="' . route('admix.user.trash') . '" 
                label="' . __('Trash') . '"
                class="btn-warning" />',
        ];
    }

    public function render(): View
    {
        session()->put('backUrl', route('admix.user.index', ['table' => $this->table]));

        $this->setupColumnSelect();
        $this->setupPagination();
        $this->setupSecondaryHeader();
        $this->setupFooter();
        $this->setupReordering();

        return view('admix-components::livewire-tables.datatable')
            ->with([
                'pageTitle' => $this->pageTitle,
                'headerActions' => $this->headerActions(),
                'columns' => $this->getColumns(),
                'rows' => $this->getRows(),
                'customView' => $this->customView(),
            ])
            ->extends('admix::internal')
            ->section('internal-content');
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
}