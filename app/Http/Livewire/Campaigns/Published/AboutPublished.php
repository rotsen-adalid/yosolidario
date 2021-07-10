<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;

class AboutPublished extends Component
{
    public $campaign;
    public $host;
    
    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;

        // consult host
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-charity.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://charity.yosolidario.com';
        }
    } 
    public function render()
    {
        return view('livewire.campaigns.published.about-published');
    }
}
