<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Profile extends Component
{
    public $slug;
    public $user;
    public $country;
    
    public function mount(User $user)
    {
        $this->slug = $user->slug; //DB::table('users')->where('slug', $slug)->get();
        $data = User::where('slug', '=', $this->slug)->first();
        if($data) {
            $this->user = $data;
            if($this->user->profile) {
                $this->country = Country::find($data->profile->whatsapp_country_id);
            } else {
                //return redirect()->route('home');
            }
            
        } else {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
    
    public function editProfile() {
        return redirect()->route('setting/profile');
    }
}
