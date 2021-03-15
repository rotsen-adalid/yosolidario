<?php

namespace App\Http\Middleware;

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
    {
        if($request->session()->has('locale')) {
            $lang = session()->get('locale');
        } else {
            // ipapi
            $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
            $ipapi = $response->json();
            $languaje_code = $ipapi['location']['languages'][0]['code'];

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
