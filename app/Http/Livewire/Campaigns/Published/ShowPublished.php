<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;

class ShowPublished extends Component
{
    public $campaign;
    public $shared;
    public $embed;
    public $widget = 'large';
    public $copyLarge;
    public $copyMedium;
    public $copySmall;
    public $host, $host_previous;
    public $message;

    public $countUpdates;

    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->where(function ($query) {
                            $query->
                            where('status', 'IN_REVIEW')
                            ->orWhere('status', 'PUBLISHED');
                        })
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign = Campaign::find($campaign[0]->id);
                $this->copyLarge = '<iframe src="http://yosolidario.com/'.$slug.'/widget/large/?iframe=true" height="420></iframe>';
                $this->copyMedium = '<iframe src="http://yosolidario.com/'.$slug.'/widget/medium/?iframe=true" height="245"></iframe>';
                $this->copySmall = '<iframe src="http://yosolidario.com/'.$slug.'/widget/small/?iframe=true" height="60"></iframe>';
                    
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
        }

        $this->countUpdates =   CampaignUpdate::
                                where('campaign_id', '=' ,$campaign[0]->id)
                                ->get();
                                
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.published.show-published');
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

    // 
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
}
