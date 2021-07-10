<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;

class CoverPagePreview extends Component
{
    public $slug;
    public $video_url;
    public $campaign;
    
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
        if($this->campaign->video) {
            $video_array = explode("=",$this->campaign->video->url);
            $this->video_url =  $video_array[1];
        }
        /*
        $this->campaign =  $campaign;
        if($this->campaign->video) {
            $video_array = explode("/",$this->campaign->video->url);
            if($video_array[2] == 'youtu.be') {
                $this->video_url =  $video_array[3];
            }
        }*/
    } 
    public function render()
    {
        return view('livewire.campaigns.preview.cover-page-preview');
    }

    public function video() 
    {
       $response = Http::get('https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F945809259497907%2F&width=500&show_text=false&appId=738141669970459&height=28');

    }
}
