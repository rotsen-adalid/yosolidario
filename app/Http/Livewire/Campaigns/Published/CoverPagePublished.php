<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class CoverPagePublished extends Component
{
    public $slug;
    public $video_url;
    public $campaign;
    
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
        if($this->campaign->video) {
            $video_array = explode("/",$this->campaign->video->url);
            if($video_array[2] == 'youtu.be') {
                $this->video_url =  $video_array[3];
            }
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.published.cover-page-published');
    }
}
