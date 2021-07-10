<?php

namespace App\Http\Livewire\Menu;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class NavigationApp extends Component
{
    use WithPagination;

    public $notificationsCollection;
    public $notificationsUnreadCollection;

    public function mount()
    {

    }

    public function render()
    {
        if(auth()->user()) {
            if(auth()->user()->notifications) {
                $this->notificationsCollection = auth()->user()->notifications;
            }
            
            $this->notificationsUnreadCollection = auth()->user()->unreadNotifications;
        }
                
        return view('livewire.menu.navigation-app');
    }

    // read notifications
    public function readNotifications() {
        if(count(auth()->user()->unreadNotifications) > 0) {
            auth()->user()->unreadNotifications->markAsRead();
        }
    }
}
