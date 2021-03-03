<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class ShowPublished extends Component
{
    public $slug;
    public $campaign_id;
    public $campaign;
    public $shared;
    
    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign_id = $campaign[0]->id;
                //$this->campaign = Campaign::find($this->campaign_id);
                $this->slug = $slug;
            } else {
                return redirect()->route('home');
            }
        }
    } 
    public function render()
    {
        $this->campaign = Campaign::find($this->campaign_id);
        return view('livewire.campaigns.published.show-published');
    }
    public function shared() {
        $this->shared = true;
    }
}
