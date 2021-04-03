<?php

namespace App\Http\Livewire\Setting\Acount;

use Livewire\Component;
use Illuminate\Http\Request;
class AcountSetting extends Component
{
    public $flash = true;

    public function amount() {
        
    }

    public function render()
    {
        if($this->flash == true) {
            $this->banner('Successfully saved!');
        }
        return view('livewire.setting.acount.acount-setting');
    }

    public function boton() {
        //$this->flash = true;
        $this->emit('banner');
    }

    public function banner(string $message, string $style = 'success')
    {
        $this->emit('banner');
        //$this->emit('bannerStyle', $style);
    }
}
