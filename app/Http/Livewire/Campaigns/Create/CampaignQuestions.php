<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Models\Campaign;
use App\Models\CampaignQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Jetstream;

class CampaignQuestions extends Component
{
    use WithFileUploads;

    public $status_register;
    public $about, $about_url, $use_of_money, $use_of_money_url, $about_organizer, $about_organizer_url;
    public $delivery_of_rewards, $delivery_of_rewards_url, $contact_organizer, $contact_organizer_url, $campaign_id;
    public $question_title_add, $question_body_add, $question_url_add;
    public $campaign_question_id;
    public $campaign;
    public $message;
    public $question_url_add_upload;

    public $slug;
    public $about_url_one = false;

    public $photoOne;
    public $photoTwo;
    public $photoThree;
    public $photoFour;
    public $photoFive;
    public $photoSix;

    public $file;
    public $filerespuesta;
    public $confirmingSendReview = false;

    public $terms;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
            $this->campaign_id = $campaign->id;
            $this->status_register = $campaign->status_register;
            $this->campaign = $campaign;
            $this->edit($campaign->campaignQuestion->id);
        } else {
            return redirect()->route('campaign/create');
        }
    }
    public function render()
    { 
        return view('livewire.campaigns.create.campaign-questions');
    }
    public function edit($id) {
        $record = CampaignQuestion::find($id);
        $this->campaign_question_id = $record->id;
        $this->about = addslashes($record->about);
        $this->about_url = $record->about_url;
        $this->use_of_money = addslashes($record->use_of_money);
        $this->use_of_money_url = $record->use_of_money_url;
        $this->about_organizer = addslashes($record->about_organizer);
        $this->about_organizer_url = $record->about_organizer_url;
        $this->delivery_of_rewards = addslashes($record->delivery_of_rewards);
        $this->delivery_of_rewards_url = $record->delivery_of_rewards_url;
        $this->contact_organizer = addslashes($record->contact_organizer);
        $this->contact_organizer_url = $record->contact_organizer_url;

        $this->question_title_add = addslashes($record->question_title_add);
        $this->question_body_add = addslashes($record->question_body_add);
        $this->question_url_add = $record->question_url_add;

        $this->campaign_id =  $record->campaign_id;
    }

    public function StoreOrUpdate() {

        $this->validate([
            'about' => 'required|min:50|max:5000',
            // 'photoOne' => 'image|max:2048',
            'use_of_money' => 'required|min:50|max:5000',
            //*'photoTwo' => 'image|max:2048',
            'about_organizer' => 'required|min:50|max:5000',
            //'photoThree' => 'image|max:2048',
            'delivery_of_rewards' => 'required|min:50|max:5000',
            //*'photoFour' => 'image|max:2048',
            'contact_organizer' => 'required|min:10|max:1000',
            //*'photoFive' => 'image|max:2048',
        ]);

        if($this->photoOne) {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->about_url);
            Storage::delete($url);
            $record->update([
                'about_url' => null
            ]);
            $photo = $this->photoOne->store('public/campaign_question_image');
            $this->about_url_upload = Storage::url($photo);

        } else {
            $this->about_url_upload = $this->about_url;
        }
        if($this->photoTwo) {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->use_of_money_url);
            Storage::delete($url);
            $record->update([
                'use_of_money_url' => null
            ]);
            $photo = $this->photoTwo->store('public/campaign_question_image');
            $this->use_of_money_url_upload = Storage::url($photo);
        } else {
            $this->use_of_money_url_upload =  $this->use_of_money_url;
        }
        if($this->photoThree) {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->about_organizer_url);
            Storage::delete($url);
            $record->update([
                'about_organizer_url' => null
            ]);
            $photo = $this->photoThree->store('public/campaign_question_image');
            $this->about_organizer_url_upload = Storage::url($photo);
        } else {
            $this->about_organizer_url_upload =  $this->about_organizer_url;
        }
        if($this->photoFour) {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->delivery_of_rewards_url);
            Storage::delete($url);
            $record->update([
                'delivery_of_rewards_url' => null
            ]);
            $photo = $this->photoFour->store('public/campaign_question_image');
            $this->delivery_of_rewards_url_upload = Storage::url($photo);
        } else {
            $this->delivery_of_rewards_url_upload = $this->delivery_of_rewards_url;
        }
        if($this->photoFive) {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->contact_organizer_url);
            Storage::delete($url);
            $record->update([
                'contact_organizer_url' => null
            ]);
            $photo = $this->photoFive->store('public/campaign_question_image');
            $this->contact_organizer_url_upload = Storage::url($photo);
        } else {
            $this->contact_organizer_url_upload =  $this->contact_organizer_url;
        }
        if(strlen($this->question_title_add) > 0) {
            if($this->photoSix) {
                $record = CampaignQuestion::findOrFail($this->campaign_question_id);
                $url = str_replace('storage', 'public', $record->question_url_add);
                Storage::delete($url);
                $record->update([
                    'question_url_add' => null
                ]);
                $photo = $this->photoSix->store('public/campaign_question_image');
                $this->question_url_add_upload = Storage::url($photo);
            } else {
                $this->question_url_add_upload = $this->question_url_add;
            }
        } else {
            $record = CampaignQuestion::findOrFail($this->campaign_question_id);
            $url = str_replace('storage', 'public', $record->question_url_add);
            Storage::delete($url);
            $record->update([
                'question_url_add' => null
            ]);
            $this->photoSix = null;
            $this->question_url_add = null;
            $this->question_title_add = null;
            $this->question_body_add = null;
            $this->question_url_add_upload = null;
        }
        $record = CampaignQuestion::find($this->campaign_question_id);
        // we update the info
        $record->update([
            'about' => addslashes($this->about),
            'about_url' => $this->about_url_upload,
            'use_of_money' => addslashes($this->use_of_money),
            'use_of_money_url' => $this->use_of_money_url_upload,
            'about_organizer' => addslashes($this->about_organizer),
            'about_organizer_url' => $this->about_organizer_url_upload,
            'delivery_of_rewards' => addslashes($this->delivery_of_rewards),
            'delivery_of_rewards_url' => $this->delivery_of_rewards_url_upload,
            'contact_organizer' => addslashes($this->contact_organizer),
            'contact_organizer_url' => $this->contact_organizer_url_upload,

            'question_title_add' => addslashes($this->question_title_add),
            'question_body_add' => addslashes($this->question_body_add),
            'question_url_add' => $this->question_url_add_upload,
            // 'campaign_id' =>  $this->campaign_id,
        ]);
        $extract = 'Update campaign questions: '.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'UPDATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            //'agency_id' => 1
            ]);

        if ($this->status_register == 'INCOMPLETE') {
            $record_campaign = Campaign::find($this->campaign_id);
            $record_campaign->update([
                'status_register' => 'COMPLETE'
            ]);
        }
        return redirect()->route('campaign/update/rewards', ['campaign' => $this->campaign]);
    }

    public function deleteOne() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->about_url);
        Storage::delete($url);
        $record->update([
            'about_url' => null
        ]);
        $this->photoOne = null;
        $this->about_url = null;
    }
    public function deleteTwo() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->use_of_money_url);
        Storage::delete($url);
        $record->update([
            'use_of_money_url' => null
        ]);
        $this->photoTwo = null;
        $this->use_of_money_url = null;
    }
    public function deleteThree() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->about_organizer_url);
        Storage::delete($url);
        $record->update([
            'about_organizer_url' => null
        ]);
        $this->photoThree = null;
        $this->about_organizer_url = null;
    }
    public function deleteFour() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->delivery_of_rewards_url);
        Storage::delete($url);
        $record->update([
            'delivery_of_rewards_url' => null
        ]);
        $this->photoFour = null;
        $this->delivery_of_rewards_url = null;
    }
    public function deleteFive() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->contact_organizer_url);
        Storage::delete($url);
        $record->update([
            'contact_organizer_url' => null
        ]);
        $this->photoFive = null;
        $this->contact_organizer_url = null;
    }

    public function deleteSix() {
        $record = CampaignQuestion::findOrFail($this->campaign_question_id);
        $url = str_replace('storage', 'public', $record->question_url_add);
        Storage::delete($url);
        $record->update([
            'question_url_add' => null
        ]);
        $this->photoSix = null;
        $this->question_url_add = null;
    }

    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

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
        $this->confirmingSendReview = false;
        return redirect()->route('my/campaigns');
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaigns/preview', ['slug' => $record->slug]);
    }

    public function editProfile() {
        return redirect()->route('setting/profile');
    }
}
