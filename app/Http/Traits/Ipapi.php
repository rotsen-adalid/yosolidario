<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Http;

trait Ipapi {
    
    public function ipapi() {
        return [
            'country_code' => 'BO',
            'country_name' => 'Bolivia',
            'region_name' => 'La Paz',
            'latitude' => '0',
            'longitude' => '0',
            'location' => [
                'calling_code' => '591'
            ]
        ];
        
    }

    public function ipapi0() {
        $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=71c541e8146a77bd640a0255d0a82e04');
        $ipapi = $response->json();
        return $ipapi;
    }
}
