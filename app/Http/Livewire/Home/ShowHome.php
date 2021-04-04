<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;
use App\Http\Traits\Geolocation;

class ShowHome extends Component
{
    use Geolocation;

    public $ipapi;

    public function mount() {
        $this->registerGeolocation();
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
