<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str as Str;
use App\Models\Campaign;
use App\Models\CampaignQuestion;
use App\Models\CampaignRecognition;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class Details extends Component
{
    use WithFileUploads;

    public $title, $slug, $extract, $type_campaign, $period, $amount_target, $locality, $user_id, $category_campaign_id, $country_id, $organization_id;
    public $telephone_country_id, $telephone, $video_url, $status_register;

    public $collection_category_campaign;
    public $collection_organization;
    public $collection_country;
    public $collection_countries;
    public $campaign_id;
    public $campaign;
    public $message;

    public $photoOne;
    public $photo_url;

    public $slug_next;
    public $confirmingSendReview = false;
    
    public $amountOne;
    public $amountTwo;
    public $amountThree;
    public $amountFour;
    public $amountFive;

    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->where('user_id', '=' , auth()->user()->id)
                        ->where('status', '=' , 'DRAFT')
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign = Campaign::find($this->campaign_id);
                $this->slug_next = $slug;
                $this->edit($this->campaign->id);
            } else {
                return redirect()->route('campaign/create');
            }
        }
    } 

    public function render()
    { 
        //App::setLocale('es'); 
        //session()->put('locale', 'es');

        $this->country_id = 1;
        $this->collection_country = Country::findOrFail($this->country_id);
        $this->collection_countries = DB::table('countries')
                                        ->where('status_published_campaign', 'ACTIVE')
                                        ->orderBy('name', 'asc')
                                        ->get();
        $this->collection_category_campaign = DB::table('category_campaigns')->where('status', 'ACTIVE')->get();
        $this->collection_organization = DB::table('organizations')
                                        ->where('status_agreement', 'ACTIVE')
                                        ->where('country_id', $this->country_id)
                                        ->get();
        return view('livewire.campaigns.create.details');
    }

    public function StoreOrUpdate() {

        if($this->campaign_id <= 0) {
            $this->Store();
        } else {
            $this->Update();
        }
    }

    public function Store() {
        if ($this->type_campaign == 'ORGANIZATION')
            $this->validate([
                'title' => 'required|min:10|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:10|max:200|alpha_dash|unique:campaigns,slug",
                'photoOne' => 'image|max:2048',
                'extract' => 'required|min:60|max:170',
                'type_campaign' => 'required',
                'organization_id' => 'required',
                'locality' => 'required|min:3|max:100',
                // 'country_id' => 'required',
                'amount_target' => 'required|numeric|between:3000,200000',
                'period' => 'required',

                'telephone_country_id' => 'required',
                'telephone' => 'required|digits_between:7,15',
                'video_url' => 'required|url'
            ]);
        else {
            $this->validate([
                'title' => 'required|min:10|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:10|max:200|alpha_dash|unique:campaigns,slug",
                'photoOne' => 'image|max:2048',
                'extract' => 'required|min:60|max:170',
                'type_campaign' => 'required',
                'locality' => 'required|min:3|max:100',
                // 'country_id' => 'required',
                'amount_target' => 'required|numeric|between:3000,200000',
                'period' => 'required',

                'telephone_country_id' => 'required',
                'telephone' => 'required|digits_between:7,15',
                'video_url' => 'required|url'
            ]);
            $this->organization_id = null;
        }

        $search_upper =  strtoupper(
            $this->title.' '.
            $this->slug
            );

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;

        $record = Campaign::create([

            'title' => addslashes($this->title),
            'slug' => Str::slug($this->slug),
            'extract' => addslashes($this->extract),
            'type_campaign' => $this->type_campaign,
            'organization_id' => $this->organization_id,
            'period' => $this->period,
            'amount_target' => $this->amount_target,
            'amount_collected' => 0,
            'amount_percentage_collected' => 0,
            'views' => 0,
            'collaborators' => 0,
            'shared' => 0,
            'followers' => 0,
            'locality' => addslashes($this->locality),
            'telephone_country_id' => $this->telephone_country_id,
            'telephone' => $this->telephone,

            'user_id' => auth()->user()->id,
            'category_campaign_id' => $this->category_campaign_id,
            'country_id' => $this->country_id,
            
            'search' => addslashes($search_all),
            
            'status' => 'DRAFT'
        ]);

        $photo = $this->photoOne->store('public/campaign_image');
        $photo_url = Storage::url($photo);

        if($record->id) {

            $campaign_id = $record->id;
            $this->emit('message');
            $this->message = "Saved correctly";
            
            $record->image()->create([
                'url' => $photo_url
            ]);
    
            $record->video()->create([
                'url' => $this->video_url
            ]);
        }
        $this->createQuestions($campaign_id);
        $this->createRewars($campaign_id);

        return redirect()->route('campaign/create/questions', ['slug' => $record->slug]);
    }

    public function Update() {
        
        if ($this->type_campaign == 'ORGANIZATION')
            $this->validate([
                'title' => 'required|min:10|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:200|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                //'photo' => 'image|max:2048',
                'extract' => 'required|min:60|max:170',
                'type_campaign' => 'required',
                'organization_id' => 'required',
                'locality' => 'required|min:3|max:100',
                // 'country_id' => 'required',
                'amount_target' => 'required|numeric|between:3000,200000',
                'period' => 'required',

                'telephone_country_id' => 'required',
                'telephone' => 'required|digits_between:7,15',
                'video_url' => 'required|url'

            ]);
        else {
            $this->validate([
                'title' => 'required|min:10|max:60',
                'category_campaign_id' => 'required',
                'slug' => "required|min:3|max:200|alpha_dash|unique:campaigns,slug,$this->campaign_id",
                //'photo' => 'image|max:2048',
                'extract' => 'required|min:60|max:170',
                'type_campaign' => 'required',
                'locality' => 'required|min:3|max:100',
                // 'country_id' => 'required',
                'amount_target' => 'required|numeric|between:3000,200000',
                'period' => 'required',

                'telephone_country_id' => 'required',
                'telephone' => 'required|digits_between:7,15',
                'video_url' => 'required|url'
            ]);
            $this->organization_id = null;
        }

        $search_upper =  strtoupper(
            $this->title.' '.
            $this->slug
            );

        $search_lower = strtolower($search_upper);
        $search_all =  $search_upper.' '.$search_lower;

        if ($this->photoOne) {

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
            'period' => $this->period,
            'amount_target' => $this->amount_target,
            'amount_collected' => 0,
            'amount_percentage_collected' => 0,
            'views' => 0,
            'collaborators' => 0,
            'shared' => 0,
            'followers' => 0,
            'locality' => addslashes($this->locality),
            'telephone_country_id' => $this->telephone_country_id,
            'telephone' => $this->telephone,

            'user_id' => auth()->user()->id,
            'category_campaign_id' => $this->category_campaign_id,
            'country_id' => $this->country_id,
            
            'search' => addslashes($search_all),
            
            'status' => 'DRAFT',
            //'status_register' => 'INCOMPLETE'
        ]);

        $this->emit('message');
        $this->message = "Saved correctly";

        $record->video()->update([
            'url' => $this->video_url
        ]);

        return redirect()->route('campaign/update/questions', ['slug' => $record->slug]);
    }

    public function edit($id) {
        $record = Campaign::findOrFail($id);
        $this->title = $record->title;
        $this->category_campaign_id = $record->category_campaign_id;
        $this->slug = $record->slug;
        $this->extract = $record->extract;
        $this->type_campaign = $record->type_campaign;
        $this->organization_id = $record->organization_id;
        $this->locality = $record->locality;
        $this->amount_target = $record->amount_target;
        $this->period = $record->period;
        $this->telephone_country_id = $record->telephone_country_id;
        $this->telephone = $record->telephone;
        $this->status_register =  $record->status_register;

        $this->photo_url = $record->image->url;
        $this->video_url = $record->video->url;
    }

    public function deleteOne() {
        if($this->campaign_id > 0) {
            $record = Campaign::findOrFail($this->campaign_id);
            $url = str_replace('storage', 'public', $record->image->url);
            Storage::delete($url);
            $record->image()->update([
                'url' => null
            ]);
        }
        $this->photoOne = null;
    }

    public function generateSlug() {
        if($this->campaign_id <= 0) {
            $this->slug = Str::slug($this->title);
        }
    }
    public function clickOne() {
        //$this->photo_upload = true;
    }

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

    public function createRewars($id) {

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
            $this->amountFive = 200;
        }

        $recordOne = CampaignRecognition::create([
            'image_url' => null,
            'amount' => $this->amountOne,
            'description' => $description_one,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordTwo = CampaignRecognition::create([
            'image_url' => null,
            'amount' => $this->amountTwo,
            'description' => $description_two,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordThree = CampaignRecognition::create([
            'image_url' => null,
            'amount' =>  $this->amountThree,
            'description' => $description_three,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFour = CampaignRecognition::create([
            'image_url' => null,
            'amount' => $this->amountFour,
            'description' => $description_four,
            'delivery_date' => null,
            'limiter' => 'NO',
            'quantity' => 0,
            'collaborators' => 0,
            'campaign_id' => $id,
        ]);
        $recordFive = CampaignRecognition::create([
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

    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

    public function sendReview() {
        $record = Campaign::find($this->campaign_id);
        // we update the info
        $record->update([
            'status' => 'IN_REVIEW'
        ]);
        $this->confirmingSendReview = false;
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('preview', ['slug' => $record->slug]);
    }

    public function editProfile() {
        return redirect()->route('setting/profile');
    }
}
