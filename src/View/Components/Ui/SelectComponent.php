<?php

namespace Agenciafmd\Admix\View\Components\Ui;

use Illuminate\View\Component;

class SelectComponent extends Component
{
    public string $name;

    public array $options;

    public string $selected;

    public function __construct(string $name, array $options, $selected)
    {
        if($selected === false) {
            $selected = 0;
        }

        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('agenciafmd/admix::components.ui.select');
    }

    public function isSelected(string $option)
    {
        return $option === old($this->name, $this->selected);
    }
}
