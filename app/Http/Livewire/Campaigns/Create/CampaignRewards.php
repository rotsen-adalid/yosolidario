<?php

namespace App\Http\Livewire\Campaigns\Create;
use Livewire\Component;

use Illuminate\Support\Facades\DB;
use App\Models\Campaign;
use App\Models\CampaignReward;
use Carbon\Carbon;
use Laravel\Jetstream\Jetstream;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CampaignRewards extends Component
{   
    use WithFileUploads;

    public $status_register;
    public $slug_next;
    // public $collection;
    public $campaign_reward_id, $image_url, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $photoOne;
    public $recognition_currency_symbol;
    public $campaign;
    public $confirmingDeletion = false;
    public $addOrUpdateDialog = false;

    public $confirmingSendReview = false;
    public $terms;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
            $this->campaign_id = $campaign->id;
            $this->status_register = $campaign->status_register;
            $this->campaign = $campaign;
        } else {
            return redirect()->route('campaign/create');
        }
    }
    
    public function render()
    {
        $collection = CampaignReward::
                    where('campaign_id', $this->campaign_id)
                    ->orderBy('amount', 'asc')->get();
            return view('livewire.campaigns.create.campaign-rewards', ['collection' => $collection]);
    }

    public function addDialog() {
        $record = Campaign::find($this->campaign_id);
        $this->recognition_currency_symbol = $record->country->currency_symbol;
        $this->addOrUpdateDialog = true;
    }
    
    public function StoreOrUpdate() {
        if ($this->limiter == 'YES') {
            $this->validate([
                'amount' => 'required|numeric',
                'description' => 'required|min:10|max:250',
                'limiter' => 'required',
                'quantity' => 'required|numeric',
            ]);
        } else {    
            $this->validate([
                'amount' => 'required|numeric',
                'description' => 'required|min:10|max:400',
                'limiter' => 'required',
            ]);
            $this->quantity = 0;
        }

        if($this->delivery_date == '') {
            $this->delivery_date = null;
        }

        if($this->campaign_reward_id <= 0) {
            $this->add();
        } else {
            $this->update();
        }

        $this->resetInput();
        $this->addOrUpdateDialog = false;
    }

    public function add() {
        
        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
            
            $photo = $this->photoOne->store('public/campaign_rewards_image');
            $this->image_url = Storage::url($photo);

        } else {
            $this->image_url = null;
        }

        // create
        $record = CampaignReward::create([
            'image_url' => $this->image_url,
            'amount' => addslashes($this->amount),
            'description' => addslashes($this->description),
            'delivery_date' =>  $this->delivery_date,
            'limiter' => $this->limiter,
            'quantity' => $this->quantity,
            'campaign_id' => $this->campaign_id
        ]);

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
  
    }

    public function update() {

        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
            $record = CampaignReward::findOrFail($this->campaign_reward_id);
            $url = str_replace('storage', 'public', $record->image_url);
            Storage::delete($url);
            $record->update([
                'image_url' => null
            ]);
            $photo = $this->photoOne->store('public/campaign_rewards_image');
            $this->image_url = Storage::url($photo);
        }

        // we look for the record
        $record = CampaignReward::find($this->campaign_reward_id);
        // we update the info
        $record->update([
            'image_url' => $this->image_url,
            'amount' => addslashes($this->amount),
            'description' => addslashes($this->description),
            'delivery_date' =>  $this->delivery_date,
            'limiter' => $this->limiter,
            'quantity' => $this->quantity,
        ]);
        $extract = 'Update campaign recognition: '.$record->id;
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

    public function resetInput() {
        $this->campaign_reward_id = "";
        $this->amount = "";
        $this->description = "";
        $this->limiter = "";
        $this->quantity = "";
    }

    public function editDialog($id) {
        $record = CampaignReward::find($id);
        $this->campaign_reward_id = $record->id;
        $this->image_url = $record->image_url;
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->country->currency_symbol;
        $this->delivery_date = $record->delivery_date;
        $this->limiter = $record->limiter;
        $this->quantity = $record->quantity;
        $this->addOrUpdateDialog = true;
    }

    public function deleteOne() {
        if($this->campaign_reward_id) {
            $record = CampaignReward::findOrFail($this->campaign_reward_id);
            $url = str_replace('storage', 'public', $record->image_url);
            Storage::delete($url);
            $record->update([
                'image_url' => null
            ]);
        }
        $this->photoOne = null;
        $this->image_url = null;
    }

    public function deleteDialog($id) {
        $this->campaign_reward_id = $id;
        $record = CampaignReward::find($id);
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->country->currency_symbol;
        $this->confirmingDeletion = true;
    }

    public function delete($id) {
        if($id) {
            $record = CampaignReward::find($id);
            $record->delete();
            $extract = 'Delete campaign recognition: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'DELETE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                //'agency_id' => 1
                ]);
        }
        $this->resetInput();
        $this->confirmingDeletion = false;
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

