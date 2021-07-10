<?php

namespace App\Http\Livewire\Campaigns\Manage\Updates;
use Livewire\Component;
use App\Http\Traits\InteractsWithBanner;
use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\CampaignUpdate;
use Livewire\WithPagination;

class ShowUpdates extends Component
{
    use WithPagination;
    use InteractsWithBanner;

    public $campaign;
    public $sort = 'id', $direction = 'desc';
    public $search, $paginate = 2; 
    public $imgModalUpdates = false, $imgModalSrcUpdates = '', $imgModalDescUpdates = '';
    protected $listeners = ['render', 'render', 'saveUpdate', 'saveUpdate'];

    public $bannerStyle, $message;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
        } else {
            return redirect()->route('campaign/create');
        }
        //$this->saveComunication();
    } 
    
    public function render()
    {
        $collection = CampaignUpdate::
                where('campaign_id', '=', $this->campaign->id)
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->paginate);

        return view('livewire.campaigns.manage.updates.show-updates', compact('collection'));
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

    public function order($sort) {
        if($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
    }

    public function registerUpdate() {
        return redirect()->route('campaign/manage/communications/register', ['campaign' => $this->campaign]);
    }

    public function saveComunication() {
        
        $this->emit('saved');
        $this->bannerStyle = "success";
        $this->message = "Saved correctly";
        $this->banner('Successfully saved!');
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
