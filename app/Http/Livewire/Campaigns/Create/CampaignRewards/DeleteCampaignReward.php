<?php

namespace App\Http\Livewire\Campaigns\Create\CampaignRewards;
use Livewire\Component;
use App\Models\CampaignReward;

class DeleteCampaignReward extends Component
{
    public $campaign_reward_id, $image_url, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $recognition_currency_symbol;
    public $open;

    protected $listeners = ['deleteDialog' => 'deleteOpen'];

    public function render()
    {
        return view('livewire.campaigns.create.campaign-rewards.delete-campaign-reward');
    }

    // open delete reward
    public function deleteOpen($id) {
        $this->campaign_reward_id = $id;
        $record = CampaignReward::find($id);
        $this->amount = $record->amount;
        $this->description = $record->description;
        $this->recognition_currency_symbol = $record->campaign->agency->agencySetting->money->currency_symbol;
        $this->open = true;
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
        
        $this->open = false;
        $this->emit('render');
        $this->emit('bannerDanger', 'Was removed successfully');
        //$this->emitTo('campaigns.create.campaign-rewards.delete-campaign-reward', 'deleteBanner');
    }
}
