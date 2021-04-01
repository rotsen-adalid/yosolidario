<?php

namespace App\Http\Livewire\Campaigns\Collaborate\Pagosnet;
use Livewire\Component;
use App\Models\PaymentOrder;

class ViewCodePagosNet extends Component
{
    public $paymentOrder;

    public function mount(PaymentOrder $paymentOrder)
    {
        if($paymentOrder) {
            if($paymentOrder->status == 'PENDING_PAYMENT') {
                $this->paymentOrder = $paymentOrder;
            }elseif($paymentOrder->status == 'MONEY_DEPOSITED') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
        
    }
    public function render()
    {
        return view('livewire.campaigns.collaborate.pagosnet.view-code-pagosnet');
    }

    public function home() {
        return redirect()->route('home');
    }
}
