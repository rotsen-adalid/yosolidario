<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\CampaignRecognition;
use App\Models\Country;

class Recognitions extends Component
{
    public $slug;
    public $campaign;
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
            if($campaign->count() == 1) {
                $this->campaign =  $campaign[0];
                $this->campaign_id = $this->campaign->id;
                $this->country = Country::find($campaign[0]->telephone_country_id);

            } 
        }
    } 

    public function render()
    {
        $this->collection = CampaignRecognition::
                    where('campaign_id', $this->campaign_id)
                    ->orderBy('amount', 'asc')->get();
                    
        return view('livewire.preview.recognitions');
    }

    public function selectedRecognition($id) {

    }
}
