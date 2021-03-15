<?php

namespace App\Http\Livewire\Campaigns\YourCampaigns;
use Livewire\Component;

use App\Models\Campaign;

class ShowYourCampaigns extends Component
{
    
    public function render()
    {
        $collection = Campaign::where('user_id', auth()->user()->id)
                            ->latest('id')
                            ->paginate(8);
                    return view('livewire.campaigns.your-campaigns.show-your-campaigns',[
                    'collection' => $collection
                    ]);
    }

    public function editCampaign($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/update', ['campaign' => $record]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        if($record->status == 'DRAFT') {
            return redirect()->route('campaign/preview', ['slug' => $record->slug]);
        } elseif($record->status == 'IN_REVIEW') {
            return redirect()->route('campaign/published', ['slug' => $record->slug]);
        } else if($record->status == 'PUBLISHED') {
            return redirect()->route('campaign/published', ['slug' => $record->slug]);
        }
    }

    public function createCampaign() {
       return redirect()->route('campaign/create');
    }
    
    public function manage($id) {
        $record = Campaign::find($id);
        return redirect()->route('campaign/manage/collaborations', ['campaign' => $record]);
    }
}
