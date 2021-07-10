<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Campaign;
use App\Models\CampaignUpdate;

class UpdatesPublished extends Component
{
    use WithPagination;

    public $campaign, $campaign_id;
    protected $listeners = ['comunication' => 'update'];
    public $search, $paginate = 2; 

    public function mount(Campaign $campaign)
    {
        //$this->campaign_id = $campaign->id;
    } 
    
    public function render()
    { 
        if($this->campaign_id) {
            $this->campaign = Campaign::find($this->campaign_id);
            $collection = CampaignUpdate::where('campaign_id', $this->campaign_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->paginate);
        } else {
            $this->campaign_id = 0;
            $collection = CampaignUpdate::where('campaign_id', $this->campaign_id)
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->paginate);
        }

        return view('livewire.campaigns.published.updates-published',[
                    'collection' => $collection
                    ]);
    }

    //for searches with paging
    public function updatingSearch(): void 
    {
        $this->gotoPage(1);
    }

    public function resetCollection() {
        //$this->search = "";
        $this->gotoPage(1);
    }

    public function update($campaign_id) {
       $this->campaign_id = $campaign_id;
    }

    // convert url video
    public function urlVideo0($url) {
        $video_array = explode("/",$url);
        if($video_array[2] == 'youtu.be') {
            $video_url =  $video_array[3];
        }
        return $video_url;
    }

    // convert url video
    public function urlVideo($url) {
        $video_htttp = explode("/",$url);
        if($video_htttp[2] == 'www.facebook.com') {
            $video_array = explode("=",$url);
            $video_url =  $video_array[1];
        } else {
            $video_url = 0;
        }
        return $video_url;
    }
}


