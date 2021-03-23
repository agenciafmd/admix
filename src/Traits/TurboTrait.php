<?php

namespace Agenciafmd\Admix\Traits;

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
            try {
                if ($model->is_active) {
                    dispatch(function () use ($model) {
                        (new GuzzleClient)->request('GET', $model->url);
                    })
                        ->delay(now()->addSeconds(5))
                        ->onQueue('low');
                }
            } catch (\Exception $e) {
                // não tem problema
            }
        });

        static::saved(function ($model) {
            try {
                if ($model->is_active) {
                    dispatch(function () use ($model) {
                        Artisan::call('page-cache:clear', [
                            'slug' => str_replace(config('app.url'), '', $model->url),
                        ]);

                        (new GuzzleClient)->request('GET', $model->url);
                    })
                        ->delay(now()->addSeconds(5))
                        ->onQueue('low');
                }
            } catch (\Exception $e) {
                // não tem problema
            }
        });

        static::deleted(function ($model) {
            try {
                dispatch(function () use ($model) {
                    Artisan::call('page-cache:clear', [
                        'slug' => str_replace(config('app.url'), '', $model->url),
                    ]);
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            } catch (\Exception $e) {
                // não tem problema
            }
        });

        static::restored(function ($model) {
            try {
                if ($model->is_active) {
                    dispatch(function () use ($model) {
                        (new GuzzleClient)->request('GET', $model->url);
                    })
                        ->delay(now()->addSeconds(5))
                        ->onQueue('low');
                }
            } catch (\Exception $e) {
                // não tem problema
            }
        });
    }
}
