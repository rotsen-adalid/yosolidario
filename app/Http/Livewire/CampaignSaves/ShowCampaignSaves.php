<?php

namespace App\Http\Livewire\CampaignSaves;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignSave;
use App\Models\User;

class ShowCampaignSaves extends Component
{
    public $campaign_follower_id;
    public $paginate = 10;
    public $deleteConfirm;

    public function render()
    {
        $collection = CampaignSave::
                        where('user_id', auth()->user()->id)
                        ->latest('id')
                        ->paginate($this->paginate);

        return view('livewire.campaign-saves.show-campaign-saves',[
                    'collection' => $collection
                    ]);
    }

    public function discoverCampaign() {

    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/published', ['slug' => $record->slug]);
    }

    public function viewUser($user_id) 
    {
        $record = User::find($user_id);
        return redirect()->route('user', ['slug' => $record->slug]);
    }

    public function deleteSave($id) {
        $this->campaign_follower_id = $id;
        $this->deleteConfirm = true;
    }

    public function delete() {
        if($this->campaign_follower_id) {
            $record = CampaignSave::find($this->campaign_follower_id);
            $record->delete();
            $extract = 'Delete campaign follower: '.$record->id;
            $record->userHistories()->create([
                'photo_path' => null,
                'extract' => $extract,
                'data' => $record,
                'action' =>  'DELETE',
                'user_id' => auth()->user()->id,
                'site_id' => 1,
                // 'agency_id' => $this->campaign->agency->id
                ]);
        }
        $this->campaign_follower_id = null;
        $this->deleteConfirm = false;
    }
}
