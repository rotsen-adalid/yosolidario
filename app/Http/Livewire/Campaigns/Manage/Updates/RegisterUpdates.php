<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\InteractsWithBanner;

class RegisterUpdates extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $campaign;
    public $campaign_update_id, $title, $body, $update_photo_path, $campaign_id, $video_url;
    public $photoOne;
    public $formAlpine = true, $optionAlpine = true, $photoAlpine = false, $videoAlpine = false;
    public $photoName = null, $photoPreview = null;

    public $video_iframe;

    public function mount(Campaign $campaign, CampaignUpdate $campaignUpdate)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
            if($campaignUpdate->id) {
                $this->campaign_update_id = $campaignUpdate->id;
                $this->edit($campaign->id, $campaignUpdate->id);
            }
        } else {
            return redirect()->route('campaign/create');
        }
    }

    public function render()
    {
        return view('livewire.campaigns.manage.updates.register-updates');
    }

    // validate
    protected $rules = [
        'body' => 'required|min:5|max:2000',
        'photoOne' => 'nullable|image|max:2048',
        'video_url' => 'nullable|url'
    ];

    protected $messages = [
        //'agency_id.required' => 'The country field is required.',
    ];

    protected $validationAttributes = [
        'about' => '',
        'photoOne' => '',
        'video_url' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit($campaign_id, $id) {
        $record = CampaignUpdate::find($id);
        $this->campaign_update_id = $record->id;
        $this->title = $record->title;
        $this->body = $record->body;
        if($record->image){
            $this->update_photo_path = $record->image->url;
            $this->photoAlpine = true;
            $this->optionAlpine = false;
        } else {
            $this->update_photo_path = null;
        }
        if($record->video) {
            $this->video_url = $record->video->url;
            $this->urlVideo();
            $this->videoAlpine = true;
            $this->optionAlpine = false;
        } else {
            $this->video_url = null;
        }
        $record = Campaign::find($campaign_id);
        $this->campaign = $record;
    }

    public function StoreOrUpdate() {

        $this->validate();

        if($this->campaign_update_id) {
            $this->update();
        } else {
            $this->save();
        } 
        //$this->reset();
    }

    public function save() 
    {
        $record = CampaignUpdate::create([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
            'user_id' => auth()->user()->id,
            'campaign_id' => $this->campaign->id
        ]);

        if($this->video_url) {
            $this->photoOne = null;
        } elseif($this->photoOne) {
            $this->video_url = null;
        }

        if($this->photoOne) {
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

        $this->bannerSuccess('Successfully saved!');
        return redirect()->route('campaign/manage/communications/show', ['campaign' => $this->campaign]);
    }

    public function update() 
    {
        $record = CampaignUpdate::find($this->campaign_update_id);
        $record->update([
            'title' => addslashes($this->title),
            'body' => addslashes($this->body),
        ]);

        if($record->id and $this->photoOne) {
            // upload photo
            if($record->image) {
                $url = str_replace('storage', 'public', $record->image->url);
                Storage::delete($url);
                $photo = $this->photoOne->store('public/campaign_updates_image');
                $photo_url = Storage::url($photo);
                $record->image()->update([
                    'url' => $photo_url
                ]);
            } else {
                $photo = $this->photoOne->store('public/campaign_updates_image');
                $photo_url = Storage::url($photo);
                $record->image()->create([
                    'url' => $photo_url
                ]);
            }

            // updating video
            if($record->video) {
                $record->video()->delete();
            }
        }

        if($record->id and $this->video_url) {
            if($record->video) {
                $record->video()->update([
                    'url' => $this->video_url
                ]);
            }else {
                $record->video()->create([
                    'url' => $this->video_url
                ]);
            }

            // updating video
            if($record->image) {
                $record->image()->delete();
            }
        }

        if(!$this->video_url) {
            if($record->video) {
                $record->video()->delete();
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

        $this->bannerSuccess('Successfully updated!');
        return redirect()->route('campaign/manage/communications/show', ['campaign' => $this->campaign]);
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

    // convert url video
    public function urlVideo() {
        $url = $this->video_url;
        if(strlen($url) > 48) {
            $video_htttp = explode("/",$url);
            if($video_htttp[2]) {
                if($video_htttp[2] == 'www.facebook.com') {
                    $video_array = explode("=",$url);
                    $this->video_iframe =  $video_array[1];
                } else {
                    $this->video_iframe = $url;
                }
            } else {
                $this->video_iframe = null;
            }
        } else {
            $this->video_iframe = null;
        }
    }
}

