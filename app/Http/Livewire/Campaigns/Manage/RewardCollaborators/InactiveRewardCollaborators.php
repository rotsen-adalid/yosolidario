<?php

namespace App\Http\Livewire\Campaigns\Manage\RewardCollaborators;

use Livewire\Component;
use App\Models\CampaignReward;

class InactiveRewardCollaborators extends Component
{
    public $campaign_reward_id, $image_url, $amount, $description, $delivery_date, $limiter, $quantity, $campaign_id;
    public $recognition_currency_symbol;
    public $open;

    protected $listeners = ['inactiveDialog' => 'inactiveDialog'];

    public function render()
    {
        return view('livewire.campaigns.manage.reward-collaborators.inactive-reward-collaborators');
    }

    public function inactiveDialog($id) {
        $record = CampaignReward::find($id);
        $this->campaign_reward_id = $record->id;
        $this->open = true;
    }

    public function inactive()
    {
        if($this->campaign_reward_id) {
            $record = CampaignReward::find($this->campaign_reward_id);
            $record->update([
                'status' => 'INACTIVE'
            ]);
            $this->open = false;
            $this->emit('render');
            $this->emit('bannerDanger', 'Recompensa agotado');
        }
    }
}
