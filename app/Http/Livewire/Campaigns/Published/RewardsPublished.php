<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use Illuminate\Support\Facades\Http;
use App\Models\Money;

class RewardsPublished extends Component
{
    public $campaign;
    public $collection;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;

         //
         $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
         $ipapi = $response->json();
 
         if ($ipapi != null) {
             $this->country_code = $ipapi['country_code'];
         } else {
             $this->country_code = 'US';
         }
         //$this->country_code = 'US';
         $currency = Money::find(2);
         $this->currency = $currency->currency_symbol;    
    } 

    public function render()
    {
        $this->collection = CampaignReward::
                    where('campaign_id', $this->campaign->id)
                    ->orderBy('amount', 'asc')->get();
                    
        return view('livewire.campaigns.published.rewards-published');
    }

    public function selectedRecognition($id) {

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
