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
        $collection = Campaign::where('user_id', auth()->user()->id)
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
}
