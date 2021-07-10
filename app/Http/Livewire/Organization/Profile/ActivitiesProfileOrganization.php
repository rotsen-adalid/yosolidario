<?php

namespace App\Http\Livewire\Organization\Profile;

use App\Models\Organization;
use App\Models\OrganizationActivity;
use Livewire\Component;

class ActivitiesProfileOrganization extends Component
{
    public $paginate = 9;
    public $organization, $host;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-org.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://org.yosolidario.com';
        }
    }

    public function render()
    {
        $collection = OrganizationActivity::where('organization_id', $this->organization->id)
                            ->latest('id')
                            ->paginate($this->paginate);
                    return view('livewire.organization.profile.activities-profile-organization',[
                    'collection' => $collection
                    ]);
    }
}
