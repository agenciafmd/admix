<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\User;

use Agenciafmd\Admix\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Table extends DataTableComponent
{
    protected $model = User::class;

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
                    LinkColumn::make('Delete')
                        ->title(fn($row) => __('Delete'))
                        ->location(fn($row) => route('admix.user.edit', $row))
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
            'bulkActivate' => 'Ativar',
        ];
    }

    public function bulkActivate(): void
    {
//        User::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }
}