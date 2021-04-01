<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignSave;
use Illuminate\Support\Facades\Http;
use App\Models\Money;

class CountersPublished extends Component
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

    public $saveStatus;
    public $campaign_save_id;
    public $save_collection;

    public function mount(Campaign $campaign)
    {
        if($campaign->id) {
            $this->campaign = $campaign;
            $this->copyLarge = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/large/?iframe=true" height="420></iframe>';
            $this->copyMedium = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/medium/?iframe=true" height="245"></iframe>';
            $this->copySmall = '<iframe src="http://yosolidario.com/'.$campaign->slug.'/widget/small/?iframe=true" height="60"></iframe>';
        } else {
            // return redirect()->route('home');
        }

        // save consult
        if(auth()->user()) {
            $record =   CampaignSave::
                        where('user_id', auth()->user()->id)
                        ->where('campaign_id', $campaign->id)
                        ->get();
                        if($record->count() == 1) {
                            $this->saveStatus = true;
                            $this->campaign_save_id = $record[0]->id;
                        } else {
                            $this->saveStatus = false;
                        }
        }

        // consult host
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }

        // $this->country_code = 'US';
        $currency = Money::find(2);
        $this->currency = $currency->currency_symbol;        
    } 

    public function render()
    {
        //
        $ipapi = session()->get('ipapi');

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        //$this->country_code = 'US';
        // save collection global 
        $this->save_collection =  CampaignSave::
                            where('campaign_id', $this->campaign->id)
                            ->get();

        return view('livewire.campaigns.published.counters-published');
    }
    
    public function backThisCampaign($campaign_id) {
        $record = Campaign::find($campaign_id);
        return redirect()->route('campaign/collaborate', ['campaign' => $record]);
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

    public function saveCampaign($campaign_id) {

        if(auth()->user()) {
            if($this->campaign->user->id != auth()->user()->id)
            {
                $record = CampaignSave::create([
                    'campaign_id' => $campaign_id,
                    'user_id' => auth()->user()->id 
                ]);
                $this->campaign_save_id = $record->id;
                
                $extract = 'Create campaign save: '.$record->id;
                $record->userHistories()->create([
                    'photo_path' => null,
                    'extract' => $extract,
                    'data' => $record,
                    'action' =>  'CREATE',
                    'user_id' => auth()->user()->id,
                    'site_id' => 1,
                    //'agency_id' => 1
                    ]);
        
                $this->saveStatus = true;
            }
        }
    }

    public function deleteSaveCampaign($campaign_save_id) {
        if($campaign_save_id) {
            $record = CampaignSave::find($campaign_save_id);
            $record->delete();
            $extract = 'Delete campaign follower: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'DELETE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                // 'agency_id' => $this->campaign->agency->id
                ]);
        }
        $this->campaign_save_id = null;
        $this->saveStatus = false;
    }

    // convert
    public function cutLetter($letter, $number) {

        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }
    public function cutLetterTwo($letterOne, $letterTwo, $number) {

        $letter = $letterOne.', '.$letterTwo;
        
        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }

    public function convertCurrency($amount, $buy_usd) {
        if ($amount > 0) {
            $convert = $amount / $buy_usd;
            return $convert;
        } else {
            return $amount;
        }
    }
    // end convert
}
