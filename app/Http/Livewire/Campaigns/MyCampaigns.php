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
        return redirect()->route('campaign/update', ['slug' => $record->slug]);
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('preview', ['slug' => $record->slug]);
    }

    public function createCampaign() {
       return redirect()->route('campaign/create');
    }
    
}
