<?php

namespace Agenciafmd\Admix;

use Illuminate\Support\Facades\Artisan;

trait TurboTrait
{
    public static function bootTurboTrait()
    {
        static::created(function ($model) {
            if ($model->is_active) {
                file_get_contents($model->url);
            }
        });

        static::saved(function ($model) {
            if ($model->is_active) {
                Artisan::call('page-cache:clear', ['slug' => str_replace(config('app.url'), '', $model->url)]);
                file_get_contents($model->url);
            }
        });

        static::deleted(function ($model) {
            if ($model->is_active) {
                Artisan::call('page-cache:clear', ['slug' => str_replace(config('app.url'), '', $model->url)]);
            }
        });

        static::restored(function ($model) {
            if ($model->is_active) {
                file_get_contents($model->url);
            }
        });
    }
}
