<?php

namespace App\Http\Livewire\Menu;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\Notice;
use App\Notifications\TelegramNotification;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;

class NavigationPreview extends Component
{
    public $campaign, $campaign_id;
    public $shared;
    public $embed;
    public $widget = 'large';
    public $copyLarge;
    public $copyMedium;
    public $copySmall;
    public $host;
    public $message;
    
    public $terms;
    
    public function mount(Campaign $campaign)
    {
        if($campaign->id) {
            $this->campaign_id = $campaign->id;
            $this->campaign = $campaign;
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
        return view('livewire.menu.navigation-preview');
    }

    // redirect preview
    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/preview', ['slug' => $record->slug]);
    }

    // redirect edti prfile
    public function editProfile() {
        return redirect()->route('setting/profile');
    }
}

