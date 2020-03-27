<?php

namespace Agenciafmd\Admix;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Artisan;

trait TurboTrait
{
    public static function bootTurboTrait()
    {
        if (app()->runningInConsole()) {
            return false;
        }

        static::created(function ($model) {
            if ($model->is_active) {
                dispatch(function () use ($model) {
                    with(new GuzzleClient())->request('GET', $model->url);
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            }
        });

        static::saved(function ($model) {
            if ($model->is_active) {
                dispatch(function () use ($model) {
                    Artisan::call('page-cache:clear', ['slug' => str_replace(config('app.url'), '', $model->url)]);

                    with(new GuzzleClient())->request('GET', $model->url);
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            }
        });

        static::deleted(function ($model) {
            if ($model->is_active) {
                dispatch(function () use ($model) {
                    Artisan::call('page-cache:clear', ['slug' => str_replace(config('app.url'), '', $model->url)]);
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            }
        });

        static::restored(function ($model) {
            if ($model->is_active) {
                dispatch(function () use ($model) {
                    with(new GuzzleClient())->request('GET', $model->url);
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            }
        });
    }
}
