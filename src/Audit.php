<?php

namespace Agenciafmd\Admix;

use OwenIt\Auditing\Models\Audit as AuditModel;

class Audit extends AuditModel
{
    public function getLogAttribute()
    {
        $log = "{$this->created_at->format('d/m/Y H:i:s')}, " . optional($this->user)->name . " [{$this->ip_address}] " . strtolower(audit_events($this->event)) . " o registro #{$this->auditable_id} pela url {$this->url}<br /><br />";

        if ('created' === $this->event || 'updated' === $this->event) {
            try {
                foreach ($this->getModified() as $attribute => $modified) {
                    $log .= "O campo <strong>{$attribute}</strong> foi alterado de <strong>" . (($modified['old']) ?? 'vazio') . '</strong> para <strong>' . (($modified['new']) ?? '') . '</strong><br />';
                }
            } catch (\Throwable $exception) {
                foreach ($this->old_values as $attribute => $value) {
                    $log .= "O campo <strong>{$attribute}</strong> foi alterado de <strong>" . (($this->old_values[$attribute]) ?? 'vazio') . '</strong> para <strong>' . (($this->new_values[$attribute]) ?? '') . '</strong><br />';
                }
            }
        }

        return $log;
    }
}
