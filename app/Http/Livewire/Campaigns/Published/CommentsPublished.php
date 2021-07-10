<?php

namespace App\Http\Livewire\Campaigns\Published;

use Livewire\Component;
use App\Models\Campaign;
use App\Http\Traits\Utilities;
use App\Models\Collection;
use Livewire\WithPagination;

class CommentsPublished extends Component
{
    use WithPagination;
    use Utilities;

    public $search, $paginate = 20, $sumCollection; 

    public $campaign;
    public $host;
    public $message;

    public function mount(Campaign $campaign)
    {
        if($campaign->id) {
            $this->campaign = $campaign;
            $this->sumCollection = Collection::
                    join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                    ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                    ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                    ->where('collections.status', '=', 'PAYMENT')
                    ->orderBy('collections.updated_at', 'desc')
                    ->get();
        } else {
            // return redirect()->route('home');
        }

        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://yosolidario.com';
        }
    } 

    public function render()
    {
        if(strlen($this->search) > 0) {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->where('payment_orders.commentary', '<>', null)
                            ->where('payment_orders.commentary_hidden', '=', 'NO')
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);  
        } else {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->where('payment_orders.commentary', '<>', null)
                            ->where('payment_orders.commentary_hidden', '=', 'NO')
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);
        }

        return view('livewire.campaigns.published.comments-published',[
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
}
