<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\Country;

class RewardsPublished extends Component
{
    public $campaign;
    public $collection;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        $this->collection = CampaignReward::
                    where('campaign_id', $this->campaign->id)
                    ->orderBy('amount', 'asc')->get();
                    
        return view('livewire.campaigns.published.rewards-published');
    }

    public function selectedRecognition($id) {

    }
}
