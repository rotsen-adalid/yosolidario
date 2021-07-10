<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;

use App\Models\Campaign;
use Illuminate\Support\Facades\Http;

use App\Models\CampaignUrgent;
use App\Http\Traits\Utilities;

class CampaignUrgentHome extends Component
{
    use Utilities;

    public $campaignUrgentCollection;

    public function render()
    {
        //$response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        $ipapi = $this->ipapiData();
        
        if ($ipapi != null) {
            $country_code = $ipapi['country_code'];
            // $country_code = 'US';
           if($country_code == 'BO') {
                $collection = CampaignUrgent::
                                join('campaigns', 'campaign_urgents.campaign_id', '=', 'campaigns.id')
                                ->where(function ($query) {
                                    $query->where('campaigns.type', '<>' , 'SHARING');
                                })
                                ->first();
           } else {
                $collection = CampaignUrgent::
                                join('campaigns', 'campaign_urgents.campaign_id', '=', 'campaigns.id')
                                ->where(function ($query) {
                                    $query->where('campaigns.type', '<>' , 'SHARING');
                                })
                                ->first();
           }
        } else {
            $collection = CampaignUrgent::
                        join('campaigns', 'campaign_urgents.campaign_id', '=', 'campaigns.id')
                        ->where(function ($query) {
                            $query->where('campaigns.type', '<>' , 'SHARING');
                        })
                        ->first();
        }

        return view('livewire.home.campaign-urgent-home',[
            'collection' => $collection
            ]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/published', ['slug' => $record->slug]);
    }

    public function backThisCampaign($campaign_id) {
        $record = Campaign::find($campaign_id);
        return redirect()->route('campaign/collaborate', ['campaign' => $record]);
    }
}
