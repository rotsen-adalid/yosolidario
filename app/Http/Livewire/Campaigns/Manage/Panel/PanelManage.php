<?php

namespace App\Http\Livewire\Campaigns\Manage\Panel;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\Collection;
use App\Http\Traits\Utilities;
use Livewire\WithPagination;

class PanelManage extends Component
{
    use WithPagination;
    use Utilities;

    public $search, $paginate = 10, $sumCollection; 

    public $campaign, $type_collaboration;
    public $shared;
    public $message;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED' and $campaign->user_id == auth()->user()->id) {
            $this->campaign = $campaign;

            $this->sumCollection = Collection::
                                join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                                ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                                ->where('collections.status', '=', 'PAYMENT')
                                ->orderBy('collections.updated_at', 'desc')
                                ->get();

        } else {
            //return redirect()->route('campaign/create');
        }
    } 

    public function render()
    {
        if($this->type_collaboration)
        {
            $collection = Collection::
                        join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                        ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                        ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                        ->where('payment_order_campaigns.type_collaboration', '=', $this->type_collaboration)
                        ->where('collections.status', '=', 'PAYMENT')
                        ->where('payment_orders.search', 'like','%'.$this->search.'%')
                        ->orderBy('collections.updated_at', 'desc')
                        ->paginate($this->paginate);  
        } else {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->where('payment_orders.search', 'like','%'.$this->search.'%')
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);
        }

        return view('livewire.campaigns.manage.panel.panel-manage',[
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
    
    public function addUpdates() {
        return redirect()->route('campaign/manage/communications/register', ['campaign' => $this->campaign]);
    }

}
