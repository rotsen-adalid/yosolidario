<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }

    public function createCampaign() {
        return redirect()->route('campaign/create');
    }
}
