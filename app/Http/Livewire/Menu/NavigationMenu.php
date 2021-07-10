<?php

namespace App\Http\Livewire\Menu;

use App\Models\Organization;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavigationMenu extends Component
{
    public $option;
    public $collection_organization, $sum_organization;
    public $host;

    public function mount($option)
    {
        $this->option = $option; 
        // consult host
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-adm.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://admin.yosolidario.com';
        }

        if(auth()->user())
        {
        $this->sum_organization = Organization::
                        join('organization_agreements', 'organizations.id', '=', 'organization_agreements.organization_id')
                        ->with('users')
                        ->selectRaw('organizations.*')->whereHas('users', function ($query) {
                            $query->where('organization_user.user_id', '=', auth()->user()->id);
                        })
                        ->where('organization_agreements.status', '=', 'ACTIVE')
                        ->orderBy('organizations.created_at', 'desc')
                        ->get();

        $this->collection_organization = Organization::
                join('organization_agreements', 'organizations.id', '=', 'organization_agreements.organization_id')
                ->with('users')
                ->selectRaw('organizations.*')->whereHas('users', function ($query) {
                    $query->where('organization_user.user_id', '=', auth()->user()->id);
                })
                ->where('organization_agreements.status', '=', 'ACTIVE')
                ->orderBy('organizations.created_at', 'desc')
                ->limit(1,2)
                ->get();
        } else {
            $this->sum_organization = [];
        }
    }
    public function render()
    {
        return view('livewire.menu.navigation-menu');
    }
}
