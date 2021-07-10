<?php

namespace App\Http\Livewire\Campaigns\Manage\Comments;

use Livewire\Component;
use App\Models\Campaign;
use App\Http\Traits\Utilities;
use App\Models\Collection;
use App\Models\PaymentOrder;
use Livewire\WithPagination;

class ShowComments extends Component
{
    use WithPagination;
    use Utilities;

    public $search, $paginate = 20, $sumCollection; 

    public $campaign;
    public $host;
    public $message;

    public function mount(Campaign $campaign)
    {
        if($campaign) {
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
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);  
        } else {
            $collection = Collection::
                            join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                            ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                            ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                            ->where('collections.status', '=', 'PAYMENT')
                            ->where('payment_orders.commentary', '<>', null)
                            ->orderBy('collections.updated_at', 'desc')
                            ->paginate($this->paginate);
        }

        return view('livewire.campaigns.manage.comments.show-comments',[
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

    public function commentaryHidden($sw, $paymentOrderId)
    {
        $record = PaymentOrder::findOrFail($paymentOrderId);
        if($sw == 1)
        {
            $record->update([
                'commentary_hidden' => 'YES'
            ]);
        } else {
            $record->update([
                'commentary_hidden' => 'NO'
            ]);
        }

        $this->sumCollection = Collection::
                    join('payment_order_campaigns', 'payment_order_campaigns.payment_order_id', '=' ,'collections.payment_order_id')
                    ->join('payment_orders', 'payment_orders.id', '=' ,'collections.payment_order_id')
                    ->where('payment_order_campaigns.campaign_id', '=', $this->campaign->id)
                    ->where('collections.status', '=', 'PAYMENT')
                    ->orderBy('collections.updated_at', 'desc')
                    ->get();
    }
}
