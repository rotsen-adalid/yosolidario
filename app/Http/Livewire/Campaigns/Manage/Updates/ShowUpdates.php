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
    public $updatesDialog;
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
        $this->updatesDialog = true;
    }

    public function StoreOrUpdate() {
        if($this->campaign_update_id) {
            $this->update();
        } else {
            $this->Add();
        }
    }
    public function Add() {

        $this->validate([
            'title' => 'required|min:3|max:60',
            'body' => 'required',
        ]);

        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
            $photo = $this->photoOne->store('public/campaign_updates_image');
            $this->update_photo_path = Storage::url($photo);
        } else {
            $this->update_photo_path = null;
        }

        $record = Campaign::findOrFail($this->campaign->id);
        $record->campaignUpdates()->create([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
            'update_photo_path' => $this->update_photo_path,
            'user_id' => auth()->user()->id
        ]);

        $extract = 'An update was added to the campaign'.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'CREATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            'agency_id' => $this->campaign->agency->id
            ]);

        $this->resetInput();
        $this->updatesDialog = false;
    }
    public function update() {

        $this->validate([
            'title' => 'required|min:3|max:60',
            'body' => 'required',
        ]);

        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
            $photo = $this->photoOne->store('public/campaign_updates_image');
            $this->update_photo_path = Storage::url($photo);
        }

        $record = CampaignUpdate::findOrFail($this->campaign_update_id);
        $record->update([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
            'update_photo_path' => $this->update_photo_path,
        ]);
        $extract = 'An update is modified'.$record->id;
        $record->userHistories()->create([
            'photo_path' => null,
            'extract' => $extract,
            'data' => $record,
            'action' =>  'CREATE',
            'user_id' => auth()->user()->id,
            'site_id' => 1,
            'agency_id' => $this->campaign->agency->id
            ]);
        $this->resetInput();
        $this->updatesDialog = false;
    }
    public function deleteOne() {
        if($this->campaign_update_id) {
            $record = CampaignUpdate::findOrFail($this->campaign_update_id);
            
            $url = str_replace('storage', 'public', $record->update_photo_path);
            Storage::delete($url);
            $record->update([
                'update_photo_path' => null
            ]);   
        }
        $this->photoOne = null;
        $this->update_photo_path = null;
    }

    public function updateDialog($id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->title = $record->title;
        $this->body = $record->body;
        $this->update_photo_path = $record->update_photo_path;
        $this->updatesDialog = true;
    }

    public function resetInput(){
        $this->campaign_update_id = null;
        $this->title = null;
        $this->body = null;
        $this->update_photo_path = null;
    }

    public function deleteConfirm($id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->deleterDialog = true;
    }

    public function delete() {
        if($this->campaign_update_id) {
            $record = CampaignUpdate::find($this->campaign_update_id);
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
        $this->resetInput();
        $this->deleterDialog = false;
    }
}
