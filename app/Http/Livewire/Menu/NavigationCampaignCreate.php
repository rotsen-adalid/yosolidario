<?php

namespace App\Http\Livewire\Menu;
use Livewire\Component;

use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str as Str;
use App\Models\Campaign;
use App\Models\CampaignQuestion;
use App\Models\CampaignReward;
use App\Models\Notice;
use App\Models\Organization;
use App\Notifications\TelegramNotification;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Http;


class NavigationCampaignCreate extends Component
{
    public $campaign_id;
    public $campaign;
    public $status_register;
    public $confirmingSendReview = false;
    public $terms;
    
    public function mount(Campaign $campaign)
    {
        if($campaign) {
            
            if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
                $this->campaign_id = $campaign->id;
                $this->status_register = $campaign->status_register;
                $this->campaign = $campaign;
            } else {
                //return redirect()->route('campaign/create');
            }
        }

        // general values
        //$response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        //$this->ipapi = $response->json();
        //$this->country_code = $this->ipapi['country_code'];
        //$this->languaje_code = $this->ipapi['location']['languages'][0]['code'];
    } 

    public function render()
    {
        return view('livewire.menu.navigation-campaign-create');
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
