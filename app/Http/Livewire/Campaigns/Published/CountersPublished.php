<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class CountersPublished extends Component
{
    public $campaign;
    public $shared;
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        return view('livewire.campaigns.published.counters-published');
    }
    public function sharedDialog() {
        $this->shared = true;
    }
}
