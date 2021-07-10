<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Http\Traits\Utilities;

class ShowPublished extends Component
{
    use Utilities;
    
    public $campaign;
    public $host, $host_previous;
    public $country_code;

    public $countUpdates;

    public $updateOpen = false;

    public function mount(Campaign $campaign)
    {
        if($campaign != null) {
            $campaign = Campaign::
                    where('slug', '=' ,$campaign->slug)
                    ->where(function ($query) {
                        $query->
                        where('status', 'IN_REVIEW')
                        ->orWhere('status', 'PUBLISHED');
                    })
                    ->first();

            $this->campaign = Campaign::find($campaign->id);

                if(isset($_SERVER['HTTP_REFERER'])) {
                    $url = $_SERVER['HTTP_REFERER'];
                    $host_array = explode("/",$url);
                    if($host_array[2] != 'yosolidario.test' and $host_array[2] != 'yosolidario.com') {
                        $this->host_previous = $host_array[2];
                        $this->updateShared();
                    }
                }
                    
            
        } else {
            return redirect()->route('home');
        }

        $this->countUpdates =   CampaignUpdate::
                                where('campaign_id', '=' ,$campaign->id)
                                ->get();
                                
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }

        //
        $ipapi = $this->ipapiData();

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.published.show-published');
    }

    public function updateShared() {
        
        if($this->campaign->id) {
            $record = Campaign::find($this->campaign->id);
            $count_shared = $this->campaign->shareds;

            if(is_numeric($count_shared)) {
                $sum_shared = $count_shared + 1;
                $record->update([
                    'shareds' => $sum_shared,
                ]);
                $this->host_previous  = $sum_shared;
            }
        }
    }

    public function backThisCampaign($campaign_id) {
        $record = Campaign::find($campaign_id);
        return redirect()->route('campaign/collaborate', ['campaign' => $record]);
    }

    public function updateTab() {
        $this->updateOpen = true;
    }
}
