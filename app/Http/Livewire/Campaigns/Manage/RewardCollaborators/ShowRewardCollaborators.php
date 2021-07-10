<?php

namespace App\Http\Livewire\Campaigns\Manage\RewardCollaborators;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\CampaignReward;

class ShowRewardCollaborators extends Component
{
    public $campaign;
    protected $listeners = ['render'];
    
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
        $collection = CampaignReward::
                    where('campaign_id', $this->campaign->id)
                    ->orderBy('amount', 'asc')->get();
            return view('livewire.campaigns.manage.reward-collaborators.show-reward-collaborators', ['collection' => $collection]);
    }
}
