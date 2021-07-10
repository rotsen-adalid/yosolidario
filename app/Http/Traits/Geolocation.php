<?php
namespace App\Http\Traits;
use App\Models\GeolocationUser;

trait Geolocation {

    public function registerGeolocation()
    {
        // register geolocalizator
        $this->ipapi = session()->get('ipapi');
        if(auth()->user()) {
            $record = GeolocationUser::create([
                'ipapi' => json_encode($this->ipapi),
                'type_person' => 'USER',
                'user_id' => auth()->user()->id
            ]);
        }else {
            $record = GeolocationUser::create([
                'ipapi' => json_encode($this->ipapi),
                'type_person' => 'INVITED',
            ]);
        }

    }
}
