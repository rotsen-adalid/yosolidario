<?php

namespace App\Http\Livewire\Organization\Profile;

use Livewire\Component;
use App\Models\OrganizationReward;
use App\Models\Organization;

class RewardsOrganization extends Component
{
    public $organization;

    protected $listeners = ['rewards' => 'rewards'];

    public function render()
    {
        if($this->organization)
        {
            $collection = OrganizationReward::
                    where('organization_id', $this->organization->id)
                    ->where('status', 'ACTIVE')
                    ->orderBy('created_at', 'desc')
                    ->get();
        } else {
            $collection = OrganizationReward::
                    where('organization_id', 100000000)
                    ->where('status', 'ACTIVE')
                    ->orderBy('created_at', 'desc')
                    ->get();
        }

        return view('livewire.organization.profile.rewards-organization', 
                    ['collection' => $collection]);
    }

    public function rewards($id)
    {
        $this->organization = Organization::findOrFail($id);
    }

    public function backThisOrganization($organizationId, $rewardId)
    {
        $record_organization = Organization::find($organizationId);
        $record_reward = OrganizationReward::find($rewardId);
        return redirect()->route('organization/collaborate/reward', ['organization' => $record_organization, 'organizationRewardId' => $rewardId]);
    }
}
