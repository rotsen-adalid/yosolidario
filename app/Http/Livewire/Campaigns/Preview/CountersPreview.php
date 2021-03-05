<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;

class CountersPreview extends Component
{
    public $campaign;
    public $shared;
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        return view('livewire.campaigns.preview.counters-preview');
    }
}
