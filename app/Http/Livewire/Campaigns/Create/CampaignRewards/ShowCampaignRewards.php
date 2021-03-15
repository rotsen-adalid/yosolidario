<?php

namespace App\Http\Livewire\Campaigns\Create\CampaignRewards;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use Carbon\Carbon;
use Laravel\Jetstream\Jetstream;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowCampaignRewards extends Component
{
    use WithFileUploads;

    public $status_register;
    public $campaign_reward_id, $image_url, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $photoOne;
    public $recognition_currency_symbol;
    public $campaign;
    public $confirmingDeletion = false;
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
            return view('livewire.campaigns.create.campaign-rewards.show-campaign-rewards', ['collection' => $collection]);
    }

    // redirect register 
    public function register() {
        return redirect()->route('campaign/rewards/register', ['campaign' => $this->campaign]);
    }

    // redirect register 
    public function edit($id) {
        $record = CampaignReward::find($id);
        return redirect()->route('campaign/rewards/update', ['campaign' => $this->campaign, 'campaignReward' => $record]);
    }
    // open delete reward
    public function deleteDialog($id) {
        $this->campaign_reward_id = $id;
        $record = CampaignReward::find($id);
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->agency->agencySetting->money->currency_symbol;
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
        $this->confirmingDeletion = false;
    }

    // +++++++++++++++++++++++++++++++++++++++++++ send review
    //open review
    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

    //send review
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
        return redirect()->route('your/campaigns');
    }

    // redirect preview
    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/preview', ['slug' => $record->slug]);
    }

    // redirect edti prfile
    public function editProfile() {
        return redirect()->route('setting/profile');
    }

}
