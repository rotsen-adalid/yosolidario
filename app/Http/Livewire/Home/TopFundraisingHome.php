<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\Money;
use App\Models\User;
use App\Http\Traits\Utilities;
use App\Models\Country;
use App\Models\MoneyConvert;

class TopFundraisingHome extends Component
{
    use Utilities;
    public $country_code;
    public $currency;
    public $ipapi;
    public $host;

    public function mount() {

        $this->ipapi = $this->ipapiData();

        if ($this->ipapi != null) {
            $this->country_code = $this->ipapi['country_code'];
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
        if ($this->ipapi != null) {
            $country_code = $this->ipapi['country_code'];
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
                                ->paginate(6);
           } else {
                                    
                $collection  =   Campaign::
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
                                ->paginate(6);
           }
        } else {
            $collection = [];
        }

        return view('livewire.home.top-fundraising-home',[
                    'collection' => $collection
                    ]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/published', ['campaign' => $record->slug]);
    }
    
    public function viewUser($user_id) 
    {
        $record = User::find($user_id);
        return redirect()->route('user', ['slug' => $record->slug]);
    }

    // redirect campaign discover
    public function discover() {
        return redirect()->route('campaigns/discover');
    }
}
