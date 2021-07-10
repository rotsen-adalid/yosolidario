<?php

namespace App\Http\Livewire\Account\ChangeAccount;

use Livewire\Component;
use App\Models\Organization;
use App\Models\User;
use App\Http\Traits\Utilities;

class ShowChangeAccount extends Component
{
    use Utilities;
    
    public function render()
    {
        return view('livewire.account.change-account.show-change-account');
    }

    public function changeOrganization($id)
    {
        $record = Organization::findOrFail($id);
        $record->organizationSession()->create([
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('organization/campaigns');
    }

    public function changePersonal()
    {
        $record = User::findOrFail(auth()->user()->id);
        $record->organizationSession()->delete();
        return redirect()->route('your/campaigns');
    }
}
