<?php

namespace App\Http\Livewire\Home;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\Money;
use App\Models\User;

class TopFundraisingHome extends Component
{
    public $country_code;
    public $currency;
    
    public function mount() {
        $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        $ipapi = $response->json();

        if ($ipapi != null) {
            $this->country_code = $ipapi['country_code'];
        } else {
            $this->country_code = 'US';
        }
        $currency = Money::find(2);
        $this->currency = $currency->currency_symbol;
    }

    public function render()
    {
        $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
        $ipapi = $response->json();

        if ($ipapi != null) {
            $country_code = $ipapi['country_code'];
            // $country_code = 'US';
           if($country_code == 'BO') {
                $collection =   Campaign::where(function ($query) {
                                    $query->where('status', 'PUBLISHED')
                                        ->orWhere('status', 'IN_REVIEW');
                                })->where(function ($query) {
                                    $query->where('campaigns.user_id', '>' , 50);
                                })
                                ->latest('id')
                                ->paginate(3);
           } else {
                $collection =   Campaign::where(function ($query) {
                                    $query->where('status', 'PUBLISHED')
                                        ->orWhere('status', 'IN_REVIEW');
                                })->where(function ($query) {
                                    // $query->whereBetween('user_id', [1, 50]);
                                    $query->where('campaigns.user_id', '>=' , 1);
                                })
                                ->latest('id')
                                ->paginate(3);
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
        return redirect()->route('campaign/published', ['slug' => $record->slug]);
    }
    
    public function viewUser($user_id) 
    {
        $record = User::find($user_id);
        return redirect()->route('user', ['slug' => $record->slug]);
    }

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

    // redirect campaign discover
    public function discover() {
        return redirect()->route('campaigns/discover');
    }
}
