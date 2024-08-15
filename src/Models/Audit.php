<?php

namespace Agenciafmd\Admix\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use OwenIt\Auditing\Models\Audit as AuditModel;

class Audit extends AuditModel
{
    use Prunable;

    protected function log(): Attribute
    {
        /* TODO: refatorar e retornar uma tabela na descrição dos campos */
        /*
        | Campo | Ação       | De    | Para   |
        |-------|------------|-------|--------|
        | ativo | modificado | vazio | 1      |
        | nome  | modificado | vazio | Irineu |
        */

        return Attribute::make(
            get: function () {
                $log = __(':created_at, :user [:ip] :event the register #:id', [
                    'created_at' => $this->created_at->format(config('admix.timestamp.format')),
                    'user' => $this->{'admixUser.name'},
                    'ip' => $this->ip_address,
                    'event' => str(__('admix::events.' . $this->event))
                        ->lower(),
                    'id' => $this->auditable_id,
                ]);
                $packageName = 'admix-' . str($this->auditable_type)
                        ->afterLast('\\')
                        ->plural()
                        ->lower();
                if ($this->event === 'created' || $this->event === 'updated') {
                    $log .= '<br /><br />';
                    collect($this->getModified())->each(function ($modified, $attribute) use ($packageName, &$log) {
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

                        collect($modified)
                            ->each(function ($value, $key) use (&$modified) {
                                if (is_array($value)) {
                                    $modified[$key] = addslashes(implode(', ', $value));
                                }
                            });

                        $log .= __('<strong>:attribute</strong> was changed from <strong>:old</strong> to <strong>:new</strong>',
                                [
                                    'attribute' => $attributeName,
                                    'old' => isset($modified['old']) ? str($modified['old'])
                                        ->pipe('nl2br')
                                        ->squish() : __('empty'),
                                    'new' => isset($modified['new']) ? str($modified['new'])
                                        ->pipe('nl2br')
                                        ->squish() : __('empty'),
                                ]) . '<br />';
                    });
                }

                return $log;
            },
        );
    }

    public function admixUser(): morphOne
    {
        $morphPrefix = config('audit.user.morph_prefix', 'user');

        return $this->morphOne(User::class, $morphPrefix, "{$morphPrefix}_type", 'id', "{$morphPrefix}_id");
    }

    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subYear());
    }
}
