<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function set_language($lang){
        /*if(array_key_exists($lang, config('languages'))) {
            session()->put('locale', $lang);
        }*/

        session()->forget('locale');
        session()->put('locale', $lang);
        return back();
    }

    public function  sessionCurrenty()
    {
        
    }
}
