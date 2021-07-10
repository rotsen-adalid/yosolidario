<?php

namespace App\Http\Livewire\Campaigns\Create\CampaignRewards;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\Notice;
use App\Notifications\TelegramNotification;
use Carbon\Carbon;
use Laravel\Jetstream\Jetstream;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowCampaignRewards extends Component
{
    use WithFileUploads;
    public $status_register;
    public $campaign;
    public $bannerStyle, $message;

    protected $listeners = ['render'];

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
                    where('campaign_id', $this->campaign->id)
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
}
