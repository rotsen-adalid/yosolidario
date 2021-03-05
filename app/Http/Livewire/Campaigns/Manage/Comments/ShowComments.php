<?php

namespace App\Http\Livewire\Campaigns\Manage\Comments;
use Livewire\Component;

use App\Models\Campaign;

class ShowComments extends Component
{
    public $campaign;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
        } else {
            //return redirect()->route('campaign/create');
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.manage.comments.show-comments');
    }
}
