<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DeleteUpdates extends Component
{
    public $campaign;
    public $campaign_update_id, $agency_id;
    public $open;

    protected $listeners = ['deleteDialog' => 'deleteOpen'];

    public function mount() {
        $this->campaign_update_id = 1;
    }

    public function render()
    {
        return view('livewire.campaigns.manage.updates.delete-updates');
    }

    public function deleteOpen($campaign_id, $id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->title = $record->title;
        $this->open = true;

        $record = Campaign::find($campaign_id);
        $this->campaign = $record;
    }

    public function delete() {
        if($this->campaign_update_id) {
            $record = CampaignUpdate::find($this->campaign_update_id);
            if($record->image) {
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
        $this->reset();
        $this->emitTo('campaigns.manage.updates.show-updates','render');
    }
}
