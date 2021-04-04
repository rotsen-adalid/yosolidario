<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\Notice;
use App\Notifications\TelegramNotification;
use Carbon\Carbon;
use Laravel\Jetstream\Jetstream;
use App\Http\Traits\Geolocation;
use App\Http\Traits\InteractsWithBanner;

class SendReview extends Component
{
    use Geolocation;
    use InteractsWithBanner;

    public $campaign_id, $campaign, $status_register;
    public $confirmingSendReview = false;
    public $ipapi;
    public $terms;

    public function mount(Campaign $campaign)
    {
        if($campaign) {
            
            if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
                $this->campaign_id = $campaign->id;
                $this->status_register = $campaign->status_register;
                $this->campaign = $campaign;
                $this->ipapi = session()->get('ipapi');
            } else {
                //return redirect()->route('campaign/create');
            }
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.create.send-review');
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

        // camapign review
        $notice = new Notice([
            'telegramid' => $record->agency->telegram->çhat_id,
            'notice' => 'Campaña para revisar',
            'linkOne' => $host.'/'.$record->slug,
            'linkTwo' => $host.'/user'.'/'.$record->user->slug,
            'action' => 'CAMPAIGN_IN_REVIEW'
        ]);
        $notice->notify(new TelegramNotification);

        // geolocation user
        $notice = new Notice([
            'telegramid' =>  $record->agency->telegram->çhat_id,    //Config::get('services.telegram_id')
            'latitude' => $this->ipapi['latitude'],
            'longitude' => $this->ipapi['longitude'],
            'action' => 'USER_GEOLOCATION'
            
        ]);
        $notice->notify(new TelegramNotification);

        $this->registerGeolocation();
        // end notification telegram

        $this->confirmingSendReview = false;

        $this->banner('Your campaign is published');
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
