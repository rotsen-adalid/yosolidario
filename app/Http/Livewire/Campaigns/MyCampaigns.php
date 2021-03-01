<?php

namespace App\Http\Livewire\Campaigns;

use App\Models\Campaign;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\DB;

class MyCampaigns extends Component
{
    public $collection_campaign;
    
    public function render()
    {
        $collection = Campaign::where('user_id', auth()->user()->id)
                                ->latest('id')
                                ->paginate(8);
        return view('livewire.campaigns.my-campaigns',[
                        'collection' => $collection
                        ]);
    }

    public function editCampaign($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('campaign/update', ['campaign' => $record]);
    }

    public function view($id) {
        $record = Campaign::findOrFail($id);
        if($record->status == 'DRAFT' or $record->status == 'IN_REVIEW') {
            return redirect()->route('preview', ['slug' => $record->slug]);
        } else if($record->status == 'PUBLISHED') {
            return redirect()->route('campaign-published', ['slug' => $record->slug]);
        }
    }

    public function createCampaign() {
       return redirect()->route('campaign/create');
    }
    
}
