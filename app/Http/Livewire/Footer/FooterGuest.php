<?php

namespace App\Http\Livewire\Footer;
use Livewire\Component;

class FooterGuest extends Component
{
    public $language;

    public function mount() {
        $this->language = session()->get('locale');
    }
    
    public function render()
    {
        return view('livewire.footer.footer-guest');
    }
    
    public function languageSelect() {
        return redirect()->route('set_language', ['lang' => $this->language]);
    } 
}
