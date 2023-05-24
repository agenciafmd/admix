<?php

namespace Agenciafmd\Admix\Support\PathGenerator;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class DefaultPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->customPath($media->id) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    protected function getBasePath(Media $media): string
    {
        return $this->customPath($media->id);
    }

    private function customPath(string $key)
    {
        return 'media/' . Str::of($key)->pipe('md5')->limit(6, '')->split(2)->implode('/') . '/' . $key;
    }
}