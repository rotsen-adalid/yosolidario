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
// ++++++++++++ campaign
// publish 
use App\Http\Livewire\Campaigns\Published\ShowPublished;
Route::get('/{slug}', ShowPublished::class)
->name('campaign/published');
// widget
use App\Http\Livewire\Campaigns\Published\Widget\LargeWidget;
Route::get('/{slug}/widget/large', LargeWidget::class)
->name('campaign/widget/large');

use App\Http\Livewire\Campaigns\Published\Widget\MediumWidget;
Route::get('/{slug}/widget/medium', MediumWidget::class)
->name('campaign/widget/medium');

use App\Http\Livewire\Campaigns\Published\Widget\SmallWidget;
Route::get('/{slug}/widget/small', SmallWidget::class)
->name('campaign/widget/small');

// MyCampaigns
use App\Http\Livewire\Campaigns\MyCampaigns;
Route::middleware(['auth:sanctum', 'verified'])->get('/my/campaigns', MyCampaigns::class)
->name('my/campaigns');

// Campaign create
use App\Http\Livewire\Campaigns\Create\CampaignDetails;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/create', CampaignDetails::class)
->name('campaign/create');
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/{campaign}', CampaignDetails::class)
->name('campaign/update');

use App\Http\Livewire\Campaigns\Create\CampaignQuestions;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/create/questions/{campaign}', CampaignQuestions::class)
->name('campaign/create/questions');
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/questions/{campaign}', CampaignQuestions::class)
->name('campaign/update/questions');

use App\Http\Livewire\Campaigns\Create\CampaignRewards;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/update/rewards/{campaign}', CampaignRewards::class)
->name('campaign/update/rewards');

use App\Http\Livewire\Campaigns\Preview\ShowPreview;
Route::get('/campaigns/preview/{slug}', ShowPreview::class)
->name('campaigns/preview');

// Campaign Manage
use App\Http\Livewire\Campaigns\Manage\Collaborations\ShowCollaborations;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/manage/collaborations/{campaign}', ShowCollaborations::class)
->name('campaign/manage/collaborations');

use App\Http\Livewire\Campaigns\Manage\Updates\ShowUpdates;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/manage/updates/{campaign}', ShowUpdates::class)
->name('campaign/manage/updates');

use App\Http\Livewire\Campaigns\Manage\Comments\ShowComments;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/manage/comments/{campaign}', ShowComments::class)
->name('campaign/manage/comments');


use App\Http\Livewire\Campaigns\Manage\Teams\ShowTeams;
Route::middleware(['auth:sanctum', 'verified'])->get('/campaign/manage/teams/{campaign}', ShowTeams::class)
->name('campaign/manage/teams');

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