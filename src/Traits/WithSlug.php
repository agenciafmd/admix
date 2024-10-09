<?php

namespace Agenciafmd\Admix\Traits;

use Illuminate\Database\Eloquent\Model;

trait WithSlug
{
    protected static function bootWithSlug(): void
    {
        static::saving(function (Model $model) {
            if ($slug = $model->generateSlug()) {
                $model->slug = $slug;
            }
        });
    }

    protected function generateSlug(): ?string
    {
        $slugFrom = $this->slugFrom ?? 'name';

        if ($this->getRawOriginal($slugFrom) === $this->{$slugFrom}) {
            return null;
        }

        $slug = str($this->{$slugFrom})
            ->trim()
            ->limit(120)
            ->slug();

        $i = 1;
        $uniqueSlug = $slug;
        while (static::withoutGlobalScopes()
            ->where('slug', $uniqueSlug)
            ->orderBy('slug')
            ->exists()) {
            $uniqueSlug = $slug . '-' . $i++;
        }

        return $uniqueSlug;
    }
}
