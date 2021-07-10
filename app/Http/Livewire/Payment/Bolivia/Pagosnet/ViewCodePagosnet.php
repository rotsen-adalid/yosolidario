<?php

namespace App\Http\Livewire\Payment\Bolivia\Pagosnet;

use Livewire\Component;
use App\Models\PaymentOrder;

class ViewCodePagosnet extends Component
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
        return view('livewire.payment.bolivia.pagosnet.view-code-pagosnet');
    }

    public function home() {
        return redirect()->route('home');
    }
}
