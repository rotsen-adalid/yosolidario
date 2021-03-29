<?php

namespace App\Http\Livewire\Campaigns\Manage\Panel;
use Livewire\Component;

use App\Models\Campaign;

class PanelManage extends Component
{
    public $campaign;
    public $shared;
    public $message;
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
        return view('livewire.campaigns.manage.panel.panel-manage');
    }

    public function shared() {
        $this->shared = true;
    }

    public function addUpdates() {
        return redirect()->route('campaign/manage/communications/register', ['campaign' => $this->campaign]);
    }

    public function messageCopy() {
        $this->emit('message');
        $this->message = "Copied";
    }
}
