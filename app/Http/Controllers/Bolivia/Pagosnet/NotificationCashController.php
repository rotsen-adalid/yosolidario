<?php

namespace App\Http\Controllers\Bolivia\Pagosnet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationCashController extends Controller
{
    public function store(Request $request)
    {
        $success = $request->input('success');
        if($success == true) {
            return redirect()->route('home');
        }elseif($success == false) {
            return redirect()->route('home');
        }
    }
}
