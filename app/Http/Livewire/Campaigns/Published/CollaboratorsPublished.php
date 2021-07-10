<?php

namespace App\Http\Livewire\Campaigns\Published;

use Livewire\Component;
use App\Models\Campaign;
use App\Http\Traits\Utilities;
use App\Models\Collection;
use Livewire\WithPagination;

class CollaboratorsPublished extends Component
{
    use WithPagination;
    use Utilities;

    public $search, $paginate = 20, $sumCollection, $maxCollaborations = 0; 

    public $campaign, $campaign_id;

    public function mount(Campaign $campaign)
    {
        $this->campaign =  $campaign;
    } 

    public function render()
    {
        $this->sumCollection = Collection::
                    join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                    ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                    ->where('collections.status', '=', 'PAYMENT')
                    ->orderBy('collections.updated_at', 'desc')
                    ->get();

        if($this->maxCollaborations == 1) {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->orderBy('collections.amount_organizer_convert', 'desc')
                            ->paginate($this->paginate);  
        } else {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);
        }

        return view('livewire.campaigns.published.collaborators-published',[
            'collection' => $collection
            ]);
    }
    
    //for searches with paging
    public function updatingSearch(): void 
    {
        $this->gotoPage(1);
    }

    public function resetCollection() {
        $this->search = "";
        $this->gotoPage(1);
    }

    public function maxCollaborations()
    {
        if($this->maxCollaborations == 0)
        {
            $this->maxCollaborations = 1;
        } else {
            $this->maxCollaborations = 0;
        }
    }
}
