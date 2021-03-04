<?php

namespace App\Http\Livewire\Campaigns\Published\Widget;
use Livewire\Component;

use App\Models\Campaign;

class MediumWidget extends Component
{
    
    public $campaign;
    
    public function mount($slug = null)
    {
        if($slug != null) {
            $campaign = Campaign::
                        where('slug', '=' ,$slug)
                        ->get();
            if($campaign->count() == 1) {
                $this->campaign = Campaign::find($campaign[0]->id);
            } else {
                return redirect()->route('home');
            }
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.published.widget.medium-widget');
    }
}
