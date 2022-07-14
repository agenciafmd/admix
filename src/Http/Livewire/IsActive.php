<?php

namespace Agenciafmd\Admix\Http\Livewire;

use Livewire\Component;

class IsActive extends Component
{
    public $item;
    public $isActive = 0;
    public $myModel;
    public $myId;

    public function mount($myModel, $myId, $isActive = null)
    {
        $this->myModel = new $myModel();
        $this->myId = $myId;

        if ($isActive) {
            $this->isActive = $isActive;
        } else {
            $this->item = $this->myModel->withTrashed()
                ->where('id', $this->myId)
                ->first();
            $this->isActive = $this->item->is_active;
        }
    }

    public function render()
    {
        return view('agenciafmd/admix::livewire.is-active');
    }

    public function update($value)
    {
        $this->item = $this->myModel->withTrashed()
            ->where('id', $this->myId)
            ->first();
        $this->item->is_active = $value;
        $this->item->save();
    }
}
