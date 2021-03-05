<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;

class RewardsPreview extends Component
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
                    
        return view('livewire.campaigns.preview.rewards-preview');
    }
}
