<?php

namespace App\Http\Livewire\Campaigns\Published;
use Livewire\Component;

use App\Models\Campaign;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;

class ImportantCollaborationsPublished extends Component
{
    public $campaign;
    
    public $firtCollaboration, $latestCollaboration, $maxCollaboration, $collectionCollaboration;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;

        $this->firtCollaboration = Collection::
                                join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                                ->where('payment_order_campaigns.campaign_id', $this->campaign->id)
                                ->orderBy('collections.date_payment', 'asc')
                                ->first();
        $this->latestCollaboration = Collection::
                                join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                                ->where('payment_order_campaigns.campaign_id', $this->campaign->id)
                                ->orderBy('collections.date_payment', 'desc')
                                ->first();

        $maxCollaboration = Collection::
                                join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                                ->where('payment_order_campaigns.campaign_id', $this->campaign->id)
                                ->max('amount_organizer_convert');
        $this->maxCollaboration = Collection::
                                join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                                ->where('payment_order_campaigns.campaign_id', $this->campaign->id)
                                ->where('collections.amount_organizer_convert', '=', $maxCollaboration)
                                ->first();

        $this->collectionCollaboration = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->orderBy('collections.updated_at', 'desc')
                            ->get();
    } 

    public function render()
    {
        return view('livewire.campaigns.published.important-collaborations-published');
    }
}
