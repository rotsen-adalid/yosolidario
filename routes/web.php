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

// ++++++++++++++++++++++++++ Home
use App\Http\Livewire\Home\ShowHome;
Route::middleware(['access'])->get('/', ShowHome::class)->name('home');

// ++++++++++++++++++++++++++ PWA
Route::middleware(['access'])->get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});

// ++++++++++++++++++++++++++ Language
Route::middleware(['access'])->get('set_language/{lang}', [Controller::class, 'set_language'])->name('set_language');

//------------------------------------------CAMPAIGN----------------------------------------

// ++++++++++++++++++++++++++ Campaign publish

// publish 
use App\Http\Livewire\Campaigns\Published\ShowPublished;
Route::middleware(['access'])->get('/{campaign}', ShowPublished::class)
->name('campaign/published');

// widget
use App\Http\Livewire\Campaigns\Published\Widget\LargeWidget;
Route::middleware(['access'])->get('/{slug}/widget/large', LargeWidget::class)
->name('campaign/widget/large');
// widget medium
use App\Http\Livewire\Campaigns\Published\Widget\MediumWidget;
Route::middleware(['access'])->get('/{slug}/widget/medium', MediumWidget::class)
->name('campaign/widget/medium');
// widget small
use App\Http\Livewire\Campaigns\Published\Widget\SmallWidget;
Route::middleware(['access'])->get('/{slug}/widget/small', SmallWidget::class)
->name('campaign/widget/small');
// poster
use App\Http\Livewire\Campaigns\Published\PrintPoster\ViewPrintPoster;
Route::middleware(['access'])->get('/{slug}/poster', ViewPrintPoster::class)
->name('campaign/poster');

// ++++++++++++++++++++++++++ Campaigns

// Campaign create
use App\Http\Livewire\Campaigns\Create\CampaignDetails;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/create', CampaignDetails::class)
->name('campaign/create');
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/update/{campaign}', CampaignDetails::class)
->name('campaign/update');
// Campaign questions
use App\Http\Livewire\Campaigns\Create\CampaignQuestions;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/create/questions/{campaign}', CampaignQuestions::class)
->name('campaign/create/questions');
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/update/questions/{campaign}', CampaignQuestions::class)
->name('campaign/update/questions');
// Campaign rewards
use App\Http\Livewire\Campaigns\Create\CampaignRewards\ShowCampaignRewards;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/rewards/show/{campaign}', ShowCampaignRewards::class)
->name('campaign/rewards/show');
use App\Http\Livewire\Campaigns\Create\CampaignRewards\RegisterCampaignReward;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/rewards/register/{campaign}', RegisterCampaignReward::class)
->name('campaign/rewards/register');
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/rewards/update/{campaign}/{campaignReward}', RegisterCampaignReward::class)
->name('campaign/rewards/update');
// Campaign preview
use App\Http\Livewire\Campaigns\Preview\ShowPreview;
Route::middleware(['access'])->get('/preview/{slug}', ShowPreview::class)
->name('campaign/preview');

//------------------------------------------PANEL MANAGE----------------------------------------
// ++++++++++++++++++++++++++ Panel

// Your Campaigns
use App\Http\Livewire\Campaigns\YourCampaigns\ShowYourCampaigns;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/your/campaigns', ShowYourCampaigns::class)
->name('your/campaigns');

// Your Collaborations
use App\Http\Livewire\Collaborations\YourCollaborations\ShowYourCollaborations;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/your/collaborations', ShowYourCollaborations::class)
->name('your/collaborations');

use App\Http\Livewire\CampaignSaves\ShowCampaignSaves;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/saves/show', ShowCampaignSaves::class)
->name('campaign/saves/show');

// ++++++++++++++++++++++++++ Campaign Manage

// Panel
use App\Http\Livewire\Campaigns\Manage\Panel\PanelManage;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/{campaign}', PanelManage::class)
->name('campaign/manage');

