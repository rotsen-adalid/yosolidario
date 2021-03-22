<?php

namespace App\Http\Livewire\Footer;

use Livewire\Component;

class FooterApp extends Component
{
    public $language;

    public function mount() {
        $this->language = session()->get('locale');
    }
    
    public function render()
    {
        return view('livewire.footer.footer-app');
    }
    
    public function languageSelect() {
        return redirect()->route('set_language', ['lang' => $this->language]);
    } 
}

