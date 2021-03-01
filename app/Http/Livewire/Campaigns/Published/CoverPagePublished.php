<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class CoverPagePublished extends Component
{
    public $slug;
    public $video_url;
    public $campaign;
    
    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'PUBLISHED')
                        ->get();
            if($campaign->count() > 0) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign =  Campaign::find($this->campaign_id);
                $video_array = explode("/",$this->campaign->video->url);
                if($video_array[2] == 'youtu.be') {
                    $this->video_url =  $video_array[3];
                }
            } 
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.published.cover-page-published');
    }
}
