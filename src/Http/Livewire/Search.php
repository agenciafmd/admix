<?php

namespace Agenciafmd\Admix\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $searchTerm;

    public $results;

    public function render()
    {
        $this->results = [];

        if ($this->searchTerm) {
            $this->results = app()->make('admix-search')
                ->search($this->searchTerm)
                ->groupByType()
                ->toArray();
        }

        return view('agenciafmd/admix::livewire.search');
    }
}
