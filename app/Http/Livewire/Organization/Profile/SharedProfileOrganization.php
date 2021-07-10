<?php

namespace App\Http\Livewire\Organization\Profile;

use App\Models\Organization;
use Livewire\Component;

class SharedProfileOrganization extends Component
{
    public $organization;
    public $open = false;
    public $embed;
    public $widget = 'large';
    public $copyLarge;
    public $copyMedium;
    public $copySmall;
    public $host, $host_previous;
    public $message;

    public $countUpdates;
    public $buttonShared;

    public $rrssAlpine = true, $embedAlpine = false;

    protected $listeners = ['sharedOpen' => 'sharedOpen'];

    public function render()
    {
        return view('livewire.organization.profile.shared-profile-organization');
    }

    public function sharedOpen($id) {
        $this->open = true;

        if($id) {

            $this->organization = Organization::find($id);
            $this->copyLarge = '<iframe src="https://yosolidario.com/org/'.$this->organization->slug.'/widget/large/?iframe=true" height="350></iframe>';
            $this->copyMedium = '<iframe src="https://yosolidario.com/org/'.$this->organization->slug.'/widget/medium/?iframe=true" height="145"></iframe>';
            $this->copySmall = '<iframe src="https://yosolidario.com/org/'.$this->organization->slug.'/widget/small/?iframe=true" height="60"></iframe>';
                
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $url = $_SERVER['HTTP_REFERER'];
                    $host_array = explode("/",$url);
                    if($host_array[2] != 'yosolidario.test' and $host_array[2] != 'yosolidario.com') {
                        $this->host_previous = $host_array[2];
                        $this->updateShared();
                    }
                }
        }
                                
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
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
