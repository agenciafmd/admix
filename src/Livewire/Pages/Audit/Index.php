<?php

namespace Agenciafmd\Admix\Livewire\Pages\Audit;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Admix\Models\Audit;
use Agenciafmd\Admix\Models\User;
use Agenciafmd\Ui\LaravelLivewireTables\Columns\ModalColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Index extends BaseIndex
{
    protected $model = Audit::class;

    public function configure(): void
    {
        $this->packageName = __(config('admix.audit.name'));

        $this->setAdditionalSelects([
            'audits.old_values as old_values',
            'audits.new_values as new_values',
            'audits.url as url',
            'audits.ip_address as ip_address',
            'audits.updated_at as updated_at',
        ]);

        $this->setBulkActionsDisabled();

        parent::configure();
    }

    public function builder(): Builder
    {
        return $this->model::query();
    }

    public function filters(): array
    {
        return [
            TextFilter::make(__('admix::fields.id'), 'id')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('id'), $value);
                }),
            SelectFilter::make(__('admix::fields.auditable_type'), 'auditable_type')
                ->options([
                        '' => __('-'),
                    ] + collect(config('audit-alias'))
                        ->mapWithKeys(static function ($value, $key) {
                            return [
                                $key => str($value)
                                    ->explode(' » ')
                                    ->map(static fn($name) => __($name))
                                    ->implode(' » '),
                            ];
                        })
                        ->toArray())
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('auditable_type'), $value);
                }),
            SelectFilter::make(__('admix::fields.user'), 'user_id')
                ->options([
                        '' => __('-'),
                    ] + User::query()
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray())
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('user_id'), $value);
                }),
            SelectFilter::make(__('admix::fields.event'), 'event')
                ->options([
                        '' => __('-'),
                    ] + collect(config('audit.events'))
                        ->mapWithKeys(static function ($value) {
                            return [
                                $value => __('admix::events.' . $value),
                            ];
                        })
                        ->toArray())
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('event'), $value);
                }),
            TextFilter::make(__('admix::fields.auditable_id'), 'auditable_id')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('auditable_id'), $value);
                }),
            DateTimeFilter::make(__('admix::fields.initial_date'), 'initial_date')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('created_at'), '>=', Carbon::parse($value)
                        ->format('Y-m-d H:i:s'));
                }),
            DateTimeFilter::make(__('admix::fields.end_date'), 'end_date')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('created_at'), '<=', Carbon::parse($value)
                        ->format('Y-m-d H:i:s'));
                }),
            ...$this->additionalFilters,
        ];
    }

    public function columns(): array
    {
        $actions[] = ModalColumn::make('Details')
            ->title(static fn($row) => __('Details'))
            ->location(static fn($row) => $row->log)
            ->attributes(static function ($row) {
                return [
                    'class' => 'btn ms-2',
                ];
            });
        $actionButtons = array_merge($this->additionalActionButtons, $actions);

        return [
            Column::make(__('admix::fields.id'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.auditable_type'), 'auditable_type')
                ->sortable()
                ->searchable()
                ->format(
                    static fn($value) => config('audit-alias')[$value] ? str(config('audit-alias')[$value])
                        ->explode(' » ')
                        ->map(static fn($name) => __($name))
                        ->implode(' » ') : $value
                ),
            Column::make(__('admix::fields.user'), 'admixUser.name')
                ->sortable()
                ->searchable()
                ->format(
                    static fn($value) => $value ?? __('Unknown')
                ),
            Column::make(__('admix::fields.event'), 'event')
                ->sortable()
                ->searchable()
                ->format(
                    static fn($value) => __('admix::events.' . $value)
                ),
            Column::make(__('admix::fields.auditable_id'), 'auditable_id')
                ->sortable()
                ->searchable(),
            Column::make(__('admix::fields.created_at'), 'created_at')
                ->sortable()
                ->searchable()
                ->format(static function ($value) {
                    return $value->format(config('admix.timestamp.format'));
                }),
            ButtonGroupColumn::make('')
                ->excludeFromColumnSelect()
                ->attributes(static function ($row) {
                    return [
                        'class' => 'text-end',
                    ];
                })
                ->buttons($actionButtons),
        ];
    }
}
