<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DeleteUpdates extends Component
{
    public $campaign_update_id, $agency_id;
    public $deleterDialog;

    public function mount($campaign_update_id, $agency_id) {
        $this->campaign_update_id = $campaign_update_id;
        $this->agency_id = $agency_id;
    }

    public function render()
    {
        return view('livewire.campaigns.manage.updates.delete-updates');
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
                'agency_id' => $this->agency_id
                ]);
        }
        $this->deleterDialog = false;
        $this->emit('render');
    }
}
