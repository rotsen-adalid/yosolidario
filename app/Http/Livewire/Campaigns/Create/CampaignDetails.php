<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str as Str;
use App\Models\Campaign;
use App\Models\CampaignQuestion;
use App\Models\CampaignReward;
use App\Models\CountryState;
use App\Models\Organization;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Http\Traits\InteractsWithBanner;

class CampaignDetails extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $title, $slug, $extract, $type_campaign, $period = 60, $amount_target, $locality, $user_id, $category_campaign_id, $country_id, $country_state_id, $organization_id, $agency_id;
    public $phone_prefix, $phone, $video_url, $status_register;

    public $collection_category_campaign;
    public $collection_organization;
    public $collection_agency;
    public $collection_agencies;
    public $collection_country_states, $states_denomination = 'State';
    public $currency_symbol, $telephone_prefix;
    public $campaign_id;
    public $campaign;

    public $photoOne;
    public $photo_url;
    
    public $amountOne;
    public $amountTwo;
    public $amountThree;
    public $amountFour;
    public $amountFive;

    public $amount_min;
    public $amount_max;

    public $ipapi;
    public $country_code;
    public $languaje_code;

    public $bannerStyle, $message;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
            $this->campaign_id = $campaign->id;
            $this->status_register = $campaign->status_register;
            $this->campaign = $campaign;
            $this->edit($campaign->id);
        } else {
            //return redirect()->route('home');
        }

        // general values
        $this->ipapi = session()->get('ipapi');
    } 

    public function render()
    { 
        $this->agency();
        $this->collection_agencies = Agency::All();
        $this->collection_category_campaign = DB::table('category_campaigns')->where('status', 'ACTIVE')->get();
        return view('livewire.campaigns.create.campaign-details');
    }

    // create or update
    public function StoreOrUpdate() {
        if($this->campaign_id <= 0) {
            $this->Store();
        } else {
            $this->Update();
        }
    }

    // create
    public function Store() {
        if ($this->type_campaign == 'ORGANIZATION')
        {
            $this->validate([
                'title' => 'required|min:5|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug",
                'photoOne' => 'image|max:2048',
                'extract' => 'required|min:5|max:170',
                'type_campaign' => 'required',
                'organization_id' => 'required',
                'locality' => 'required|min:3|max:100',
                'agency_id' => 'required',
                //'country_id' => 'required',
                'country_state_id' => 'required',
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",
                //'period' => 'required',
                'phone' => 'required|digits_between:7,15',
            ]);
        }
        else {
            $this->validate([
                'title' => 'required|min:5|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug",
                'photoOne' => 'image|max:2048',
                'extract' => 'required|min:5|max:170',
                'type_campaign' => 'required',
                'locality' => 'required|min:3|max:100',
                'agency_id' => 'required',
                //'country_id' => 'required',
                'country_state_id' => 'required',
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",
                //'period' => 'required',

                'phone' => 'required|digits_between:7,15',
            ]);
            $this->organization_id = null;
        }

        if($this->video_url) {
            $this->validate([
                'video_url' => 'required|url'
            ]);
        }

        $search_upper =  strtoupper(
            $this->title.' '.
            $this->slug
            );

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;
        
        // insert data
        $record = Campaign::create([

            'title' => addslashes($this->title),
            'slug' => Str::slug($this->slug),
            'extract' => addslashes($this->extract),
            'type_campaign' => $this->type_campaign,
            'organization_id' => $this->organization_id,
            //'period' => $this->period,
            'views' => 0,
            'shareds' => 0,
            'followers' => 0,
            'locality' => addslashes($this->locality),
            'phone_prefix' => $this->phone_prefix,
            'phone' => $this->phone,

            'user_id' => auth()->user()->id,
            'category_campaign_id' => $this->category_campaign_id,
            'agency_id' => $this->agency_id,
            'country_id' => $this->country_id,
            'country_state_id' => $this->country_state_id,

            'search' => addslashes($search_all),
            
            'status' => 'DRAFT'
        ]);
        $record->campaignCollected()->create([
            'campaign_id' => $record->id,
            'collaborators' => 0,
            'amount_target' => $this->amount_target,
            'amount_collected' => 0,
            'amount_percentage_collected' => 0,
        ]);
        $extract = 'Create campaign: '.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'CREATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            //'agency_id' => 1
            ]);

        if($record->id) {

            $campaign_id = $record->id;
            $this->emit('message');
            $this->message = "Saved correctly";
            
            if($this->photoOne) {
                // upload photo
                $photo = $this->photoOne->store('public/campaign_image');
                $photo_url = Storage::url($photo);
                $record->image()->create([
                    'url' => $photo_url
                ]);
            }
    
            if($this->video_url)
            {
                $record->video()->create([
                    'url' => $this->video_url
                ]);
            }
        }
        $this->createQuestions($campaign_id);
        $this->createRewars($campaign_id);
        $this->banner('Successfully saved!');
        return redirect()->route('campaign/create/questions', ['campaign' => $record]);
    }

    // updatign data
    public function Update() {
        
        if ($this->type_campaign == 'ORGANIZATION')
            $this->validate([
                'title' => 'required|min:5|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                //'photoOne' => 'image|max:2048',
                'extract' => 'required|min:5|max:170',
                'type_campaign' => 'required',
                'organization_id' => 'required',
                'locality' => 'required|min:3|max:100',
                'agency_id' => 'required',
                //'country_id' => 'required',
                'country_state_id' => 'required',
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",
                //'period' => 'required',

                'phone' => 'required|digits_between:7,15',

            ]);
        else {
            $this->validate([
                'title' => 'required|min:5|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                //'photoOne' => 'image|max:2048',
                'extract' => 'required|min:5|max:170',
                'type_campaign' => 'required',
                'locality' => 'required|min:3|max:100',
                'agency_id' => 'required',
                //'country_id' => 'required',
                'country_state_id' => 'required',
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",
                //'period' => 'required',

                'phone' => 'required|digits_between:7,15',
            ]);
            $this->organization_id = null;
        }

        if($this->video_url) {
            $this->validate([
                'video_url' => 'required|url'
            ]);
        }

        $search_upper =  strtoupper(
            $this->title.' '.
            $this->slug
            );

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;

        // if upload photo
        if ($this->photoOne and $this->photo_url == null) {

            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);

            $record_image = Campaign::findOrFail($this->campaign_id);
            $url = str_replace('storage', 'public', $record_image->image->url);
            Storage::delete($url);

            $photo = $this->photoOne->store('public/campaign_image');
            $photo_url = Storage::url($photo);

            $record_image->image()->update([
                'url' => $photo_url
            ]);
        } elseif($this->photoOne == null and $this->photo_url == null) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
        } elseif ($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);

            $record_image = Campaign::findOrFail($this->campaign_id);
            $url = str_replace('storage', 'public', $record_image->image->url);
            Storage::delete($url);

            $photo = $this->photoOne->store('public/campaign_image');
            $photo_url = Storage::url($photo);

            $record_image->image()->update([
                'url' => $photo_url
            ]);
        }

        $record = Campaign::find($this->campaign_id);
        // we update the info
        $record->update([
            'title' => addslashes($this->title),
            'slug' => $this->slug,
            'extract' => addslashes($this->extract),
            'type_campaign' => $this->type_campaign,
            'organization_id' => $this->organization_id,
            //'period' => $this->period,
            'views' => 0,
            'shared' => 0,
            'followers' => 0,
            'locality' => addslashes($this->locality),
            'phone_prefix' => $this->phone_prefix,
            'phone' => $this->phone,

            'user_id' => auth()->user()->id,
            'category_campaign_id' => $this->category_campaign_id,
            'agency_id' =>  $this->agency_id,
            'country_id' => $this->country_id,
            'country_state_id' => $this->country_state_id,
            'search' => addslashes($search_all),
            
            //'status' => 'DRAFT',
            //'status_register' => 'INCOMPLETE'
        ]);
        $record->campaignCollected()->update([
            'amount_target' => $this->amount_target
        ]);
        $extract = 'Update campaign: '.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'UPDATE',
            'user_id' => auth()->user()->id,
            'site_id' => 2,
            //'agency_id' => 1
            ]);

        $this->emit('message');
        $this->message = "Saved correctly";

        if($this->video_url) {
            if($record->video) {
                $record->video()->update([
                    'url' => $this->video_url
                ]);
            } else {
                $record->video()->create([
                    'url' => $this->video_url
                ]);
            }
        }
        $this->banner('Successfully updated!');
        return redirect()->route('campaign/update/questions', ['campaign' => $record]);
    }

    // edit 
    public function edit($id) {
        $record = Campaign::findOrFail($id);
        $this->title = $record->title;
        $this->category_campaign_id = $record->category_campaign_id;
        $this->slug = $record->slug;
        $this->extract = $record->extract;
        $this->type_campaign = $record->type_campaign;
        $this->organization_id = $record->organization_id;
        $this->agency_id = $record->agency_id;
        $this->country_id = $record->country_id;
        $this->country_state_id = $record->country_state_id;
        $this->locality = $record->locality;
        $this->amount_target = $record->campaignCollected->amount_target;
       // $this->period = $record->period;
        $this->phone_prefix = $record->phone_prefix;
        $this->phone = $record->phone;
        $this->status_register =  $record->status_register;

        $this->photo_url = $record->image->url;
        if($record->video) {
            $this->video_url = $record->video->url;
        }
       

        $this->agency($this->agency_id);
    }

    // delete photo one
    public function deleteOne() {
        if($this->campaign_id) {
            $record = Campaign::findOrFail($this->campaign_id);
            $url = str_replace('storage', 'public', $record->image->url);
            Storage::delete($url);
            $record->image()->update([
                'url' => null
            ]);
        }
        $this->photoOne = null;
        $this->photo_url = null;
    }

    // generate slug
    public function generateSlug() {
        if($this->campaign_id <= 0) {
            $this->slug = Str::slug($this->title);
        }
    }

    // select agency
    public function agency() {
        if($this->agency_id) {
            $record = Agency::find($this->agency_id);
            $this->currency_symbol = $record->agencySetting->money->currency_symbol;
            $this->phone_prefix = $record->country->phone_prefix;
            $this->amount_min = $record->agencySetting->amount_min;
            $this->amount_max = $record->agencySetting->amount_max;
            $this->states_denomination =  $record->country->states_denomination;
            $this->country_id = $record->country->id;
            $this->collection_country_states = CountryState::
                where('country_id', $record->country->id)
                ->orderBy('name', 'asc')
                ->get();

            $this->collection_organization = Organization::
                join('organization_agreements', 'organizations.id', '=', 'organization_agreements.organization_id')
                ->where('organization_agreements.status', '=', 'ACTIVE')
                //->where('organizations.agency_id', '=' , $this->agency_id)
                ->get();

        } else {
            $this->currency_symbol = null;
            $this->phone_prefix = null;
            $this->collection_organization = null;
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++ default 
    // create questions
    public function createQuestions($id) {
        $record = CampaignQuestion::create([
            'about' => null,
            'about_url' => null,
            'use_of_money' => null,
            'use_of_money_url' => null,
            'about_organizer' => null,
            'about_organizer_url' => null,
            'delivery_of_awards' => null,
            'delivery_of_awards_url' => null,
            'contact_organizer' => null,
            'contact_organizer_url' => null,
            'campaign_id' =>  $id,
        ]);
    }

    // create rewards default
    public function createRewars($id) {
        $record = Agency::find($this->agency_id);
        $this->currency_symbol = $record->agencySetting->money->currency_symbol;
        if($record->country->code = 'BO') {
            $this->createRewarsBO($id);
        }
     }

     // create rewards BO
     public function createRewarsBO($id) {

        $languaje = 'es';

        if($languaje == 'es') {
            $description_one = "¡Gracias! No hay aportación pequeña cuando se trata de ayudar.";
            $description_two = "¡Muchas gracias! Recibirás un correo personalizado de agradecimiento.";
            $description_three = "¡Wow! Tu aportación es muy valiosa, por eso queremos hacerte llegar un certificado digital de agradecimiento.";
            $description_four = "¡Muchas gracias! Tu aportación está haciendo una gran diferencia. Como agradecimiento te haremos una mención especial en nuestras redes sociales.";
            $description_five = "¡Eres un súper colaborador! Tu aportación significa mucho para la recaudación. Como agradecimiento queremos hacerte llegar un video de agradecimiento + un certificado digital + una mención especial en nuestras redes sociales.";
        }

        if($this->country_id) {
            $this->amountOne = 50;
            $this->amountTwo = 100;
            $this->amountThree = 150;
            $this->amountFour = 200;
            $this->amountFive = 250;
        }

        $recordOne = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountOne,
            'description' => $description_one,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordTwo = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountTwo,
            'description' => $description_two,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordThree = CampaignReward::create([
            'image_url' => null,
            'amount' =>  $this->amountThree,
            'description' => $description_three,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFour = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountFour,
            'description' => $description_four,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFive = CampaignReward::create([
            'image_url' => null,
            'amount' => $this->amountFive,
            'description' => $description_five,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
    }
}