// Show Collaborations
use App\Http\Livewire\Campaigns\Manage\Collaborations\ViewCollaborations;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/collaborations/{campaign}', ViewCollaborations::class)
->name('campaign/manage/collaborations');

// Reward collaborations
use App\Http\Livewire\Campaigns\Manage\RewardCollaborators\ShowRewardCollaborators;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/reward-collaborators/{campaign}', ShowRewardCollaborators::class)
->name('campaign/manage/reward-collaborators');

// Updates

use App\Http\Livewire\Campaigns\Manage\Updates\ShowUpdates;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/communications/show/{campaign}', ShowUpdates::class)
->name('campaign/manage/communications/show');

use App\Http\Livewire\Campaigns\Manage\Updates\RegisterUpdates;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/communications/register/{campaign}', RegisterUpdates::class)
->name('campaign/manage/communications/register');

Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/communications/update/{campaign}/{campaignUpdate}', RegisterUpdates::class)
->name('campaign/manage/communications/update');

use App\Http\Livewire\Campaigns\Manage\Updates\SharedUpdates;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/communications/{campaignUpdateId}', SharedUpdates::class)
->name('campaign/manage/communications/shared');

// Show Coments
use App\Http\Livewire\Campaigns\Manage\Comments\ShowComments;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/campaign/manage/comments/{campaign}', ShowComments::class)
->name('campaign/manage/comments');

//------------------------------------------PANEL ORGANIZATION ----------------------------------------
// ++++++++++++++++++++++++++ Panel

// Your Campaigns
use App\Http\Livewire\Campaigns\OrganizationCampaigns\ShowOrganizationCampaigns;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/organization/campaigns', ShowOrganizationCampaigns::class)
->name('organization/campaigns');

//------------------------------------------COLLABORATE----------------------------------------

// ++++++++++++++++++++++++++ Collaborate  Campaign
use App\Http\Livewire\Campaigns\Collaborate\RegisterNoRewardCollaborate;
Route::middleware(['access'])->get('/campaign/collaborate/{campaign}', RegisterNoRewardCollaborate::class)
->name('campaign/collaborate');

use App\Http\Livewire\Campaigns\Collaborate\RegisterRewardCollaborate;
Route::middleware(['access'])->get('/campaign/collaborate/reward/{campaign}/{campaignRewardId}', RegisterRewardCollaborate::class)
->name('campaign/collaborate/reward');

// ++++++++++++++++++++++++++ Collaborate  Organization
use App\Http\Livewire\Organization\Collaborate\RegisterNoRewardOrganizationCollaborate;
Route::middleware(['access'])->get('/organization/collaborate/{organization}', RegisterNoRewardOrganizationCollaborate::class)
->name('organization/collaborate');

use App\Http\Livewire\Organization\Collaborate\RegisterRewardOrganizationCollaborate;
Route::middleware(['access'])->get('/organization/collaborate/reward/{organization}/{organizationRewardId}', RegisterRewardOrganizationCollaborate::class)
->name('organization/collaborate/reward');

//------------------------------------------PAGOSNET----------------------------------------
use App\Http\Livewire\Payment\Bolivia\Pagosnet\ViewCodePagosnet;
Route::middleware(['access'])->get('/collaborate/pagosnet/cash/{paymentOrder}', ViewCodePagosNet::class)
->name('collaborate/pagosnet/cash');

use App\Http\Livewire\Payment\Bolivia\Pagosnet\IframePagosnet;
Route::middleware(['access'])->get('/collaborate/pagosnet/card/{paymentOrder}', IframePagosnet::class)
->name('collaborate/pagosnet/card');

use App\Http\Controllers\Bolivia\Pagosnet\NotificationCashController;
Route::get('/pagosnet/notification/cash', [NotificationCashController::class, 'index']);

//------------------------------------------PAGOFACILCHECKOUT----------------------------------------

