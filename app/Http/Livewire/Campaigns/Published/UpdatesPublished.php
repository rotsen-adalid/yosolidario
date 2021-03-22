<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;

class UpdatesPublished extends Component
{
    public $campaign;
    public $shared;
    public $embed;
    public $widget = 'large';
    public $copyLarge;
    public $copyMedium;
    public $copySmall;
    public $host;
    public $message;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' or $campaign->status == 'IN_REVIEW') {
            $this->campaign = $campaign;
        } else {
            //return redirect()->route('campaign/create');
        }

        if($campaign->id) {
            $this->campaign = $campaign;
            $this->copyLarge = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/large/?iframe=true" height="420></iframe>';
            $this->copyMedium = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/medium/?iframe=true" height="245"></iframe>';
            $this->copySmall = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/small/?iframe=true" height="60"></iframe>';
        } else {
            // return redirect()->route('home');
        }
        
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
    } 
    
    public function render()
    {
        $collection = CampaignUpdate::where('campaign_id', $this->campaign->id)
                    ->latest('id')
                    ->paginate(8);
        return view('livewire.campaigns.published.updates-published',[
                    'collection' => $collection
                    ]);
    }

    public function shared() {
        $this->shared = true;
    }

    public function messageCopy() {
        $this->emit('message');
        $this->message = "Copied";
    }
    public function emberHTML($nro) {
        if($nro == 1) {
            $this->embed = true;
        } elseif($nro == 0) {
            $this->embed = false;
        }
    }

    // convert url video
    public function urlVideo($url) {
        $video_array = explode("/",$url);
        if($video_array[2] == 'youtu.be') {
            $video_url =  $video_array[3];
        }
        return $video_url;
    }
}
