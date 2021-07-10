<?php

namespace App\Http\Livewire\Campaigns\Manage\Menu;
use Livewire\Component;
use App\Models\Campaign;

class MenuHeader extends Component
{
    public $campaign;
    public $host;
    public $message;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;

        $host = $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.manage.menu.menu-header');
    }

    public function registerUpdate() {
        return redirect()->route('campaign/manage/communications/register', ['campaign' => $this->campaign]);
    }

}
