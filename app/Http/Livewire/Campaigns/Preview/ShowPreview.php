<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;

class ShowPreview extends Component
{
    public $slug;
    public $campaign_id;
    public $campaign;
    public $confirmingSendReview = false;

    public function mount($slug = null)
    {
        $this->slug = $slug;

        if($slug != null) {
            $campaign = Campaign::
                        where('slug', $slug)
                        ->where('status', 'DRAFT')
                        ->orWhere('status', 'IN_REVIEW')
                        ->get();
            if($campaign->count() > 0) {
                $this->campaign_id = $campaign[0]->id;
                $this->campaign = Campaign::find($this->campaign_id);
            }  else {
                return redirect()->route('campaign/create');
            }
        } 
    } 
    public function render()
    {
        return view('livewire.campaigns.preview.show-preview');
    }
    public function shared() {
        //$this->shared = true;
    }
}
