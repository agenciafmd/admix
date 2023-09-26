<?php

namespace Agenciafmd\Admix\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
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
                    'event' => Str::of(__('admix::events.' . $this->event))
                        ->lower(),
                    'id' => $this->auditable_id,
                ]);
                $packageName = 'admix-' . Str::of($this->auditable_type)
                        ->afterLast('\\')
                        ->lower();
                if ($this->event === 'created' || $this->event === 'updated') {
                    $log .= '<br /><br />';
                    foreach ($this->getModified() as $attribute => $modified) {
                        $attributeName = $packageName . '::fields.' . $attribute;
                        $attributeName = __($attributeName);
                        if (Str::of($attributeName)
                            ->contains('::fields.')) {
                            $attributeName = __("admix::fields.{$attribute}");
                        }

                        $log .= __('<strong>:attribute</strong> was changed from <strong>:old</strong> to <strong>:new</strong>', [
                                'attribute' => $attributeName,
                                'old' => $modified['old'] ?? __('empty'),
                                'new' => $modified['new'] ?? __('empty'),
                            ]) . '<br />';
                    }
                }

                return $log;
            },
        );
    }

    public function admixUser(): morphOne
    {
        $morphPrefix = Config::get('audit.user.morph_prefix', 'user');

        return $this->morphOne(User::class, $morphPrefix, "{$morphPrefix}_type", 'id', "{$morphPrefix}_id");
    }
}
