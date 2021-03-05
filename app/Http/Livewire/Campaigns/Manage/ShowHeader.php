<?php

namespace App\Http\Livewire\Campaigns\Manage;
use Livewire\Component;

use App\Models\Campaign;

class ShowHeader extends Component
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
        $this->campaign =  $campaign;
        $this->copyLarge = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/large/?iframe=true" height="420></iframe>';
        $this->copyMedium = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/medium/?iframe=true" height="245"></iframe>';
        $this->copySmall = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/small/?iframe=true" height="60"></iframe>';
        
        $host = $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.manage.show-header');
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
}
