<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ShowUpdates extends Component
{
    use WithFileUploads;

    public $campaign_update_id, $title, $body, $update_photo_path, $campaign_id;
    public $photoOne;

    public $campaign;
    public $deleterDialog;

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
        $collection = CampaignUpdate::where('campaign_id', $this->campaign->id)
                    ->latest('id')
                    ->paginate(8);

        return view('livewire.campaigns.manage.updates.show-updates',[
                    'collection' => $collection
                    ]);
    }

    public function addUpdates() {
        return redirect()->route('campaign/manage/communications/register', ['campaign' => $this->campaign]);
    }

    public function editUpdates($id) {
        $record = CampaignUpdate::find($id);
        return redirect()->route('campaign/manage/communications/update', ['campaign' => $this->campaign, 'campaignUpdate' => $record]);
    }

    public function deleteConfirm($id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->deleterDialog = true;
    }

    public function delete() {
        if($this->campaign_update_id) {
            $record = CampaignUpdate::find($this->campaign_update_id);
            if($record->image != null) {
                $url = str_replace('storage', 'public', $record->image->url);
                Storage::delete($url);
                $record->image()->delete(); 
            } 
            $record->delete();
            $extract = 'Delete campaign updating: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'DELETE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                'agency_id' => $this->campaign->agency->id
                ]);
        }
        $this->deleterDialog = false;
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
