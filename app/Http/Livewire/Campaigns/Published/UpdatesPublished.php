<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\CampaignUpdate;

class UpdatesPublished extends Component
{
    public $campaign;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;
        } else {
            //return redirect()->route('campaign/create');
        }
    } 
    
    public function render()
    {
        $collection = CampaignUpdate::where('campaign_id', $this->campaign->id)
                    ->latest('id')
                    ->paginate(8);
        return view('livewire.campaigns.published.updates-published',[
                    'collection' => $collection
                    ]);
    }
}
