<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class ShowPublished extends Component
{
    public $campaign;
    public $shared;
    public $embed;
    public $widget = 'large';
    public $copyLarge;
    public $copyMedium;
    public $host;
    public $message;

    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign = Campaign::find($campaign[0]->id);
                $this->copyLarge = '<iframe src="http://yosolidario.com/'.$slug.'/widget/large/?iframe=true" height="400></iframe>';
                $this->copyMedium = '<iframe src="http://yosolidario.com/'.$slug.'/widget/medium/?iframe=true" height="220"></iframe>';
            } else {
                return redirect()->route('home');
            }
        }
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario-adm.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'admin.yosolidario.com') {
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

}
