<?php

namespace App\Http\Livewire\About\HowItWorks;

use Livewire\Component;

class ShowHowItWorks extends Component
{
    public function render()
    {
        return view('livewire.about.how-it-works.show-how-it-works');
    }

    public function createCampaign()
    {
        return redirect()->route('campaign/create');
    }
}
