<?php

namespace Agenciafmd\Admix\View\Components\Ui;

use Illuminate\View\Component;

class ImageComponent extends Component
{
    public string $name;
    public int $width;
    public int $height;
    public int $quality;
    public string $preview;
    public string $download;
    public string $uuid;

    public function __construct(string $name, object $model = null)
    {
        $this->name = $name;

        $modelName = strtolower(class_basename($model));
        $source = config("upload-configs.{$modelName}.{$name}.sources.0");

        $this->width = $source['width'];
        $this->height = $source['height'];
        $this->quality = $source['quality'] ?? 100;
        $this->preview = '';
        $this->download = '';
        $this->uuid = '';
        if($model->getFirstMedia($name)) {
            $this->preview = $model->getFirstMediaUrl($name, $source['conversion']);
            $this->download = $model->getFirstMediaUrl($name, $source['conversion']);
            $this->uuid = $model->getFirstMedia($name)
                ->getCustomProperty('uuid');
        }
    }

    public function render()
    {
        return view('agenciafmd/admix::components.ui.image');
    }
}
