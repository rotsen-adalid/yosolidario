<?php

namespace App\Http\Livewire\Campaigns\Preview;
use Livewire\Component;

use App\Models\Campaign;
use Carbon\Carbon;

class CountersPreview extends Component
{
    public $campaign;
    public $shared;
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        return view('livewire.campaigns.preview.counters-preview');
    }

    public function shared() {

    }

    public function calculateDateExpiration($date_expiration)
    {
        $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $expirationDate = Carbon::createFromFormat('Y-m-d', $date_expiration);

        $days = $expirationDate->diffInDays($currentDate);
        return $days;
    }
}
