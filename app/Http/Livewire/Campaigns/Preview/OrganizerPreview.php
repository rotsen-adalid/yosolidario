<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\User;

class OrganizerPreview extends Component
{
    public $campaign;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 
    public function render()
    {
        return view('livewire.campaigns.preview.organizer-preview');
    }
    public function viewUser($user_id) 
    {
        $record = User::find($user_id);
        return redirect()->route('user', ['slug' => $record->slug]);
    }
}
