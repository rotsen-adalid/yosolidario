<?php

namespace App\Http\Livewire\Menu;
use Livewire\Component;

use App\Models\Campaign;

class NavigationCampaignCreate extends Component
{

    public $campaign_id;
    public $campaign;
    public $status_register;
    public $confirmingSendReview = false;
    public $terms;
    
    public function mount(Campaign $campaign)
    {
        if($campaign) {
            
            if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
                $this->campaign_id = $campaign->id;
                $this->status_register = $campaign->status_register;
                $this->campaign = $campaign;
            } else {
                //return redirect()->route('campaign/create');
            }
        }

        // general values
        //$response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        //$this->ipapi = $response->json();
        //$this->country_code = $this->ipapi['country_code'];
        //$this->languaje_code = $this->ipapi['location']['languages'][0]['code'];
    } 

    public function render()
    {
        return view('livewire.menu.navigation-campaign-create');
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/preview', ['slug' => $record->slug]);
    }
}
