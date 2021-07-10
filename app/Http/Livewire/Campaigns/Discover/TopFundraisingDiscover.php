<?php

namespace App\Http\Livewire\Campaigns\Discover;
use Livewire\Component;

use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\Money;
use App\Models\User;
use App\Http\Traits\Utilities;

class TopFundraisingDiscover extends Component
{
    use Utilities;
    
    public $country_code;
    public $currency;
    public $host;
    
    public function mount() {
        $ipapi = $this->ipapiData();

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        //$this->country_code = 'US';
        $currency = Money::find(2);
        $this->currency = $currency->currency_symbol;

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
        $ipapi = $this->ipapiData();

        if ($ipapi != null) {
            $country_code = $ipapi['country_code'];
            // $country_code = 'US';
           if($country_code == 'BO') {
                $collection =   Campaign::
                                join('campaign_collecteds', 'campaign_collecteds.campaign_id', '=', 'campaigns.id')
                                ->select('campaigns.*')
                                ->where(function ($query) {
                                    $query->where('campaigns.status', 'PUBLISHED')
                                        ->orWhere('campaigns.status', 'IN_REVIEW');
                                })
                                ->where(function ($query) {
                                    $query->where('campaigns.type', '<>' , 'SHARING');
                                })
                                ->latest('campaign_collecteds.amount_collected')
                                ->paginate(12);
           } else {
                $collection =   Campaign::
                                join('campaign_collecteds', 'campaign_collecteds.campaign_id', '=', 'campaigns.id')
                                ->select('campaigns.*')
                                ->where(function ($query) {
                                    $query->where('campaigns.status', 'PUBLISHED')
                                        ->orWhere('campaigns.status', 'IN_REVIEW');
                                })
                                ->where(function ($query) {
                                    $query->where('campaigns.type', '<>' , 'SHARING');
                                })
                                ->latest('campaign_collecteds.amount_collected')
                                ->paginate(12);
           }
        } else {
            $collection = [];
        }

        return view('livewire.campaigns.discover.top-fundraising-discover',[
                    'collection' => $collection
                    ]);

    }
    public function view($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/published', ['campaign' => $record]);
    }
    
    public function viewUser($user_id) 
    {
        $record = User::find($user_id);
        return redirect()->route('user', ['user' => $record]);
    }

    // redirect campaign discover
    public function discover() {
        return redirect()->route('campaigns/discover');
    }
}

