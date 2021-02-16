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
    
    public function mount($slug)
    {
        $this->slug = $slug; //DB::table('users')->where('slug', $slug)->get();
        $data = User::where('slug', $this->slug)->get();
        if($data->count() == 1) {
            $this->user = $data[0];
            if($this->user->profile->count() == 1) {
                $this->country = Country::find($data[0]->profile[0]->whatsapp_country_id);
            } else {
                return redirect()->route('home');
            }
            
        } else {
            return redirect()->route('home');
        }

    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}
