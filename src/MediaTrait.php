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

            if ($request->has('media')) {
                foreach ($request->get('media') as $media) {
                    if (is_array($media['collection'])) {
                        $collection = reset($media['collection']);
                        $file = storage_path('admix/tmp') . "/" . reset($media['name']);

                        $model->doUploadMultiple($file, $collection);

                    } else {
                        $collection = $media['collection'];
                        $file = storage_path('admix/tmp') . "/{$media['name']}";

                        $model->doUpload($file, $collection);
                    }
                }
            }
        });
    }

    public function doUpload($file, $collection = 'image', $customProperties = [])
    {
        $this->clearMediaCollection($collection)
            ->addMedia($file)
            ->withCustomProperties(array_merge(['uuid' => uniqid()], $customProperties))
            ->toMediaCollection($collection);
    }

    public function doUploadMultiple($file, $collection = 'image', $customProperties = [])
    {
        $this->addMedia($file)
            ->withCustomProperties(array_merge(['uuid' => uniqid()], $customProperties))
            ->toMediaCollection($collection);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $fields = $this->fieldsToConvertion();
        foreach ($fields as $collection => $field) {
            $conversion = $this->addMediaConversion('thumb');
            if ($field['crop']) {
                $conversion->fit(Manipulations::FIT_CROP, $field['width'], $field['height']);
            } else {
                $conversion->width($field['width'])
                    ->height($field['height']);
            }
            if (!app()->environment('local')) {
                if ($field['optimize']) {
                    $conversion->optimize();
                }
                if ($field['quality']) {
                    $conversion->quality($field['quality']);
                }
            }
            $conversion->performOnCollections($collection)
                ->keepOriginalImageFormat();
        }
    }

    public function fieldsToConvertion()
    {
        $modelName = strtolower(class_basename($this));

        return config("upload-configs.{$modelName}");
    }
}
