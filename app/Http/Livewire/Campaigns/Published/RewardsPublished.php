<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\Country;

class RewardsPublished extends Component
{
    public $slug;
    public $campaign;
    public $campaign_id;
    public $country;
    public $collection;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'PUBLISHED')
                        ->get();
            if($campaign->count() > 0) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign =  Campaign::find($this->campaign_id);
                $this->country = Country::find($campaign[0]->telephone_country_id);
            } 
        }
    } 

    public function render()
    {
        $this->collection = CampaignReward::
                    where('campaign_id', $this->campaign_id)
                    ->orderBy('amount', 'asc')->get();
                    
        return view('livewire.campaigns.published.rewards-published');
    }

    public function selectedRecognition($id) {

    }
}
