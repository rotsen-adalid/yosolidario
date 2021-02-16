<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;

class CoverPage extends Component
{
    public $slug;
    public $video_url;
    public $campaign;
    
    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'DRAFT')
                        ->orWhere('status', 'IN_REVIEW')
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign =  $campaign[0];
                $this->campaign_id = $this->campaign->id;
                $video_array = explode("/",$this->campaign->video->url);
                if($video_array[2] == 'youtu.be') {
                    $this->video_url =  $video_array[3];
                }
            } 
        }
    } 

    public function render()
    {
        return view('livewire.preview.cover-page');
    }
}