// esta ruta es la vista inicial, que muestra un formulario basico para datos del cliente
use App\Http\Controllers\Bolivia\Pagofacil\PagoFacilCheckoutClient;
Route::get('/collaborate/pagofacil/{paymentOrder}/PagoFacilCheckout', [PagoFacilCheckoutClient::class, 'inicio'])
->name('collaborate/pagofacil/PagoFacilCheckout');

//esta ruta recibe los parametros del formulario inicial del cliente y pasa a encriptar los datos antes de enviarlos para ser procesados en PagoFacil Bolivia
Route::post('collaborate/pagofacil/{paymentOrder}/PagoFacilCheckoutEncript', [PagoFacilCheckoutClient::class, 'Encript']);

//------------------------------------------PROFILE----------------------------------------

// ++++++++++++++++++++++++++ User 

// profile 
use App\Http\Livewire\User\Profile;
Route::middleware(['access'])->get('user/{user}', Profile::class)->name('user');

// ++++++++++++++++++++++++++ Organization 

// profile 
use App\Http\Livewire\Organization\Profile\ProfileOrganization;
Route::middleware(['access'])->get('org/{organization}', ProfileOrganization::class)->name('org');

// widget large
use App\Http\Livewire\Organization\Profile\Widget\LargeWidgetOrganization;
Route::middleware(['access'])->get('/org/{slug}/widget/large', LargeWidgetOrganization::class)
->name('organization/widget/large');
// widget medium
use App\Http\Livewire\Organization\Profile\Widget\MediumWidgetOrganization;
Route::middleware(['access'])->get('/org/{slug}/widget/medium', MediumWidgetOrganization::class)
->name('organization/widget/medium');
// widget small
use App\Http\Livewire\Organization\Profile\Widget\SmallWidgetOrganization;
Route::middleware(['access'])->get('/org/{slug}/widget/small', SmallWidgetOrganization::class)
->name('organization/widget/small');

// ++++++++++++++++++++++++++ ACCOUNT

// Change Account
use App\Http\Livewire\Account\ChangeAccount\ShowChangeAccount;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/change-account/view-account', ShowChangeAccount::class)
->name('change-account/view-account');

// ++++++++++++++++++++++++++ Setting

// Setting Account
use App\Http\Livewire\Setting\Acount\AcountSetting;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/setting/account', AcountSetting::class)
->name('setting/account');

// Setting Edit Profile
use App\Http\Livewire\Setting\Profile\EditProfileSetting;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/setting/profile', EditProfileSetting::class)
->name('setting/profile');

// Setting Notifications
use App\Http\Livewire\Setting\Notifications;
Route::middleware(['auth:sanctum', 'verified', 'access'])->get('/setting/notifications', Notifications::class)
->name('setting/notifications');

// ++++++++++++++++++++++++++ Fraud
// fraud register
use App\Http\Livewire\Fraud\Register\RegisterFraud;
Route::middleware(['auth:sanctum','verified', 'access'])->get('/fraud/register/{campaign}', RegisterFraud::class)
->name('fraud/register-campaign');

Route::middleware(['auth:sanctum','verified', 'access'])->get('/fraud/register/', RegisterFraud::class)
->name('fraud/register');

//------------------------------------------PAGE----------------------------------------

// ++++++++++++++++++++++++++ Discover

// Show Discover
use App\Http\Livewire\Campaigns\Discover\ShowDiscover;
Route::middleware(['access'])->get('/campaigns/discover', ShowDiscover::class)
->name('campaigns/discover');

// ++++++++++++++++++++++++++ About

// how it works
use App\Http\Livewire\About\HowItWorks\ShowHowItWorks;
Route::middleware(['access'])->get('/about/how-it-works', ShowHowItWorks::class)
->name('about/how-it-works');
// know us
use App\Http\Livewire\About\KnowUs\ShowKnowUs;
Route::middleware(['access'])->get('/about/know-us', ShowKnowUs::class)
->name('about/know-us');
// about us
use App\Http\Livewire\About\AboutUs\ShowAboutUs;
Route::middleware(['access'])->get('/about/about-us', ShowAboutUs::class)
->name('about/about-us');

