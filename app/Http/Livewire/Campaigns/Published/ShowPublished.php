<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class ShowPublished extends Component
{
    public $slug_next;
    public $campaign_id;
    public $campaign;
    
    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign = Campaign::find($this->campaign_id);
                $this->slug_next = $slug;
            } else {
                return redirect()->route('home');
            }
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.published.show-published');
    }
}
