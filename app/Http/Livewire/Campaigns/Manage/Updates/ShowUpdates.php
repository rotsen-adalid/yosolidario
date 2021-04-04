<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowUpdates extends Component
{

    public $campaign;

    protected $listeners = ['render'];

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
        } else {
            return redirect()->route('campaign/create');
        }
    } 
    
    public function render()
    {
            $collection = CampaignUpdate::
                        where('campaign_id', $this->campaign->id)
                        ->paginate(8);

        return view('livewire.campaigns.manage.updates.show-updates', compact('collection'));
    }

    // convert url video
    public function urlVideo($url) {
        $video_array = explode("/",$url);
        if($video_array[2] == 'youtu.be') {
            $video_url =  $video_array[3];
        }
        return $video_url;
    }
}
