<?php

namespace App\Http\Livewire\Organization\Profile;

use App\Models\Country;
use Livewire\Component;
use App\Models\Organization;

class ProfileOrganization extends Component
{
    public $organization, $slug;
    public $host;

    Public function mount($slug)
    {
        $this->slug = $slug; //DB::table('users')->where('slug', $slug)->get();
        $data = Organization::where('slug', '=', $this->slug)->get();
        if($data->count() == 1) {
            $this->organization = $data[0];
            if($this->organization->organizationProfile) {
                $this->country = Country::find($data[0]->country->id);
            } else {
                //return redirect()->route('home');
            }
            
        } else {
            return redirect()->route('home');
        }

        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-adm.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://admin.yosolidario.com';
        }
    }

    public function render()
    {
        return view('livewire.organization.profile.profile-organization');
    }

    public function donate($id)
    {
        $record = Organization::find($id);
        return redirect()->route('organization/collaborate', ['organization' => $record]);
    }
    
}
