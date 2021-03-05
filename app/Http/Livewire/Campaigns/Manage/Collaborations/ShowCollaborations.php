<?php

namespace App\Http\Livewire\Campaigns\Manage\Collaborations;
use Livewire\Component;

use App\Models\Campaign;

class ShowCollaborations extends Component
{
    public $campaign;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
        } else {
            //return redirect()->route('campaign/create');
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.manage.collaborations.show-collaborations');
    }
}
