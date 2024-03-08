<?php

namespace Agenciafmd\Admix\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use OwenIt\Auditing\Models\Audit as AuditModel;

class Audit extends AuditModel
{
    protected function log(): Attribute
    {
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
                    foreach ($this->getModified() as $attribute => $modified) {
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

                        $log .= __('<strong>:attribute</strong> was changed from <strong>:old</strong> to <strong>:new</strong>', [
                                'attribute' => $attributeName,
                                'old' => isset($modified['old']) ? str($modified['old'])
                                    ->pipe('nl2br')
                                    ->squish() : __('empty'),
                                'new' => isset($modified['new']) ? str($modified['new'])
                                    ->pipe('nl2br')
                                    ->squish() : __('empty'),
                            ]) . '<br />';
                    }
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
}
