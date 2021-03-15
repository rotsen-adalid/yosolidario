<?php

namespace App\Http\Livewire;
use Livewire\Component;

class Footer extends Component
{
    public $language;

    public function mount() {
        $this->language = session()->get('locale');
    }
    
    public function render()
    {
        return view('livewire.footer');
    }
    
    public function languageSelect() {
        return redirect()->route('set_language', ['lang' => $this->language]);
    } 
}
