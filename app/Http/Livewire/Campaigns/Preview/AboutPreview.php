<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;

class AboutPreview extends Component
{
    public $campaign;
    
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 
    public function render()
    {
        return view('livewire.campaigns.preview.about-preview');
    }
}
