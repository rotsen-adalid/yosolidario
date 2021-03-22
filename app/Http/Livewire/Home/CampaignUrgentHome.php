<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;

use App\Models\Campaign;
use Illuminate\Support\Facades\Http;

use App\Models\CampaignUrgent;

class CampaignUrgentHome extends Component
{
    public $campaignUrgentCollection;

    public function render()
    {
        $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        $ipapi = $response->json();

        if ($ipapi != null) {
            $country_code = $ipapi['country_code'];
            // $country_code = 'US';
           if($country_code == 'BO') {
                $collection = CampaignUrgent::
                                join('campaigns', 'campaign_urgents.campaign_id', '=', 'campaigns.id')
                                ->where('campaigns.user_id', '>' , 50)
                                //->orderBy('users.created_at', 'desc')
                                ->get();
           } else {
                $collection = CampaignUrgent::
                                join('campaigns', 'campaign_urgents.campaign_id', '=', 'campaigns.id')
                                // ->where('campaigns.user_id', ' >= ' , 50)
                                ->whereBetween('user_id', [1, 50])
                                ->get();
           }
        } else {
            $collection = [];
        }

        return view('livewire.home.campaign-urgent-home',[
            'collection' => $collection
            ]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/published', ['slug' => $record->slug]);
    }

    public function collaborate() {
        
    }
}
