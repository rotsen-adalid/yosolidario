<?php

namespace App\Http\Livewire\Fraud\Register;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\Country;
use App\Models\Fraud;

class RegisterFraud extends Component
{
    public $fraud_id, $name, $country_id, $number_phone, $email, $url_campaign, $know_organizer, $know_organizer_describe;
    public $whistleblower, $whistleblower_describe, $whistleblower_other;

    public $collection_countries;
    public $campaign;

    public function mount(Campaign $campaign)
    {
        if($campaign->id) {
            $this->campaign = $campaign;
            $this->url_campaign = 'http://www.yosolidario.com/'.$campaign->slug;
        } 
    }

    public function render()
    {
        $this->collection_countries = Country::all();

        return view('livewire.fraud.register.register-fraud');
    }

    // store or update
    public function Store() {

        $this->validate([
            'name' => 'required',
            'country_id' => 'required',
            'number_phone' => 'required|min:6|max:20',
            'url_campaign' => 'required|url',
            'know_organizer' => 'required',
            'know_organizer_describe' => 'required',
            'whistleblower' => 'required',
            'whistleblower_describe' => 'required'
        ]);

        if($this->whistleblower == 'OTHER') {
            $this->validate([
                'whistleblower_other' => 'required',
            ]);
        }
        if(!$this->whistleblower_other) {
            $this->whistleblower_other = "LEGAL_DISPUTE";
        }
        // insert data
        $record = Fraud::create([
            'name' => addslashes($this->name),
            'country_id' => $this->country_id,
            'number_phone' => $this->number_phone,
            'email' => $this->email,
            'url_campaign' => addslashes($this->url_campaign),
            'know_organizer' =>  $this->know_organizer,
            'know_organizer_describe' => addslashes($this->know_organizer_describe),
            'whistleblower' => $this->whistleblower,
            'whistleblower_describe' => addslashes($this->whistleblower_describe),
            'whistleblower_other' => $this->whistleblower_other,
        ]);

        // create histories
        $extract = 'Create campaign recognition: '.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'CREATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            //'agency_id' => 1
            ]);
        $this->resetInput();

        if($this->campaign) {
            return redirect()->route('campaign/published', ['slug' => $this->campaign->slug]);
        } else {
            return redirect()->route('home');
        }
    }

    private function resetInput() {
        $this->name = null;
        $this->country_id = null;
        $this->number_phone = null;
        $this->email = null;
        $this->url_campaign = null;
        $this->know_organizer = null;
        $this->know_organizer_describe = null;
        $this->whistleblower = null;
        $this->whistleblower_describe = null;
        $this->whistleblower_other = null;
    }
}
