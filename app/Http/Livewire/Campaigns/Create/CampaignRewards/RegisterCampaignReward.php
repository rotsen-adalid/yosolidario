<?php

namespace App\Http\Livewire\Campaigns\Create\CampaignRewards;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\InteractsWithBanner;

class RegisterCampaignReward extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $status_register;
    public $campaign_reward_id, $image_url, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $photoOne;
    public $currency_symbol;
    public $campaign;
    public $bannerStyle, $message;
    
    public function mount(Campaign $campaign, CampaignReward $campaignReward)
    {
        if($campaign->status == 'DRAFT' and $campaign->user_id == auth()->user()->id) {
            $this->campaign_id = $campaign->id;
            $this->status_register = $campaign->status_register;
            $this->campaign = $campaign;
            $this->currency_symbol = $campaign->agency->agencySetting->money->currency_symbol;
            if($campaignReward->id) {
                $this->edit($campaignReward->id);
            }
        } else {
            //return redirect()->route('campaign/create');
        }
    }

    public function render()
    {
        return view('livewire.campaigns.create.campaign-rewards.register-campaign-reward');
    }
    
    // store or update
    public function StoreOrUpdate() {

        if ($this->limiter == 'YES') {
            $this->validate([
                'amount' => 'required|numeric|min:5|max:999',
                'description' => 'required|min:10|max:250',
                'limiter' => 'required',
                'quantity' => 'required|numeric',
            ]);
        } else {    
            $this->validate([
                'amount' => 'required|numeric|min:5|max:999',
                'description' => 'required|min:10|max:400',
                'limiter' => 'required',
            ]);
            $this->quantity = 0;
        }

        if($this->delivery_date == '') {
            $this->delivery_date = null;
        }

        if($this->campaign_reward_id <= 0) {
            $this->addData();
        } else {
            $this->updateData();
        }

        $this->resetInput();
    }

    // insert data
    public function addData() {
        
        // upload photo
        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
            
            $photo = $this->photoOne->store('public/campaign_rewards_image');
            $this->image_url = Storage::url($photo);

        } else {
            $this->image_url = null;
        }

        // insert data
        $record = CampaignReward::create([
            'image_url' => $this->image_url,
            'amount' => addslashes($this->amount),
            'description' => addslashes($this->description),
            'delivery_date' =>  $this->delivery_date,
            'limiter' => $this->limiter,
            'quantity' => $this->quantity,
            'campaign_id' => $this->campaign_id
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
        $this->banner('Successfully saved!');
        return redirect()->route('campaign/rewards/show', ['campaign' => $this->campaign]);
    }

    // updating data
    public function updateData() {

        // upload photo
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

        // update the info
        $record = CampaignReward::find($this->campaign_reward_id);
        $record->update([
            'image_url' => $this->image_url,
            'amount' => addslashes($this->amount),
            'description' => addslashes($this->description),
            'delivery_date' =>  $this->delivery_date,
            'limiter' => $this->limiter,
            'quantity' => $this->quantity,
        ]);

        // create histories
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

        $this->resetInput();
        $this->banner('Successfully updated!');
        return redirect()->route('campaign/rewards/show', ['campaign' => $this->campaign]);
    }

    // reset input
    public function resetInput() {
        $this->campaign_reward_id = "";
        $this->image_url = "";
        $this->amount = "";
        $this->description = "";
        $this->limiter = "";
        $this->delivery_date = "";
        $this->quantity = "";
        $this->photoOne = null;
    }

    // get data
    public function edit($id) {
        $record = CampaignReward::find($id);
        $this->campaign_reward_id = $record->id;
        $this->image_url = $record->image_url;
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->currency_symbol = $record->campaign->agency->agencySetting->money->currency_symbol;
        $this->delivery_date = $record->delivery_date;
        $this->limiter = $record->limiter;
        $this->quantity = $record->quantity;
    }

    // delete photo
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

    // open delete reward
    public function deleteDialog($id) {
        $this->campaign_reward_id = $id;
        $record = CampaignReward::find($id);
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->currency_symbol = $record->campaign->agency->agencySetting->money->currency_symbol;
        $this->confirmingDeletion = true;
    }

    // delete reward
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
}
