<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;

class Show extends Component
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
        return view('livewire.preview.show');
    }

    public function editCampaign() {
        return redirect()->route('campaign/update', ['slug' => $this->campaign->slug]);
    }

    public function reviewConfirm() {
        $this->confirmingSendReview = true;
    }

    public function sendReview() {
        $record = Campaign::find($this->campaign_id);
        // we update the info
        $record->update([
            'status' => 'IN_REVIEW'
        ]);
        $this->confirmingSendReview = false;
    }

    public function preview($id) {
        $record = Campaign::findOrFail($id);
        return redirect()->route('preview', ['slug' => $record->slug]);
    }

    public function editProfile() {
        return redirect()->route('setting/profile');
    }
 }
