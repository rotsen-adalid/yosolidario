<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;

use App\Models\CampaignUpdate;
use Livewire\Component;

class SharedUpdates extends Component
{
    public $campaignUpdate;

    public function mount($campaignUpdateId) {
        $this->campaignUpdate = CampaignUpdate::find($campaignUpdateId);
    }
    public function render()
    {
        return view('livewire.campaigns.manage.updates.shared-updates');
    }

    // convert url video
    public function urlVideo($url) {
        $video_htttp = explode("/",$url);
        if($video_htttp[2] == 'www.facebook.com') {
            $video_array = explode("=",$url);
            $video_url =  $video_array[1];
        } else {
            $video_url = 0;
        }
        return $video_url;
    }
}
