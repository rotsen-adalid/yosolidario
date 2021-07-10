<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use Illuminate\Support\Facades\Http;
use App\Models\Money;
use App\Http\Traits\Utilities;

class RewardsPublished extends Component
{
    use Utilities;

    public $campaign;
    public $collection;

    public function mount(Campaign $campaign)
    {
         //
         $ipapi = session()->get('ipapi');
 
         if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        //$this->country_code = 'US';
        $currency = Money::find(2);
        $this->currency = $currency->currency_symbol;   
        
        if ($campaign->agency->country->code == $this->country_code)
        {
            $this->campaign =  $campaign;
        } else {
            if($campaign->campaignSharing)
            {
                $this->campaign =  $campaign->campaignSharing->campaignSharingConvert;
            } else {
                $this->campaign =  $campaign;
            }
        }
    } 

    public function render()
    {
        $this->collection = CampaignReward::
                    where('campaign_id', $this->campaign->id)
                    ->orderBy('amount', 'asc')->get();
                    
        return view('livewire.campaigns.published.rewards-published');
    }

    public function backThisCampaign($campaign_id, $campaign_reward_id) {
        $record_campaign = Campaign::find($campaign_id);
        $record_campaign_reward = CampaignReward::find($campaign_reward_id);

        return redirect()->route('campaign/collaborate/reward', ['campaign' => $record_campaign, 'campaignRewardId' => $campaign_reward_id]);
    }
}   
