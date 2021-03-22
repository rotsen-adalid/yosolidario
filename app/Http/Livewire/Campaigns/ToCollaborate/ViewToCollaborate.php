<?php

namespace App\Http\Livewire\Campaigns\ToCollaborate;
use Livewire\Component;

use App\Models\Campaign;

class ViewToCollaborate extends Component
{
    public $campaign;
    public $helpDialog;
    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED') {
            $this->campaign = $campaign;
        } else {
            //return redirect()->route('campaign/create');
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.to-collaborate.view-to-collaborate');
    }

    public function openHelp() {
        $this->helpDialog = true;
    }
}
