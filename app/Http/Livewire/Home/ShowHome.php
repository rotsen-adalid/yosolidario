<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class ShowHome extends Component
{
    public $language;

    public function mount() {

    }

    public function render()
    {
        return view('livewire.home.show-home');
    }

    public function createCampaign()
    {
        return redirect()->route('campaign/create');
    }
}
