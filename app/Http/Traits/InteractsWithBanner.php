<?php

namespace App\Http\Traits;

trait InteractsWithBanner
{
    public function bannerSuccess(string $message, string $style = 'success')
    {
        request()->session()->flash('flash.banner', $message);
        request()->session()->flash('flash.bannerStyle', $style);
    }

    public function bannerDanger(string $message, string $style = 'danger')
    {
        request()->session()->flash('flash.banner', $message);
        request()->session()->flash('flash.bannerStyle', $style);
    }
}