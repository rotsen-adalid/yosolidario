<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class HeroHome extends Component
{
    public $commission_percentage;
    public $currency;
    
    public function mount() {
        
        $ipapi = session()->get('ipapi');

        if ($ipapi != null) {
           if($ipapi['country_code'] == 'BO') {
            $this->commission_percentage = 7.5;
           }
        } else {
            $this->commission_percentage = 0;
        }
    }
    
    public function render()
    {
        return view('livewire.home.hero-home');
    }

    public function createCampaign() {
        return redirect()->route('campaign/create');
    }
}
