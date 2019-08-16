<?php

namespace Agenciafmd\Admix;

use Illuminate\Support\Facades\Artisan;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;

trait MediaTrait
{
    public static function bootMediaTrait()
    {
        static::saved(function ($model) {
            $request = request();

            if (!$request->has('media')) {
                return false;
            }

            foreach ($request->get('media') as $file) {
                $collection = $file['collection'];
                $file = storage_path('admix/tmp') . "/{$file['name']}";

                $model->doUpload($file, $collection);
            }
        });
    }

    public function doUpload($file, $collection = 'image')
    {
        $this->clearMediaCollection($collection)
            ->addMedia($file)
            ->withResponsiveImages()
            ->withCustomProperties(['uuid' => uniqid()])
            ->toMediaCollection($collection);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $fields = $this->fieldsToConvertion();
        foreach ($fields as $collection => $field) {
            $convertion = $this->addMediaConversion('thumb');
            if ($field['crop']) {
                $convertion->fit(Manipulations::FIT_CROP, $field['width'], $field['height']);
            } else {
                $convertion->width($field['width'])
                    ->height($field['height']);
            }
            if ($field['optimize']) {
                $convertion->optimize();
            }
            if ($field['quality']) {
                $convertion->quality($field['quality']);
            }
            $convertion->performOnCollections($collection)
                ->withResponsiveImages()
                ->keepOriginalImageFormat();
        }
    }

    public function fieldsToConvertion()
    {
        $modelName = strtolower(class_basename($this));

        return config("upload-configs.{$modelName}");
    }
}
