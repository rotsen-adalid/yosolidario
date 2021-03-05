<?php

namespace App\Http\Livewire\Campaigns\Manage\Teams;
use Livewire\Component;

use App\Models\Campaign;

class ShowTeams extends Component
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
        return view('livewire.campaigns.manage.teams.show-teams');
    }
}
