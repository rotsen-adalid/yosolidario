<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\Country;

class Rewards extends Component
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
                        ->where('status', 'DRAFT')
                        ->orWhere('status', 'IN_REVIEW')
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
                    
        return view('livewire.preview.rewards');
    }

    public function selectedRecognition($id) {

    }
}

