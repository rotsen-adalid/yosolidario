<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('web.home');
});*/
// honme
use App\Http\Livewire\Home;
Route::get('/', Home::class)->name('home');

Route::get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});

Route::get('welcome', function () {
    App::setLocale('es'); 
    session()->put('locale', 'es');
});

//Route::get('set_language/{lang}', 'Controller@set_language')->name('set_language');
// campaign
use App\Http\Livewire\Campaigns\MyCampaigns;
Route::middleware(['auth:sanctum', 'verified'])->get('/my-campaigns', MyCampaigns::class)
->name('my-campaigns');

use App\Http\Livewire\Campaigns\Create\Details;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/create', Details::class)
->name('campaign/create');
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/{slug}', Details::class)
->name('campaign/update');

use App\Http\Livewire\Campaigns\Create\Questions;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/create/questions/{slug}', Questions::class)
->name('campaign/create/questions');
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/questions/{slug}', Questions::class)
->name('campaign/update/questions');

use App\Http\Livewire\Campaigns\Create\Recognitions;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/recognitions/{slug}', Recognitions::class)
->name('campaign/update/recognitions');

use App\Http\Livewire\Preview\Show;
Route::middleware(['auth:sanctum', 'verified'])->get('/preview/{slug}', Show::class)
->name('preview');

// profile 
use App\Http\Livewire\User\Profile;
Route::get('user/{slug}', Profile::class)->name('user');

// setting
use App\Http\Livewire\Setting\Account;
Route::middleware(['auth:sanctum', 'verified'])->get('/setting/account', Account::class)
->name('setting/account');

use App\Http\Livewire\Setting\EditProfile;
Route::middleware(['auth:sanctum', 'verified'])->get('/setting/profile', EditProfile::class)
->name('setting/profile');

use App\Http\Livewire\Setting\Notifications;
Route::middleware(['auth:sanctum', 'verified'])->get('/setting/notifications', Notifications::class)
->name('setting/notifications');

// about
// how it works
use App\Http\Livewire\About\HowItWorks;
Route::get('/about/how-it-works', HowItWorks::class)
->name('about/how-it-works');
// know us
use App\Http\Livewire\About\KnowUs;
Route::get('/about/know-us', KnowUs::class)
->name('about/know-us');