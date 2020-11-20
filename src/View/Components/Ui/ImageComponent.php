<?php

namespace Agenciafmd\Admix\View\Components\Ui;

use Illuminate\View\Component;

class ImageComponent extends Component
{
    public string $name;
    public int $width;
    public int $height;
    public int $quality;
    public string $conversion;
    public $preview;

    public function __construct(string $name, object $model = null, $source = null)
    {
        $this->name = $name;

        $modelName = strtolower(class_basename($model));
        if(!$source) {
            $source = config("upload-configs.{$modelName}.{$name}.sources.0");
        }

        $this->width = $source['width'];
        $this->height = $source['height'];
        $this->quality = $source['quality'] ?? 100;
        $this->conversion = $source['conversion'];
        $this->preview = null;
        if ($preview = $model->getFirstMedia($name)) {
            $this->preview = $preview;
        }
    }

    public function render()
    {
        return view('agenciafmd/admix::components.ui.image');
    }
}
