<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class RegisterUpdates extends Component
{
    use WithFileUploads;

    public $campaign_update_id, $title, $body, $update_photo_path, $campaign_id, $video_url;
    public $photoOne;

    public $campaign;

    public function mount(Campaign $campaign, CampaignUpdate $campaignUpdate)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
            if($campaignUpdate->id) {
                $this->edit($campaignUpdate->id);
            }
        } else {
            return redirect()->route('campaign/create');
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.manage.updates.register-updates');
    }

    public function StoreOrUpdate() {

        $this->validate([
            'title' => 'required|min:3|max:60',
            'body' => 'required',
        ]);

        if($this->photoOne) {
            $this->validate([
                'photoOne' => 'image|max:2048',
            ]);
        }

        if($this->campaign_update_id) {
            $this->update();
        } else {
            $this->Add();
        } 
        return redirect()->route('campaign/manage/communications/show', ['campaign' => $this->campaign]);
    }

    public function Add() {

        $record = CampaignUpdate::create([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
            'user_id' => auth()->user()->id,
            'campaign_id' => $this->campaign->id
        ]);
        if($record->id and $this->photoOne) {
            // upload photo
            $photo = $this->photoOne->store('public/campaign_updates_image');
            $photo_url = Storage::url($photo);
            $record->image()->create([
                'url' => $photo_url
            ]);
        }

        if($this->video_url) {
            $record->video()->create([
                'url' => $this->video_url
            ]);
        }

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
    }

    public function update() {

        $record = CampaignUpdate::findOrFail($this->campaign_update_id);
        $record->update([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
        ]);

        if($record->id and $this->photoOne) {
            // upload photo
            if($record->image == null) {
                $photo = $this->photoOne->store('public/campaign_updates_image');
                $photo_url = Storage::url($photo);
                $record->image()->create([
                    'url' => $photo_url
                ]);
            } else {
                $url = str_replace('storage', 'public', $record->image->url);
                Storage::delete($url);
                $photo = $this->photoOne->store('public/campaign_updates_image');
                $photo_url = Storage::url($photo);
                $record->image()->update([
                    'url' => $photo_url
                ]);
            }
        }

        if($this->video_url) {
            if($record->video) {
                $record->video()->update([
                    'url' => $this->video_url
                ]);
            }else {
                $record->video()->create([
                    'url' => $this->video_url
                ]);
            }
        }
        
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
            if($record->image) {
                $url = str_replace('storage', 'public', $record->image->url);
                Storage::delete($url);
                $record->image()->delete(); 
            }  
        }
        $this->photoOne = null;
        $this->update_photo_path = null;
    }

    public function edit($id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->title = $record->title;
        $this->body = $record->body;
        if($record->image != null){
            $this->update_photo_path = $record->image->url;
        } else {
            $this->update_photo_path = null;
        }
        if($record->video) {
            $this->video_url = $record->video->url;
        } else {
            $this->video_url = null;
        }
    }

    public function resetInput(){
        $this->campaign_update_id = null;
        $this->title = null;
        $this->body = null;
        $this->update_photo_path = null;
    }
}

