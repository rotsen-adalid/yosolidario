<?php

namespace App\Http\Livewire\Payment\Bolivia\Pagosnet;

use Livewire\Component;
use App\Models\PaymentOrder;

class IframePagosnet extends Component
{
    public $paymentOrder;
    public $host;

    public function mount(PaymentOrder $paymentOrder)
    {
        if($paymentOrder) {
            if($paymentOrder->status == 'PENDING_PAYMENT') {
                $this->paymentOrder = $paymentOrder;

                $host= $_SERVER["HTTP_HOST"];
                if($host == 'yosolidario.test') {
                    $this->host = 'http://yosolidario.test';
                } elseif($host == 'yosolidario.com') {
                    $this->host = 'https://yosolidario.com';
                }
                $this->host = 'https://yosolidario.com';
            }elseif($paymentOrder->status == 'MONEY_DEPOSITED') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }

    public function render()
    {
        return view('livewire.payment.bolivia.pagosnet.iframe-pagosnet');
    }

    public function home() {
        return redirect()->route('home');
    }
}
