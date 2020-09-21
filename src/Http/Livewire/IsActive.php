<?php

namespace Agenciafmd\Admix\Http\Livewire;

use Livewire\Component;

class IsActive extends Component
{
    public $item;
    public $isActive = 0;

    public function mount($myModel, $myId)
    {
        $model = new $myModel();
        $this->item = $model->withTrashed()
            ->where('id', $myId)
            ->first();
        $this->isActive = $this->item->is_active;
    }

    public function render()
    {
        return view('agenciafmd/admix::livewire.is-active');
    }

    public function update($value)
    {
        $this->item->is_active = $value;
        $this->item->save();
    }
}
