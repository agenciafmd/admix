<?php

namespace Agenciafmd\Admix\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Audit as AuditTrait;
use OwenIt\Auditing\Contracts\Audit as AuditContract;

class Audit extends Model implements AuditContract
{
    use AuditTrait, Prunable, WithScopes;

    public static $auditingGloballyDisabled = false;

    protected array $defaultSort = [
        'created_at' => 'desc',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'json',
            'new_values' => 'json',
            // Note: Please do not add 'auditable_id' in here, as it will break non-integer PK models
        ];
    }

    protected function log(): Attribute
    {
        return Attribute::make(
            get: function () {
                $log = __(':created_at, :user [:ip] :event the register #:id', [
                    'created_at' => $this->created_at->format(config('admix.timestamp.format')),
                    'user' => $this->{'admixUser.name'} ?? 'Desconhecido',
                    'ip' => $this->ip_address,
                    'event' => str(__('admix::events.' . $this->event))
                        ->lower(),
                    'id' => $this->auditable_id,
                ]);
                $packageName = 'admix-' . str($this->auditable_type)
                    ->afterLast('\\')
                    ->plural()
                    ->lower();

                if ($this->event !== 'created' && $this->event !== 'updated') {
                    return $log;
                }

                $log .= '<br /><br />';
                $fields = collect()
                    ->merge($this->new_values)
                    ->merge($this->old_values)
                    ->keys()
                    ->map(function ($attribute) use ($packageName) {
                        return [
                            'field' => $this->parseField($attribute, $packageName),
                            'old' => $this->old_values[$attribute] ?? null,
                            'new' => $this->new_values[$attribute] ?? null,
                        ];
                    })
                    ->map(function ($field) {
                        return [
                            'field' => $field['field'],
                            'old' => filled($field['old']) ? $field['old'] : null,
                            'new' => filled($field['new']) ? $field['new'] : null,
                        ];
                    })
                    ->filter(function ($field) {
                        return filled($field['old']) || filled($field['new']);
                    })
                    ->map(function ($field) {
                        return [
                            'field' => $field['field'],
                            'old' => ($field['old']) ? str($field['old'])
                                ->pipe('nl2br')
                                ->squish()
                                ->__toString() : __('empty'),
                            'new' => ($field['new']) ? str($field['new'])
                                ->pipe('nl2br')
                                ->squish()
                                ->__toString() : __('empty'),
                        ];
                    })
                    ->values();
                $log .= $this->generateTable($fields);

                return $log;
            },
        );
    }

    public function getSerializedDate(\DateTimeInterface $date): string
    {
        return $this->serializeDate($date);
    }

    public function admixUser(): morphOne
    {
        $morphPrefix = config('audit.user.morph_prefix', 'user');

        return $this->morphOne(User::class, $morphPrefix, "{$morphPrefix}_type", 'id', "{$morphPrefix}_id");
    }

    public function prunable(): Builder
    {
        return static::query()->where('created_at', '<=', now()->subYear());
    }

    private function parseField(string $attribute, string $packageName): string
    {
        $attributeName = $packageName . '::fields.' . $attribute;
        $attributeName = __($attributeName);
        if (str($attributeName)
            ->contains('::fields.')) {
            $attributeName = str($packageName)
                ->replace('admix', 'local')
                ->__toString() . '::fields.' . $attribute;
            $attributeName = __($attributeName);
        }
        if (str($attributeName)
            ->contains('::fields.')) {
            $attributeName = __("admix::fields.{$attribute}");
        }

        return $attributeName;
    }

    private function generateTable(Collection $data): string
    {
        $table = '';
        $table .= '| ' . __('field') . ' | ' . __('old values') . ' | ' . __('new values') . ' |' . "\n";
        $table .= '|---|---|---|' . "\n";
        $data->each(function ($item) use (&$table) {
            $table .= '| ' . str($item['field'])->ucfirst() . ' | ' . $item['old'] . ' | ' . $item['new'] . ' |' . "\n";
        });

        $responsive = '<div class="table-responsive">';
        $responsive .= str($table)
            ->markdown()
            ->squish()
            ->replace('<table', '<table class="table table-vcenter"')
            ->__toString();
        $responsive .= '</table>';

        // TODO: implementar o ver mais para que os campos textarea não fiquem assustadores na tabela.
        // https://paulbakaus.com/multiline-truncated-text-with-show-more-button-with-just-css/

        return $responsive;
    }
}
