<?php

namespace Agenciafmd\Admix\Livewire\Pages\Base;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\DeleteColumn;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\EditColumn;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\RestoreColumn;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;
use Rap2hpoutre\FastExcel\FastExcel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends DataTableComponent
{
    use AuthorizesRequests;

    protected $model;

    protected string $indexRoute = '';

    protected string $trashRoute = '';

    protected string $creteRoute = '';

    protected string $editRoute = '';

    protected string $pageTitle = '';

    protected string $packageName = '';

    protected array $additionalFilters = [];

    protected array $additionalColumns = [];

    protected array $additionalActionButtons = [];

    protected array $additionalBulkActions = [];

    public bool $isTrash = false;

    public User $user;

    protected $listeners = [
        'bulkDelete' => 'bulkDelete',
        'bulkRestore' => 'bulkRestore',
    ];

    public function mount(): void
    {
        $this->user = auth('admix-web')
            ->user();
        $this->isTrash = request()?->is('*/trash');

        ($this->isTrash) ? $this->authorize('restore', $this->model) : $this->authorize('view', $this->model);
    }

    public function configure(): void
    {
        $this->pageTitle = $this->packageName;
        if ($this->isTrash) {
            $this->pageTitle = __('Trash of ') . $this->packageName;
        }

        //        $this->setDebugStatus(true);
        //        $this->setPaginationMethod('simple');
        //        $this->setPaginationStatus(false);
        $this->setPerPageAccepted([50, 100, 200]);
        $this->setSortingPillsDisabled();
        $this->setFilterPillsDisabled();
        $this->setHideBulkActionsWhenEmptyEnabled();

        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'before-toolbar' => 'admix-ui::livewire-tables.toolbar.before-toolbar',
            'after-toolbar' => 'admix-ui::livewire-tables.toolbar.after-toolbar',
        ]);
        $this->setTableAttributes([
            'class' => 'card-table table-vcenter text-nowrap datatable table-striped',
        ]);
        $this->setThAttributes(function (Column $column) {
            if (
                $column->isField('id') ||
                $column->isField('is_active') ||
                $column->isField('star') ||
                $column->isField('sort') ||
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
                    'class' => 'text-secondary text-end ' . ($this->bulkActionsStatus === false ? 'ps-4' : ''),
                ];
            }

            if ($column->isField('is_active') || $column->isField('star')) {
                return [
                    'align' => 'center',
                ];
            }

            if ($column->isField('sort')) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [];
        });
    }

    public function builder(): Builder
    {
        return $this->model::query()
            ->when($this->isTrash, function (Builder $builder) {
                $builder->onlyTrashed();
            })
            ->when(!$this->hasSorts(), function (Builder $builder) {
                $builder->sort();
            });
    }

    public function customView(): string
    {
        return 'admix-ui::livewire-tables.includes.custom';
    }

    public function filters(): array
    {
        return [
            TextFilter::make(__('admix::fields.id'), 'id')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('id'), $value);
                }),
            SelectFilter::make(__('admix::fields.is_active'), 'is_active')
                ->options([
                    '' => __('-'),
                    'true' => __('Yes'),
                    'false' => __('No'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('is_active'), ($value === 'true'));
                }),
            TextFilter::make(__('admix::fields.name'), 'name')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('name'), 'like', "%{$value}%");
                }),
            //            TextFilter::make(__('admix::fields.email'), 'email')
            //                ->filter(function (Builder $builder, string $value) {
            //                    $builder->where($builder->qualifyColumn('email'), 'LIKE', "%{$value}%");
            //                }),
            ...$this->additionalFilters,
        ];
    }

    public function columns(): array
    {
        $actions = [];
        if ($this->isTrash) {
            if ($this->user->can('restore', $this->builder()
                ->getModel())) {
                $actions[] = RestoreColumn::make('Restore')
                    ->title(fn($row) => __('Restore'))
                    ->location(fn($row) => "window.Livewire.dispatchTo('" . str(static::class)
                            ->lower()
                            ->replace('\\', '.')
                            ->toString() . "', 'bulkRestore', { id: {$row->id} })")
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-0 ms-md-2',
                        ];
                    });
            }
        } else {
            if ($this->user->can('update', $this->builder()
                ->getModel())) {
                $actions[] = EditColumn::make('Edit')
                    ->title(fn($row) => __('Edit'))
                    ->location(fn($row) => route($this->editRoute, $row))
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-2',
                        ];
                    });
            }

            if ($this->user->can('delete', $this->builder()
                ->getModel())) {
                $actions[] = DeleteColumn::make('Delete')
                    ->title(fn($row) => __('Delete'))
                    ->location(fn($row) => $row->id)
                    ->attributes(function ($row) {
                        return [
                            'class' => 'btn ms-2',
                        ];
                    });
            }
        }
        $actionButtons = array_merge($this->additionalActionButtons, $actions);

        return [
            Column::make(__('admix::fields.id'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.name'), 'name')
                ->sortable()
                ->searchable(),
            ...$this->additionalColumns,
            BooleanColumn::make(__('admix::fields.is_active'), 'is_active')
                ->setView('admix-ui::livewire-tables.columns.boolean')
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
            if ($this->user->can('restore', $this->builder()
                ->getModel())) {
                return [
                    'bulkRestore' => __('Restore'),
                ];
            }

            return [];
        }

        $actions = [];
        if ($this->user->can('update', $this->builder()
            ->getModel())) {
            $actions['bulkActivate'] = __('Activate');
            $actions['bulkDeactivate'] = __('Deactivate');
        }

        $actions['bulkExport'] = __('Export');

        if ($this->user->can('delete', $this->builder()
            ->getModel())) {
            $actions['bulkDelete'] = __('Delete');
        }

        return array_merge($this->additionalBulkActions, $actions);
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
                $this->dispatch(event: 'toast', level: 'success', message: __('crud.success.delete'));
            } else {
                $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.delete'));
            }
        } catch (\Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
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
                $this->dispatch(event: 'toast', level: 'success', message: __('crud.success.restore'));
            } else {
                $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.restore'));
            }
        } catch (\Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
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

    public function fieldsToExport(): ?\Closure
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
        if ($this->indexRoute && $this->isTrash) {
            return [
                '<x-btn href="' . route($this->indexRoute) . '"
                    label="' . __('Back') . '"/>',
            ];
        }
        $actions = [];
        if ($this->creteRoute && $this->user->can('create', $this->builder()
                ->getModel())) {
            $actions[] = '<x-btn.create href="' . route($this->creteRoute) . '"
                label="' . $this->packageName . '" />';
        }
        if ($this->trashRoute && $this->user->can('restore', $this->builder()
                ->getModel())) {
            $actions[] = '<x-btn.trash href="' . route($this->trashRoute) . '"
                label="" />';
        }

        return $actions;
    }

    public function render(): View
    {
        if ($this->indexRoute) {
            session()->put('backUrl', route($this->indexRoute, ['table' => $this->table]));
        }

        $this->setupColumnSelect();
        $this->setupPagination();
        $this->setupSecondaryHeader();
        $this->setupFooter();
        $this->setupReordering();

        return view('admix-ui::livewire-tables.datatable')
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

    public function setAdditionalFilters(array $filters): void
    {
        $this->additionalFilters = $filters;
    }

    public function setAdditionalColumns(array $columns): void
    {
        $this->additionalColumns = $columns;
    }

    public function setAdditionalActionButtons(array $actionButtons): void
    {
        $this->additionalActionButtons = $actionButtons;
    }

    public function setAdditionalBulkActions(array $bulkActions): void
    {
        $this->additionalBulkActions = $bulkActions;
    }

    public function setAdditionalListeners(array $listeners): void
    {
        $this->listeners = array_merge($this->listeners, $listeners);
    }

    private function markIsActiveAs(bool $flag = true): void
    {
        try {
            $model = $this->builder()
                ->whereIn('id', $this->getSelected())
                ->get()->each->update(['is_active' => $flag]);

            if ($model->count()) {
                $this->dispatch(event: 'toast', level: 'success', message: __('crud.success.update'));
            } else {
                $this->dispatch(event: 'toast', level: 'error', message: __('crud.error.update'));
            }
        } catch (\Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        $this->clearSelected();
    }
}
