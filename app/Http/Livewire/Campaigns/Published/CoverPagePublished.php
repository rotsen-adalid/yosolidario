<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class CoverPagePublished extends Component
{
    public $slug;
    public $video_url;
    public $campaign;
    public $host;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
        if($this->campaign->video) {
            $video_array = explode("=",$this->campaign->video->url);
            $this->video_url =  $video_array[1];
        }

        // consult host
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-charity.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://charity.yosolidario.com';
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.published.cover-page-published');
    }
}
