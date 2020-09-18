<?php

namespace Agenciafmd\Admix\View\Components\Ui;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ImagesComponent extends Component
{
    public string $name;
    public int $width;
    public int $height;
    public int $quality;
    public string $conversion;
    public Collection $preview;

    public function __construct(string $name, object $model = null)
    {
        $this->name = $name;

        $modelName = strtolower(class_basename($model));
        $source = config("upload-configs.{$modelName}.{$name}.sources.0");

        $this->width = $source['width'];
        $this->height = $source['height'];
        $this->quality = $source['quality'] ?? 100;
        $this->conversion = $source['conversion'];
        $this->preview = collect([]);
        if ($model->getMedia($name)) {
            $this->preview = $model->getMedia($name);
        }
    }

    public function render()
    {
        return view('agenciafmd/admix::components.ui.images');
    }
}
