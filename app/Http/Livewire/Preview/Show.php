<?php

namespace App\Http\Livewire\Preview;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Campaign;

class Show extends Component
{
    public $slug;

    public function mount($slug = null)
    {
        $this->slug = $slug;

        if($slug != null) {
            $campaign = DB::table('campaigns')
            ->where('slug', $slug)
            ->where('status', 'DRAFT')
            ->orWhere('status', 'IN_REVIEW')
            ->get();
            if($campaign->count() == 1) {
                $this->campaign =  $campaign[0];
                $this->campaign_id = $this->campaign->id;
            }  else {
                return redirect()->route('campaign/create');
            }
        } 
    } 

    public function render()
    {
        return view('livewire.preview.show');
    }

    public function hola() {
        return "saludos";
    }
 }
