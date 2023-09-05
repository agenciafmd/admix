<?php

namespace Agenciafmd\Admix\Http\Livewire\Pages\Audit;

use Agenciafmd\Admix\Http\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\Audit;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Index extends BaseIndex
{
    protected $model = Audit::class;

    public function configure(): void
    {
        $this->packageName = __(config('admix.audit.name'));

        parent::configure();
    }

    public function columns(): array
    {
        $actions = [];
        $actionButtons = [];
//        if (Auth::user()
//            ?->can('update', $this->builder()
//                ->getModel())) {
//            $actions[] = EditColumn::make('Edit')
//                ->title(fn($row) => __('Edit'))
//                ->location(fn($row) => route($this->editRoute, $row))
//                ->attributes(function ($row) {
//                    return [
//                        'class' => 'btn ms-2',
//                    ];
//                });
//        }
//        $actionButtons = array_merge($this->additionalActionButtons, $actions);

        return [
            Column::make(__('admix::fields.id'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.auditable_type'), 'auditable_type')
                ->sortable()
                ->searchable()
                ->format(
                    fn($value) => config('audit-alias')[$value] ? Str::of(config('audit-alias')[$value])
                        ->explode(' » ')
                        ->map(fn($name) => __($name))
                        ->implode(' » ') : $value
                ),
            Column::make(__('admix::fields.user'), 'admixUser.name')
                ->sortable()
                ->searchable()
                ->format(
                    fn($value) => $value ?? __('Unknown')
                ),
            Column::make(__('admix::fields.event'), 'event')
                ->sortable()
                ->searchable()
                ->format(
                    fn($value) => __('admix::events.' . $value)
                ),
            Column::make(__('admix::fields.auditable_id'), 'auditable_id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.created_at'), 'created_at')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return $value->format(config('admix.timestamp.format'));
                }),

//            ButtonGroupColumn::make('')
//                ->excludeFromColumnSelect()
//                ->attributes(function ($row) {
//                    return [
//                        'class' => 'text-end',
//                    ];
//                })
//                ->buttons($actionButtons),
        ];
    }
}