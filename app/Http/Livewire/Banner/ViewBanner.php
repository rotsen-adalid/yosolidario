<?php

namespace App\Http\Livewire\Banner;

use Livewire\Component;
use App\Http\Traits\InteractsWithBanner;

class ViewBanner extends Component
{
    use InteractsWithBanner;

    public $bannerStyle, $message;
    protected $listeners = ['bannerSuccess', 'bannerDanger'];

    public function render()
    {
        return view('livewire.banner.view-banner');
    }

    public function bannerSuccess($message) {
        $this->emit('saved');
        $this->bannerStyle = "success";
        $this->message = $message;
    }

    public function bannerDanger($message) {
        $this->emit('saved');
        $this->bannerStyle = "danger";
        $this->message = $message;
    }
}
