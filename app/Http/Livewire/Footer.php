<?php

namespace App\Http\Livewire;
use Livewire\Component;

class Footer extends Component
{
    public $language;

    public function mount() {
        $this->language = 'ENGLISH';
    }
    
    public function render()
    {
        return view('livewire.footer');
    }
    
    public function changeLanguage() {
        //return redirect()->route('campaign/update/rewards', []);
    } 
}
