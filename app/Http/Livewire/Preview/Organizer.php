<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\Country;

class Organizer extends Component
{
    public $slug;
    public $campaign_id;
    public $campaign;
    public $country;

    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'DRAFT')
                        ->orWhere('status', 'IN_REVIEW')
                        ->get();
            $this->country = Country::find($campaign[0]->telephone_country_id);

            if($campaign->count() > 0) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign =  Campaign::find($this->campaign_id);
            } 
        }
    } 

    public function render()
    {
        return view('livewire.preview.organizer');
    }
}
