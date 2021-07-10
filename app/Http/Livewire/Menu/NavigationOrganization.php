<?php

namespace App\Http\Livewire\Menu;

use Livewire\Component;
use App\Models\Organization;

class NavigationOrganization extends Component
{
    public $organization;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }
    
    public function render()
    {
        return view('livewire.menu.navigation-organization');
    }

    public function donate($id)
    {
        $record = Organization::find($id);
        return redirect()->route('organization/collaborate', ['organization' => $record]);
    }
}
