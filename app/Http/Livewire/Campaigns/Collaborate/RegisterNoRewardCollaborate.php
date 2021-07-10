<?php

namespace App\Http\Livewire\Campaigns\Collaborate;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\CampaignReward;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\Money;
use App\Models\PagosnetRegistroplan;
use App\Models\PagosnetRegistroth;
use App\Models\PaymentOrder;

use DOMDocument;
use Exception;
use SoapClient;

use App\Http\Traits\Collaborate;
use App\Http\Traits\Utilities;
use App\Http\Traits\InteractsWithBanner;
use App\Models\AgencyPm;
use App\Models\AgencyPp;

class RegisterNoRewardCollaborate extends Component
{
    use InteractsWithBanner;
    use Collaborate;
    use Utilities;

    public $campaign;
    public $money_id, $currency, $country_code; 

    // data ys
    public $amount_user, $amount_percentage_yosolidario, $amount_total, $amount_yosolidario;
    public $name, $lastname, $show_name, $email, $phone, $phone_prefix, $country_id, $country_state_id, $payment_method = 'CARD', $commentary;
    public $locality, $address;

    public $collected_percentage_ys, $collection_countries, $collection_country_states, $states_denomination;
    public $loadindPay;
    // data pagosNet
    public $ipapi, $codigoRecaudacionPn, $idTransaccionPn, $value;
    public $host;
    
    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED') {
            $this->campaign = $campaign;
            
            // ipapi
            $this->ipapi = $this->ipapiData();

            if ($this->ipapi != null) {
                $this->country_code = $this->ipapi['country_code'];
            } else {
                $this->country_code = 'US';
            }
            // $this->country_code = 'US';
            if($this->campaign->agency->country->code == $this->country_code) {
                $this->currency = $this->campaign->agency->agencySetting->money->currency_symbol;
                $this->money_id = $this->campaign->agency->agencySetting->money->id;
                //$this->phone_prefix = $this->campaign->agency->country->phone_prefix;
            } else {
                $record_money = Money::find(2);
                $this->currency = $record_money->currency_symbol; 
                $this->money_id = $record_money->id;
            }

