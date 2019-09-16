<?php

namespace Agenciafmd\Admix;

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

            foreach ($request->get('media') as $media) {
                if (is_array($media['collection'])) {
                    $collection = reset($media['collection']);
                    $file = storage_path('admix/tmp') . "/" . reset($media['name']);

                    $model->doUploadGallery($file, $collection);

                } else {
                    $collection = $media['collection'];
                    $file = storage_path('admix/tmp') . "/{$media['name']}";

                    $model->doUpload($file, $collection);
                }
            }
        });
    }

    public function doUpload($file, $collection = 'image')
    {
        $this->clearMediaCollection($collection)
            ->addMedia($file)
            ->withCustomProperties(['uuid' => uniqid()])
            ->toMediaCollection($collection);
    }

    public function doUploadGallery($file, $collection = 'image')
    {
        $this->addMedia($file)
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
            if (!app()->environment('local')) {
                if ($field['optimize']) {
                    $convertion->optimize();
                }
                if ($field['quality']) {
                    $convertion->quality($field['quality']);
                }
            }
            $convertion->performOnCollections($collection)
                ->keepOriginalImageFormat();
        }
    }

    public function fieldsToConvertion()
    {
        $modelName = strtolower(class_basename($this));

        return config("upload-configs.{$modelName}");
    }
}
