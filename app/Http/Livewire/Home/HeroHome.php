<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class HeroHome extends Component
{
    public $commission_percentage;
    public $currency;
    
    public function mount() {
        $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        $ipapi = $response->json();

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
}
