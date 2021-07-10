<?php

namespace App\Http\Livewire\Organization\Profile;

use App\Models\Organization;
use Livewire\Component;

class AboutProfileOrganization extends Component
{
    public $organization;

    protected $listeners = ['about' => 'about'];

    public function render()
    {
        return view('livewire.organization.profile.about-profile-organization');
    }

    public function about($id)
    {
        $this->organization = Organization::findOrFail($id);
    }
}
