<?php

namespace App\Http\Middleware;

use App\Models\Agency;
use App\Models\Notice;
use App\Notifications\TelegramNotification;
use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   //session()->forget('ipapi');
        if($request->session()->has('ipapi')) {

        } else {
            $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=71c541e8146a77bd640a0255d0a82e04');
            $ipapi = $response->json();
            session()->put('ipapi', $ipapi);

            $agencyBO = Agency::find(1);
            $notice = new Notice([
                'telegramid' => $agencyBO->telegram->çhat_id,    //Config::get('services.telegram_id')
                'latitude' => $ipapi['latitude'],
                'longitude' => $ipapi['longitude'],
                'action' => 'USER_GEOLOCATION'
              
            ]);
            $notice->notify(new TelegramNotification);
        }

        if($request->session()->has('locale')) {
            $lang = session()->get('locale');
        } else {
            // ipapi
            
            //$languaje_code = $ipapi['location']['languages'][0]['code'];
            $languaje_code = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if($languaje_code) {
                if($languaje_code == 'es') {
                    $lang = 'es';
                    session()->put('locale', $lang);
                } elseif($languaje_code == 'en') {
                    $lang = 'en';
                    session()->put('locale', $lang);
                } elseif($languaje_code == 'pt_BR') {
                    $lang = 'pt_BR';
                    session()->put('locale', $lang);
                }
            }else{
                $lang = 'en';
                session()->put('locale', $lang);
            }

        }
        App::setLocale($lang); 
        return $next($request);
    }
}
