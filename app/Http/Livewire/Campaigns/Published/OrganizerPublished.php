<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\Country;

class OrganizerPublished extends Component
{
    public $campaign;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        return view('livewire.campaigns.published.organizer-published');
    }
}
