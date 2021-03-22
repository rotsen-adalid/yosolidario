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
    
    public $confirmingSendReview = false;
    public $terms;
    
    public function mount(Campaign $campaign)
    {
        if($campaign->id) {
            $this->campaign_id = $campaign->id;
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
        return view('livewire.menu.navigation-preview');
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

        // +++++++++++++++++++++++++++++++++++++++++++ send review
    //open review
    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

    //send review
    public function sendReview() {
        $this->validate([
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);
        $record = Campaign::find($this->campaign_id);
        // we update the info
        $record->update([
            'status' => 'IN_REVIEW'
        ]);
        if($record->campaignOpeningRequest == null) {
            $record->campaignOpeningRequest()->create([
                'order_number' => time(),
                'date_send' => Carbon::now()
            ]);
            
            $extract = 'Send to campaign review: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'CREATE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                //'agency_id' => 1
                ]);
        } else {
            $record->campaignOpeningRequest()->update([
                'date_send' => Carbon::now()
            ]);
            
            $extract = 'Send to campaign review: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'UPDATE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                //'agency_id' => 1
                ]);
        }
       
        // notification telegram
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $host = 'https://yosolidario.com';
        }

        $notice = new Notice([
            'telegramid' => $record->agency->telegram->çhat_id,
            'notice' => 'Nueva camapaña',
            'linkOne' => $host.'/'.$record->slug,
            'linkTwo' => $host.'/user'.'/'.$record->user->slug,
            'action' => 'CAMPAIGN_IN_REVIEW'
        ]);
        $notice->notify(new TelegramNotification);
        // end notification telegram

        $this->confirmingSendReview = false;
        return redirect()->route('your/campaigns');
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

