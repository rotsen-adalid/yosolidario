<?php

namespace App\Http\Controllers\Bolivia\Pagosnet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationCashController extends Controller
{
    public function index()
    {   
        return redirect()->route('home');
        
    }
}
