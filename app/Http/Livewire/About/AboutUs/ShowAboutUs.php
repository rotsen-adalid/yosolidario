<?php

namespace App\Http\Livewire\About\AboutUs;

use Livewire\Component;

class ShowAboutUs extends Component
{
    public function render()
    {
        return view('livewire.about.about-us.show-about-us');
    }

    public function createCampaign()
    {
        return redirect()->route('campaign/create');
    }
}
