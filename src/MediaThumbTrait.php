<?php

namespace Agenciafmd\Admix;

use Illuminate\Support\Facades\View;

trait MediaThumbTrait
{
    /*
     * geração dos thumbs no front
     * este deve ser utilizado em conjunto do MediaTrait
     *
     * ex.
     *     {{ $user->fancybox()
     *       ->source(1600, ['w'=> 1920, 'h'=> 1080])
     *       ->source(1024, ['w'=> 1166, 'h'=> 656])
     *       ->source(0, ['w'=> 780, 'h'=> 439])
     *       ->pictureClass('wrapper')
     *       ->imgClass('img-sanitize img-cover')
     *       ->thumb('image') }}
     */

    protected $thumbTemplate = "agenciafmd/frontend::components/picture";
    protected $fancybox = false;
    protected $fancyboxClass = '';
    protected $source = [];
    protected $imgClass = '';
    protected $pictureClass = '';

    public function thumbTemplate($template)
    {
        $this->thumbTemplate = $template;

        return $this;
    }

    public function fancybox($group = 'gallery', $class = '')
    {
        $this->fancybox = $group;
        $this->fancyboxClass = $class;

        return $this;
    }

    public function source($size, $config = ['w' => 400, 'h' => 300])
    {
        $this->source = $this->source + [$size => $config];

        return $this;
    }

    public function imgClass($class = '')
    {
        $this->imgClass = $class;

        return $this;
    }

    public function pictureClass($class = '')
    {
        $this->pictureClass = $class;

        return $this;
    }

    public function thumb($collect = 'default')
    {
        $media = $this->getFirstMedia($collect);

        if (!$media) {
            $source = collect($this->source);
            $view['sources'] = [];
            $view['w'] = $source->last()['w'];
            $view['h'] = $source->last()['h'];
            $view['class'] = 'img-placeholder';

            return View::make($this->thumbTemplate, $view);
        }

        return $this->thumbGenerator($media);
    }

    private function thumbGenerator($media)
    {
        $image = $media->getUrl('thumb');

        $view['image'] = $image;

        $view['alt'] = (string)collect($media->getCustomProperty('meta') ?? [])
            ->flatten()
            ->first();

        $view['sources'] = collect($this->source)
            ->transform(function ($item, $key) use ($image) {
                $default = [
                    'q' => 85,
                    'fit' => 'crop',
                    'fm' => 'pjpg',
                ];

                return [
                    $key => [
                        'name' => $key,
                        'retina' => '/media/' . image_path_builder($image, array_merge($default, $item)),
                        'default' => '/media/' . image_path_builder($image, array_merge($default, collect($item)
                                ->map(function ($value) {
                                    return round($value / 2);
                                })
                                ->toArray())),
                    ],
                ];
            })
            ->flatten(1);

        $view['imgClass'] = $this->imgClass;
        $view['pictureClass'] = $this->pictureClass;
        $view['fancybox'] = $this->fancybox;
        $view['fancyboxClass'] = $this->fancyboxClass;
        $view['w'] = collect($this->source)->last()['w'];
        $view['h'] = collect($this->source)->last()['h'];

        return View::make($this->thumbTemplate, $view);
    }

    public function thumbs($collect = 'default')
    {
        $collection = $this->getMedia($collect);

        return $collection->map(function ($media) {
            return $this->thumbGenerator($media);
        });
    }
}