            $this->phone_prefix = '+'.$this->ipapi['location']['calling_code'];
            if(auth()->user()) {
                $this->name = auth()->user()->name;
                $this->lastname = auth()->user()->lastname;
                $this->email = auth()->user()->email;
            } else {

            }
            $this->collection_countries = Country::
                                        where('country_estates', '=', 'YES')
                                        ->orderBy('name', 'asc')
                                        ->get();
            $records = Country::
                        where('code', $this->ipapi['country_code'])
                        ->get();
            $this->country_id = $records[0]->id;

        } else {
            return redirect()->route('home');
        }

        //
        $this->collected_percentage_ys = array(
            array("value" => "7","amount_user" => 0),
            array("value" => "10","amount_user" => 0),
            array("value" => "12","amount_user" => 0),
            array("value" => "15","amount_user" => 0),
        );
        $this->amount_percentage_yosolidario = 12;

        // other
        $host= $_SERVER["HTTP_HOST"];
        if($host == 'yosolidario.test') {
            $this->host = 'http://yosolidario-adm.test';
        } elseif($host == 'yosolidario.com') {
            $this->host = 'https://admin.yosolidario.com';
        }
    } 

    public function render()
    {
        return view('livewire.campaigns.collaborate.register-no-reward-collaborate');
    }
    // validate
     protected $rules = [
        'amount_user' => "required|numeric|between:5,1000",
        'name' => 'required',
        'lastname' => 'required',
        'email' => 'nullable|email',
        'locality' => 'required',
        'address' => 'nullable',
        'phone' => 'required|numeric',
        'payment_method' => 'required',
    ];

    protected $messages = [
        //'agency_id.required' => 'The country field is required.',
        //'title.required' => 'The title field is required.',
    ];

    protected $validationAttributes = [
        'amount_user' => '',
        'name' => '',
        'lastname' =>'',
        'show_name' => '',
        'email' => '',
        'locality' => '',
        'address' => '',
        'phone' => '',
        'payment_method' => ''
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function viewUser() {

    }

    // country state 
    public function countryState() {
        if($this->country_id) {
            $this->collection_country_states = CountryState::
                                            where('country_id', $this->country_id)
                                            ->orderBy('name', 'asc')
                                            ->get();
        }
    }

    public function pay() {

        $this->validate();

        if($this->campaign->agency->country->code == $this->country_code) {

            // ++++ BOLIVIA ++++ //
            
            if($this->payment_method == 'CASH') {
                $this->registerPagosnetCash();          // PAGOSNET EFECTIVO
            }elseif($this->payment_method == 'CARD') { 
                $this->registerCardPagosnet();          // PAGOSNET TARJETA
            }elseif($this->payment_method == 'MOBILE_WALLET') { 
                $this->pagofacil('MOBILE_WALLET');
            }elseif($this->payment_method == 'QR_PAYMENT') { 
                $this->pagofacil('QR_PAYMENT');
            }

        } else { 

            if($this->payment_method == 'CARD') { 
                $this->pagofacil('CARD');
            }elseif($this->payment_method == 'MOBILE_WALLET') { 
                $this->pagofacil('MOBILE_WALLET');
            }elseif($this->payment_method == 'QR_PAYMENT') { 
                $this->pagofacil('QR_PAYMENT');
            }
        }
    }

    public function store($payment_method) {

        if(auth()->user()) {
            $user_id = auth()->user()->id;
            $type_user = 'REGISTERED';
        } else {
            $user_id = null;
            $type_user = 'INVITED';
        }

        $this->amount_yosolidario = (float)$this->amount_total - (float)$this->amount_user;

        
        if(!$this->phone_prefix) {
            $record_country = Country::find($this->country_id);
            $this->phone_prefix = $record_country->phone_prefix;      
        }
        
        if($this->show_name) {
            $show_name = 'YES';
        } else {
            $show_name = 'NO';
        }

        $search_all = $this->name.' '.$this->lastname.' '.$this->email. ' '.$this->phone;

        if(!$this->address)
        {
            $this->address = $this->locality;
        }
        
        $record = PaymentOrder::create([
            //'code_collection' => $codigoRecaudacionPn,
            'id_transaction' => 0,

            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone_prefix' => $this->phone_prefix,
            'phone' => $this->phone,
            'show_name' => $show_name,
            'locality' => $this->locality,
            'address' => $this->address,
            'commentary' => $this->commentary,

            'amount_total' => $this->amount_total,
            'amount_user' => $this->amount_user,
            'amount_yosolidario' => $this->amount_yosolidario,
            'amount_percentage_yosolidario' => $this->amount_percentage_yosolidario,

            'agency_id' => $this->campaign->agency->id,
            'payment_method' => $payment_method,
            'money_id' => $this->money_id,
            'user_id' => $user_id,
            'type_user' => $type_user,
            'type' => 'CAMPAIGN',
            'status_transaction' => 'PETITION',

            'search' =>  $this->generateSearch($search_all)
        ]);
        $record->update([
            'code_collection' => 'YS'.$record->id
        ]);
        $record->paymentOrderCampaign()->create([
            'campaign_id' => $this->campaign->id,
            'campaign_reward_id' => null,
            'type_collaboration' => 'NO_REWARD',
        ]);

        $dataReturn = array(
            'id' =>  $record->id,
            'code_collection' => $record->code_collection
        );
        return $dataReturn;
    }

    // +++++++++++++++++++++++++++++++ BOLIVIA +++++++++++++++++++++++++++++++++++++++//

    // PAGOFACIL
    private function pagofacil($payment_method) {
        $valueStore = $this->store($payment_method);
        // updating data
        $record = PaymentOrder::find($valueStore['id']);
        //redirect
        return redirect()->route('collaborate/pagofacil/PagoFacilCheckout', ['paymentOrder' => $record]);
    }

    // PAGOSNET
    public function registerPagosnetCash() {

        $valueStore = $this->store('CASH');
        $value = $this->pagosNetEfectivo($this->currency, 
                                $valueStore['code_collection'],
                                $this->email,
                                $this->campaign->title,
                                $this->amount_total,
                                $this->name,
                                $this->lastname
                                );
        
        if($value) {

            if($value['action'] == true) {
                // updating data
                $record = PaymentOrder::find($valueStore['id']);
                $record->update([
                    'status_transaction' => 'PENDING',
                    'id_transaction' => $value['idTransaccion'],
                    'search' => $record->search.' '.$value['codigoRecaudacion'].' '.$value['idTransaccion']
                ]);
                /* (optional)
                $record->pagosnetRegistroplans()->create([
                    'transaccion' => $value['transaccion'],
                    'documentoIdentidadComprador' => $value['documentoIdentidadComprador'],
                    'codigoComprador' => $value['codigoComprador'],
                    'fecha' => $value['fecha'],
                    'hora' => $value['hora'],
                    'correoElectronico' => $value['correoElectronico'],
                    'moneda' => $value['moneda'],
                    'codigoRecaudacion' => $value['codigoRecaudacion'],
                    'descripcionRecaudacion' => $value['descripcionRecaudacion'],
                    'fechaVencimiento' => $value['fechaVencimiento'],
                    'horaVencimiento' => $value['horaVencimiento'],
                    'categoriaProducto' => $value['categoriaProducto'],
                    'precedenciaCobro' => $value['precedenciaCobro'],
                    'numeroPago' => $value['numeroPago'],
                    'montoPago' => $value['montoPago'],
                    'descripcion' => $value['descripcion'],
                    'montoCreditoFiscal' => $value['montoCreditoFiscal'],
                    'nombreFactura' => $value['nombreFactura'],
                    'nitFactura' => $value['nitFactura'],
                    'idTransaccion' => $value['idTransaccion'],
                    'codigoError' => $value['codigoError'],
                    'descripcionError' => $value['descripcionError'],
                ]);
                */
                $this->bannerSuccess('Successfully posted payment');
                //redirect
                return redirect()->route('collaborate/pagosnet/cash', ['paymentOrder' => $record]);

            } elseif($value['action'] == false) { 
                $this->emit('bannerDanger', 'Payment cannot be made');  
            }

        }else {
            $this->emit('bannerDanger', 'Payment cannot be made');
        }
    }

    public function registerCardPagosnet() {

        $valueStore = $this->store('CARD');
        $value = $this->pagosNetTarjeta($this->currency, 
                                $valueStore['code_collection'],
                                $this->email,
                                $this->campaign->title,
                                $this->amount_total,
                                $this->name,
                                $this->lastname,
                                $this->locality,
                                $this->address
                                );
        if($value) {                   
            if($value['action'] == true) {
            // updating data
            $record_order = PaymentOrder::find($valueStore['id']);
            $record_order->update([
                'status_transaction' => 'PENDING',
                'id_transaction' => $value['idTransaccion'],
                'search' => $record_order->search.' '.$value['codigoRecaudacion'].' '.$value['idTransaccion']
            ]);
            /* (optional)
            $recordRp = PagosnetRegistroplan::create([
                'payment_order_id' => $record_order->id,
                'transaccion' => $value['transaccion'],
                'documentoIdentidadComprador' => $value['documentoIdentidadComprador'],
                'codigoComprador' => $value['codigoComprador'],
                'fecha' => $value['fecha'],
                'hora' => $value['hora'],
                'correoElectronico' => $value['correoElectronico'],
                'moneda' => $value['moneda'],
                'codigoRecaudacion' => $value['codigoRecaudacion'],
                'descripcionRecaudacion' => $value['descripcionRecaudacion'],
                'fechaVencimiento' => $value['fechaVencimiento'],
                'horaVencimiento' => $value['horaVencimiento'],
                'categoriaProducto' => $value['categoriaProducto'],
                'precedenciaCobro' => $value['precedenciaCobro'],
                'numeroPago' => $value['numeroPago'],
                'montoPago' => $value['montoPago'],
                'descripcion' => $value['descripcion'],
                'montoCreditoFiscal' => $value['montoCreditoFiscal'],
                'nombreFactura' => $value['nombreFactura'],
                'nitFactura' => $value['nitFactura'],
                'idTransaccion' => $value['idTransaccion'],
                'codigoError' => $value['codigoError'],
                'descripcionError' => $value['descripcionError'],
            ]);

            $recordRp->pagosnetRegistroth()->create([
                'transaccionTH' => $value['transaccionTH'],
                'nombre' => $value['nombre'],
                'email' => $value['email'],
                'telefono' => $value['telefono'],
                'pais' => $value['pais'],
                'departamento' => $value['departamento'],
                'ciudad' => $value['direccion'],
                'direccion' => $value['direccion'],
                'idTransaccion' => $value['idTransaccion'],
                'codigoError' => $value['codigoError'],
                'descripcionError' => $value['descripcionError'],
            ]);
            $recordRp->pagosnetRegistromdd()->create([
                'comercioId' => $value['comercioId'],
                'id_mdd' => $value['id_mdd'],
                'transaccionMdd' => $value['transaccionMdd'],
                'vertical' => $value['vertical'],
            ]);
            */
            $this->bannerSuccess('Successfully posted payment');
            //redirect
            return redirect()->route('collaborate/pagosnet/card', ['paymentOrder' => $record_order]);
            
            } elseif($value['action'] == false) {    
                $this->emit('bannerDanger', 'Payment cannot be made');   
            }
        } else {
            $this->emit('bannerDanger', 'Payment cannot be made'); 
        }
    }
}
