<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class CountersPublished extends Component
{
    public $slug;
    public $campaign_id;
    public $campaign;
    
    public function mount($slug = null)
    {
        $this->slug = $slug;
        
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'PUBLISHED')
                        ->get();
            if($campaign->count() > 0) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign =  Campaign::find($this->campaign_id);
            } 
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.published.counters-published');
    }
}
