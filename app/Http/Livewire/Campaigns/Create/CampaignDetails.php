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
use App\Http\Traits\Utilities;
use App\Http\Traits\Reward;

class CampaignDetails extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;
    use Utilities;
    use Reward;

    public $title, $slug, $extract, $type_campaign, $period, $amount_target, $locality, $user_id, $category_campaign_id, $country_id, $country_state_id, $organization_id, $agency_id;
    public $phone_prefix, $phone, $video_url, $video_iframe, $status_register;

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
        $this->ipapi = $this->ipapiData();
    } 

    public function render()
    { 
        $this->agency();
        $this->collection_agencies = Agency::All();
        $this->collection_category_campaign = DB::table('category_campaigns')->where('status', 'ACTIVE')->get();
        return view('livewire.campaigns.create.campaign-details');
    }

    // validate
    protected $rules = [
        'agency_id' => 'required',
        'amount_target' => 'required|numeric',
        'title' => 'required|min:5|max:60',
        'extract' => 'required|min:5|max:170',
        'category_campaign_id' =>  'required',
        'type_campaign' => 'required',
        'period' => 'required|numeric|between:10, 90',
        'country_state_id' => 'required',
        'locality' => 'required',
        'phone' => 'required|digits_between:7,15',
        // 'slug' => 'required',
        'photoOne' => 'required|image',
        'video_url' => 'nullable|url'
    ];

    protected $messages = [
        //'agency_id.required' => 'The country field is required.',
        //'title.required' => 'The title field is required.',
    ];

    protected $validationAttributes = [
        'title' => '',
        'category_campaign_id' => '',
        'slug' => "",
        'photoOne' => '',
        'extract' => '',
        'type_campaign' => '',
        'organization_id' => '',
        'locality' => '',
        'agency_id' => '',
        //'country_id' => 'required',
        'country_state_id' => '',
        'amount_target' => "",
        'period' => '',
        'phone' => '',
        'video_url' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // create or update
    public function StoreOrUpdate() {

        if($this->video_iframe == null) {
            $this->video_url = null;
        }

        if($this->campaign_id <= 0) {
            $this->Store();
        } else {
            $this->Update();
        }
    }

    // create
    public function Store() {
        
        if($this->type_campaign == 'PERSONAL')
        {
            $this->validate([
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug",
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",

                'agency_id' => 'required',
                'title' => 'required',
                'extract' => 'required',
                'category_campaign_id' =>  'required',
                'type_campaign' => 'required',
                'period' => 'required',
                'country_state_id' => 'required',
                'locality' => 'required',
                'phone' => 'required',
                'photoOne' => 'required|image',
                'video_url' => 'nullable'
            ]);
        } elseif($this->type_campaign == 'ORGANIZATION') {
            $this->validate([
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug",
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",

                'agency_id' => 'required',
                'title' => 'required',
                'extract' => 'required',
                'category_campaign_id' =>  'required',
                'type_campaign' => 'required',
                'period' => 'required',
                'country_state_id' => 'required',
                'locality' => 'required',
                'phone' => 'nullable',
                'photoOne' => 'required|image',
                'video_url' => 'nullable'
            ]);
        }

        $record = Campaign::
                    where('slug', Str::slug($this->slug))
                    ->get();

        if($record->count() > 0)
        {
            $this->emit('bannerDanger', 'Ya existe slug');
            return;
        }

        if ($this->type_campaign != 'ORGANIZATION')
        {
            $this->organization_id = null;
        }

        $record = 
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
            'period' => $this->period,
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
            'collaborators' => 0,
            'amount_target' => $this->amount_target,
            'amount_collected' => 0,
            'amount_percentage_collected' => 0,
        ]);
        $extract = 'Create campaign: '.$record->id;
        /*$record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'CREATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            //'agency_id' => 1
            ]);
        */
        if($record->id) {

            $campaign_id = $record->id;

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
        $this->bannerSuccess('Successfully saved!');
        return redirect()->route('campaign/create/questions', ['campaign' => $record]);
    }

    // updatign data
    public function Update() {
        
        if($this->type_campaign == 'PERSONAL')
        {
            $this->validate([
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",

                'agency_id' => 'required',
                'title' => 'required',
                'extract' => 'required',
                'category_campaign_id' =>  'required',
                'type_campaign' => 'required',
                'period' => 'required',
                'country_state_id' => 'required',
                'locality' => 'required',
                'phone' => 'required',
                //'photoOne' => 'required|image|max:2048',
                'video_url' => 'nullable'
            ]);
        } elseif($this->type_campaign == 'ORGANIZATION') {
            $this->validate([
                'slug' => "required|min:3|max:60|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                'amount_target' => "required|numeric|between:$this->amount_min,$this->amount_max",

                'agency_id' => 'required',
                'title' => 'required',
                'extract' => 'required',
                'category_campaign_id' =>  'required',
                'type_campaign' => 'required',
                'period' => 'required',
                'country_state_id' => 'required',
                'locality' => 'required',
                'phone' => 'nullable',
                //'photoOne' => 'required|image|max:2048',
                'video_url' => 'nullable'
            ]);
        }
        $record = Campaign::
                    where('slug', Str::slug($this->slug))
                    ->where('id', '<>', $this->campaign_id)
                    ->get();

        if($record->count() > 0)
        {
            $this->emit('bannerDanger', 'Ya existe slug');
            return;
        }

        if ($this->type_campaign != 'ORGANIZATION')
        {
            $this->organization_id = null;
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
                'photoOne' => 'image',
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
                'photoOne' => 'image',
            ]);
        } elseif ($this->photoOne) {
            $this->validate([
                'photoOne' => 'image',
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
            'slug' => Str::slug($this->slug),
            'extract' => addslashes($this->extract),
            'type_campaign' => $this->type_campaign,
            'organization_id' => $this->organization_id,
            'period' => $this->period,
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
        /*$record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'UPDATE',
            'user_id' => auth()->user()->id,
            'site_id' => 2,
            //'agency_id' => 1
            ]);
        */
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
        } else {
            if($record->video) {
                $record->video()->delete();
            }
        }
        $this->bannerSuccess('Successfully updated!');
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
        $this->period = $record->period;
        $this->phone_prefix = $record->phone_prefix;
        $this->phone = $record->phone;
        $this->status_register =  $record->status_register;

        $this->photo_url = $record->image->url;
        if($record->video) {
            $this->video_url = $record->video->url;
            $this->urlVideo();
        }
       

        //$this->agency($this->agency_id);
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

        $this->emit('bannerDanger', 'Was removed successfully');
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
                ->where('status', 'ACTIVE')
                ->orderBy('name', 'asc')
                ->get();
            
            $this->collection_organization = Organization::
                join('organization_agreements', 'organizations.id', '=', 'organization_agreements.organization_id')
                ->with('users')
                ->selectRaw('organizations.*')->whereHas('users', function ($query) {
                    $query->where('organization_user.user_id', '=', auth()->user()->id);
                })
                ->where('organization_agreements.status', '=', 'ACTIVE')
                ->orderBy('organizations.created_at', 'desc')
                ->get();
            /*
            $this->collection_organization = Organization::
                join('organization_agreements', 'organizations.id', '=', 'organization_agreements.organization_id')
                ->select('organizations.*')
                ->where('organization_agreements.status', '=', 'ACTIVE')
                //->where('organizations.agency_id', '=' , $this->agency_id)
                ->get();
            */
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

    // convert url video
    public function urlVideo() {
        $url = $this->video_url;
        if(strlen($url) > 48) {
            $video_htttp = explode("/",$url);
            if($video_htttp[2]) {
                if($video_htttp[2] == 'www.facebook.com') {
                    $video_array = explode("=",$url);
                    $this->video_iframe =  $video_array[1];
                } else {
                    $this->video_iframe = $url;
                }
            } else {
                $this->video_iframe = null;
            }
        } else {
            $this->video_iframe = null;
        }
    }
}

