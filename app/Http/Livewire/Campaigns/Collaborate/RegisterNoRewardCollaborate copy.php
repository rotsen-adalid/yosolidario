<?php

namespace App\Http\Livewire\Campaigns\Collaborate;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\Country;
use App\Models\Money;
use App\Models\PaymentOrder;

use DOMDocument;
use Exception;
use SoapClient;

class RegisterNoRewardCollaborate extends Component
{
    public $campaign;
    public $money_id, $currency, $country_code; 

    // data ys
    public $amount_collaborator, $amount_percentage_yosolidario, $amount_total, $amount_yosolidario;
    public $name, $lastname, $show_name, $email, $phone, $phone_prefix, $country_id, $payment_method, $commentary;

    public $collected_percentage_ys, $collection_countries;
    public $loadindPay;
    // data pagosNet
    public $messagePn, $ipapi, $codigoRecaudacionPn, $idTransaccionPn;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED') {
            $this->campaign = $campaign;
            
            // ipapi
            $this->ipapi = session()->get('ipapi');

            if ( $this->ipapi != null) {
                $this->country_code =  $this->ipapi['country_code'];
            } else {
                $this->country_code = 'US';
            }
            $this->country_code = 'US';
            if($this->campaign->agency->country->code == $this->country_code) {
                $this->currency = $this->campaign->agency->agencySetting->money->currency_symbol;
                $this->money_id = $this->campaign->agency->agencySetting->money->id;
                $this->phone_prefix = $this->campaign->agency->country->phone_prefix;
            } else {
                $record_money = Money::find(2);
                $this->currency = $record_money->currency_symbol; 
                $this->money_id = $record_money->id;
            }

            if(auth()->user()) {
                $this->name = auth()->user()->name;
            } else {

            }
            $this->collection_countries = Country::
                                        orderBy('name', 'asc')
                                        ->get();

        } else {
            return redirect()->route('home');
        }

        //
        $this->collected_percentage_ys = array(
            array("value" => "7","amount_collaborator" => 0),
            array("value" => "10","amount_collaborator" => 0),
            array("value" => "12","amount_collaborator" => 0),
            array("value" => "15","amount_collaborator" => 0),
        );
        $this->amount_percentage_yosolidario = 12;

        // other

    } 

    public function render()
    {
        return view('livewire.campaigns.collaborate.register-no-reward-collaborate');
    }

    public function viewUser() {

    }

    public function amountTotal() {
        if($this->amount_collaborator != '') {

            if($this->amount_collaborator >= 5 and $this->amount_collaborator <= 14) {
                $this->collected_percentage_ys = array(
                    array("value" => "1","amount_collaborator" => 1),
                    array("value" => "2","amount_collaborator" => 2),
                    array("value" => "3","amount_collaborator" => 3),
                );
                $this->amount_percentage_yosolidario = 1;
                $this->amount_yosolidario = $this->amount_percentage_yosolidario;
                $this->amount_total = (float)$this->amount_collaborator + (float)$this->amount_percentage_yosolidario;
                
            } elseif($this->amount_collaborator >= 15) {
                $x7 = $this->amount_collaborator * 7 / 100;
                $x10 = $this->amount_collaborator * 10 / 100;
                $x12 = $this->amount_collaborator * 12 / 100;
                $x15 = $this->amount_collaborator * 15 / 100;

                $this->collected_percentage_ys = array(
                    array("value" => "7","amount_collaborator" => $x7),
                    array("value" => "10","amount_collaborator" => $x10),
                    array("value" => "12","amount_collaborator" => $x12),
                    array("value" => "15","amount_collaborator" => $x15),
                );
        
                $this->amount_percentage_yosolidario = 12;
                $this->amount_yosolidario = (float)$this->amount_collaborator * (float)$this->amount_percentage_yosolidario / 100;
                $this->amount_total = (float)$this->amount_collaborator + (float)($this->amount_collaborator * $this->amount_percentage_yosolidario / 100);
            } else {
                $this->collected_percentage_ys = array(
                    array("value" => "7","amount_collaborator" => 0),
                    array("value" => "10","amount_collaborator" => 0),
                    array("value" => "12","amount_collaborator" => 0),
                    array("value" => "15","amount_collaborator" => 0),
                );
        
                // $this->amount_percentage_yosolidario = 12;
                $this->amount_total = 0;
            }
        } else {
            $this->amount_yosolidario = 0;
        }
    }

    public function percentageAmountTotal() {
        if($this->amount_collaborator) {
            if($this->amount_percentage_yosolidario != 'OTHER') {

                if($this->amount_collaborator >= 5 and $this->amount_collaborator <= 14) {
                    $this->amount_yosolidario = $this->amount_percentage_yosolidario;
                    $this->amount_total = (float)$this->amount_collaborator + (float)$this->amount_percentage_yosolidario;
                } elseif($this->amount_collaborator >= 15) { 
                    $this->amount_yosolidario = (float)($this->amount_collaborator * $this->amount_percentage_yosolidario / 100);
                    $this->amount_total = $this->amount_collaborator + (float)($this->amount_collaborator * $this->amount_percentage_yosolidario / 100);
                } else { 
                    $this->amount_percentage_yosolidario = 12;
                    $this->amount_total = 0;
                }

            } elseif($this->amount_percentage_yosolidario == 'OTHER') {

                if($this->amount_collaborator >= 5 and $this->amount_collaborator <= 14) {
                    $this->amount_yosolidario = 0;
                }elseif($this->amount_collaborator >= 15) {
                    $this->amount_yosolidario = 0;
                }

                $this->amount_total = $this->amount_collaborator + (float)$this->amount_yosolidario;
            }
        }
    }
    
    public function amountOther() {
        if($this->amount_percentage_yosolidario == 'OTHER') {
            $this->amount_total = $this->amount_collaborator + (float)$this->amount_yosolidario;
        }
    }

    // convert
    public function cutLetter($letter, $number) {

        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }
    public function cutLetterTwo($letterOne, $letterTwo, $number) {

        $letter = $letterOne.', '.$letterTwo;
        
        if(strlen($letter) > $number) {
            $l = substr($letter, 0, $number);
            return $l.'...';
        } else {
            $l = substr($letter, 0, $number);
            return $l;
        }
    }

    public function convertCurrency($amount_collaborator, $buy_usd) {
        if ($amount_collaborator > 0) {
            $convert = $amount_collaborator / $buy_usd;
            return $convert;
        } else {
            return $amount_collaborator;
        }
    }
    // end convert
    
    //--------------------------------------- pagosNet

    private function conexionPagosNet() {
        // URL WS ambiente de PRE-PRODUCCION
        define("WSDL_PAGOSNET", "https://test.sintesis.com.bo/WSApp-war/ComelecWS?WSDL");
        //URL ambiente de PRODUCCION
        // wwwwwwwwww.wsdl produccion
    }

    public function pay() {

        //request()->session()->flash('flash.banner', 'hola');
        //request()->session()->flash('flash.bannerStyle', 'success');

        //return $this->redirect('/');
 
        if($this->campaign->agency->country->code == $this->country_code) {
            $this->validate([
                'amount_collaborator' => "required|numeric|between:5,1000",
                'name' => 'required',
                'lastname' => 'required',
                'payment_method' => 'required',
            ]);

            if($this->payment_method == 'CASH') {
                $this->pagosNetEfectivo();
                
            }elseif($this->payment_method == 'CARD') { 
                $this->pagofacil('CARD');
            }elseif($this->payment_method == 'MOBILE_WALLET') { 
                $this->pagofacil('MOBILE_WALLET');
            }elseif($this->payment_method == 'QR_PAYMENT') { 
                $this->pagofacil('QR_PAYMENT');
            }

        } else { 
            $this->validate([
                'amount_collaborator' => "required|numeric|between:5,1000",
                'name' => 'required',
                'lastname' => 'required',
            ]);
        }
        
    }

    public function store($payment_method, $agency_pp_id) {

        if(auth()->user()) {
            $user_id = auth()->user()->id;
            $type_user = 'REGISTERED';
        } else {
            $user_id = null;
            $type_user = 'INVITED';
        }

        $this->amount_yosolidario = (float)$this->amount_total - (float)$this->amount_collaborator;

        
        if(!$this->phone_prefix) {
            $record_country = Country::find($this->country_id);
            $this->phone_prefix = $record_country->phone_prefix;      
        }
        
        if($this->show_name) {
            $show_name = 'YES';
        } else {
            $show_name = 'NO';
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
            'commentary' => $this->commentary,

            'amount_total' => $this->amount_total,
            'amount_collaborator' => $this->amount_collaborator,
            'amount_yosolidario' => $this->amount_yosolidario,
            'amount_percentage_yosolidario' => $this->amount_percentage_yosolidario,

            'campaign_id' => $this->campaign->id,
            'agency_id' => $this->campaign->agency->id,
            'payment_method' => $payment_method,
            'money_id' => 1,
            'agency_pp_id' => $agency_pp_id,
            'user_id' => $user_id,
            'type_user' => $type_user,
            'campaign_reward_id' => null,
            'type_collaboration' => 'NO_REWARD',
            'status' => 'PETITION'
        ]);
        // $this->money_id,
        return $record->id;
    }

    private function pagofacil($payment_method) {
        $paymentOrderId = $this->store($payment_method, 2);
         // updating data
         $record = PaymentOrder::find($paymentOrderId);
         $record->update([
             'status' => 'PENDING_PAYMENT',
             'code_collection' => $paymentOrderId,
         ]);
        //redirect
        return redirect()->route('campaign/collaborate/pagofacil/PagoFacilCheckout', ['paymentOrder' => $record]);
    }

    private function pagosNetEfectivo() {
    
        // register data
        
        if($this->currency == 'Bs') {
            $monedaPn = 'BS';
        } elseif($this->currency == '$') {
            $monedaPn = 'US';
        }
       
        $paymentOrderId = $this->store('CASH', 1);
        $codigoRecaudacionPn = 'YS-'.$paymentOrderId;

        $this->conexionPagosNet();

        // echo ("Datos para registroPlan"); 
        //-----------------------   Registro Plan    ----------------------------
        //Request
        
        $categoriaProducto           = 1;
        $codigoComprador             = $codigoRecaudacionPn;      //código interno del cliente
        $codigoRecaudacion           = $codigoRecaudacionPn;  //identificador propio, el formato lo define el cliente
        $correoElectronico           = $this->email;
        $descripcionRecaudacion      = $this->campaign->title;
        $documentoIdentidadComprador = '';
        $fecha                       = date("Ymd");
        $fechaVencimiento            = 0;  //0 = no tiene vencimiento
        $hora                        = date("His");
        $horaVencimiento             = 0;  //0 = para no tiene vencimiento
        $moneda                      = $monedaPn; // BS=Bolivianos, US=Dolares, EU=Euros
        $nombreComprador             = $this->name.' '.$this->lastname;
        // Datos para array planillas
        $descripcion                 = $this->campaign->title;
        $montoCreditoFiscal          = 0; //$this->amount_total
        $montoPago                   = $this->amount_total;
        $nitFactura                  = '';
        $nombreFactura               = $this->name.' '.$this->lastname;
        $numeroPago                  = $paymentOrderId;
        
        $planillas = array(
            'descripcion'        => $descripcion,
            'montoCreditoFiscal' => $montoCreditoFiscal,
            'montoPago'          => $montoPago,
            'nitFactura'         => $nitFactura,
            'nombreFactura'      => $nombreFactura,
            'numeroPago'         => $numeroPago 
          );
        
        $precedenciaCobro            = 'N';
        $transaccion                 = 'A';       //A=adicionar, B=baja, M=modificar
        $cuenta      = 'wssolidario';
        $password    = 'Wssolidario2020';

        //----------------------------------------------
        // Arma el array
        $datos = array(
            'categoriaProducto'           => $categoriaProducto,
            'codigoComprador'             => $codigoComprador,
            'codigoRecaudacion'           => $codigoRecaudacion,
            'correoElectronico'           => $correoElectronico,
            'descripcionRecaudacion'      => $descripcionRecaudacion,
            'documentoIdentidadComprador' => $documentoIdentidadComprador,
            'fecha'                       => $fecha,
            'fechaVencimiento'            => $fechaVencimiento,
            'hora'                        => $hora,
            'horaVencimiento'             => $horaVencimiento,	
            'moneda'                      => $moneda,
            'nombreComprador'             => $nombreComprador,
            'planillas'                   => $planillas,
            'precedenciaCobro'            => $precedenciaCobro,
            'transaccion'                 => $transaccion	
            );

        $params = array(
            'datos'    => $datos,
            'cuenta'   => $cuenta,
            'password' => $password,
        );

        //   Preparo la invocación del WS con registroPlan
        $client = null;
        $metodo = '--undefined--';

        try{
            //Instancio el ws
            $client = new soapclient(WSDL_PAGOSNET, array('trace'=>true, 'exceptions'=>true	));
     
            $resultPlan1 = $client->__soapCall("registroPlan", array($params));
            $resultPlan =get_object_vars($resultPlan1);
            $resultPlan=$resultPlan['return'];
            $resultPlan=get_object_vars($resultPlan);
            //var_dump($resultPlan);
            //print_r($resultPlan['codigoError']);
            //print_r($resultPlan['descripcionError']);
            
            //Analizo la respuesta	
            if ($resultPlan['codigoError'] === 0) {
                $this->messagePn = 'Registro Plan exitoso... <br/>';
                $this->codigoRecaudacionPn = 'Recaudacion: ' . $codigoRecaudacion . '<br/>';
                $this->idTransaccionPn = 'Transaccion: ' . $resultPlan['idTransaccion'] . '<br/>';  	
                //var_dump($resultPlan1);
                //echo "<br/><br/>";
                //TODO: Cliente debe registrar las respuestas	
                
            } else {
                 $this->messagePn =   'Registro Plan sin exito : { codError=' . $resultPlan['codigoError']
                                    . ', ' .
                                    'descripcionError=' . $resultPlan['descripcionError'] 
                                    . '}<br/>';	
                //TODO: Desplegar mensaje de error
                return;     
            }
            
        } catch(Exception $ex){
            //echo $ex->getMessage();
            if ($client != null){
                $this->escribirHandler($client->__getLastRequest() , $metodo, 'Request');
                $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');
            }
        }

        // updating data
        $record = PaymentOrder::find($paymentOrderId);
        $record->update([
            'status' => 'PENDING_PAYMENT',
            'code_collection' => $codigoRecaudacion,
            'id_transaction' => $resultPlan['idTransaccion'],
        ]);
        $record->pagosnetRegistroplans()->create([
            'transaccion' => $transaccion,
            'documentoIdentidadComprador' => $documentoIdentidadComprador,
            'codigoComprador' => $codigoComprador,
            'fecha' => $fecha,
            'hora' => $hora,
            'correoElectronico' => $correoElectronico,
            'moneda' => $moneda,
            'codigoRecaudacion' => $codigoRecaudacion,
            'descripcionRecaudacion' => $descripcionRecaudacion,
            'fechaVencimiento' => $fechaVencimiento,
            'horaVencimiento' => $horaVencimiento,
            'categoriaProducto' => $categoriaProducto,
            'precedenciaCobro' => $precedenciaCobro,
            'numeroPago' => $numeroPago,
            'montoPago' => $montoPago,
            'descripcion' => $descripcion,
            'montoCreditoFiscal' => $montoCreditoFiscal,
            'nombreFactura' => $nombreFactura,
            'nitFactura' => $nitFactura,
            'idTransaccion' => $resultPlan['idTransaccion'],
            'codigoError' => $resultPlan['codigoError'],
            'descripcionError' => $this->messagePn
        ]);

        //redirect
        return redirect()->route('campaign/collaborate/pagosnet/cash', ['paymentOrder' => $record]);
    }

    public function pagosNetTarjeta() {

        if($this->currency == 'Bs') {
            $monedaPn = 'BS';
        } elseif($this->currency == '$') {
            $monedaPn = 'US';
        }

        $this->conexionPagosNet();
        
        // echo ("Datos para registroPlan"); 

        //-----------------------   Registro Plan    ----------------------------
        //Request
        $codigoRecaudacionPn = 'YS' . date("Ymd") . '-' . date("His") ;
        
        $categoriaProducto           = 1;
        $codigoComprador             = $codigoRecaudacionPn;      //código interno del cliente
        $codigoRecaudacion           = $codigoRecaudacionPn;  //identificador propio, el formato lo define el cliente
        $correoElectronico           = $this->email;
        $descripcionRecaudacion      = $this->campaign->title;
        $documentoIdentidadComprador = '';
        $fecha                       = date("Ymd");
        $fechaVencimiento            = 0;  //0 = no tiene vencimiento
        $hora                        = date("His");
        $horaVencimiento             = 0;  //0 = para no tiene vencimiento
        $moneda                      = $monedaPn; // BS=Bolivianos, US=Dolares, EU=Euros
        $nombreComprador             = $this->name.' '.$this->lastname;
        // Datos para array planillas
        $descripcion                 = $this->campaign->title;
        $montoCreditoFiscal          = 0;
        $montoPago                   = $this->amount_total;
        $nitFactura                  = '';
        $nombreFactura               = '';
        $numeroPago                  = 1;
        
        $planillas = array(
            'descripcion'        => $descripcion,
            'montoCreditoFiscal' => $montoCreditoFiscal,
            'montoPago'          => $montoPago,
            'nitFactura'         => $nitFactura,
            'nombreFactura'      => $nombreFactura,
            'numeroPago'         => $numeroPago 
          );
        
        $precedenciaCobro            = 'N';
        $transaccion                 = 'A';       //A=adicionar, B=baja, M=modificar
        $cuenta      = 'wssolidario';
        $password    = 'Wssolidario2020';

        //----------------------------------------------
        // Arma el array
        $datos = array(
            'categoriaProducto'           => $categoriaProducto,
            'codigoComprador'             => $codigoComprador,
            'codigoRecaudacion'           => $codigoRecaudacion,
            'correoElectronico'           => $correoElectronico,
            'descripcionRecaudacion'      => $descripcionRecaudacion,
            'documentoIdentidadComprador' => $documentoIdentidadComprador,
            'fecha'                       => $fecha,
            'fechaVencimiento'            => $fechaVencimiento,
            'hora'                        => $hora,
            'horaVencimiento'             => $horaVencimiento,	
            'moneda'                      => $moneda,
            'nombreComprador'             => $nombreComprador,
            'planillas'                   => $planillas,
            'precedenciaCobro'            => $precedenciaCobro,
            'transaccion'                 => $transaccion	
            );

        $params = array(
            'datos'    => $datos,
            'cuenta'   => $cuenta,
            'password' => $password,
        );

        //   Preparo la invocación del WS con registroPlan
        $client = null;
        $metodo = '--undefined--';
   
        try{
            //Instancio el ws
            $client = new soapclient(WSDL_PAGOSNET, array('trace'=>true, 'exceptions'=>true	));
     
            $resultPlan1 = $client->__soapCall("registroPlan", array($params));
            $resultPlan =get_object_vars($resultPlan1);
            $resultPlan=$resultPlan['return'];
            $resultPlan=get_object_vars($resultPlan);
            //var_dump($resultPlan);
            //print_r($resultPlan['codigoError']);
            //print_r($resultPlan['descripcionError']);
            
            //Analizo la respuesta	
            if ($resultPlan['codigoError'] === 0) {
                $this->messagePn = 'Registro Plan exitoso... <br/>';
                $this->codigoRecaudacionPn = 'Recaudacion: ' . $codigoRecaudacion . '<br/>';
                $this->idTransaccionPn = 'Transaccion: ' . $resultPlan['idTransaccion'] . '<br/>';  	
                //var_dump($resultPlan1);
                //echo "<br/><br/>";
                //TODO: Cliente debe registrar las respuestas	
                
            } else {
                 $this->messagePn =   'Registro Plan sin exito : { codError=' . $resultPlan['codigoError']
                                    . ', ' .
                                    'descripcionError=' . $resultPlan['descripcionError'] 
                                    . '}<br/>';	
                //TODO: Desplegar mensaje de error
                return;     
            }

            //Preparo la invocación del WS registroTarjetaHabiente (Obligatoria para pagos con tarjeta)
            //Los datos del tarjetahabiente corresponden al cliente que realizara el pago utilizando tarjeta
            //de credito o debito.
            //-----------------------------------------------------------------------------------------------
            // Datos para registrar datos del cliente que realizara pagos con tarjetas de crédito o débito.
            //-----------------------------------------------------------------------------
            $transaccionTH               = 'A';   // A=adicionar, B=Baja, esta es la accion que se realizara sobre este tarjetahabiente.
            $nombre                      = $this->name;
            $apellido                    = $this->lastname;
            $email                       = $this->email;
            $telefono                    = '77272728';
            $pais                        = 'Bolivia';
            $departamento                = 'La Paz';
            $ciudad                      = 'La Paz';
            $direccion                   = 'B/Abc Def C/Ghi Jkl Nro.477';


            $datosTarjetaHabiente = array(
                'apellido'          => $apellido,
                'ciudad'            => $ciudad,
                'correoElectronico' => $email,
                'departamento'      => $departamento,
                'direccion'         => $direccion,
                'idTransaccion'     => $resultPlan['idTransaccion'],
                'nombre'            => $nombre,
                'pais'              => $pais,
                'telefono'          => $telefono,
                'transaccion'       => $transaccionTH,
                );

            $paramsTarjetaHabiente = array(
                'datos' => $datosTarjetaHabiente,
                'cuenta' => $cuenta,
                'password' => $password,
            );
    
            $responseRegistroTarjetaHabiente1 =$client->__soapCall("registroTarjetaHabiente", array($paramsTarjetaHabiente));
            
            $responseRegistroTarjetaHabiente =get_object_vars($responseRegistroTarjetaHabiente1);
            $responseRegistroTarjetaHabiente=$responseRegistroTarjetaHabiente['return'];
            $responseRegistroTarjetaHabiente=get_object_vars($responseRegistroTarjetaHabiente);
    
            //Analizo la respuesta	
            if ($responseRegistroTarjetaHabiente['codigoError'] === 0){
                $this->messagePn = '<h>Registro de Tarjeta Habiente exitoso... <br/>';	
                //ar_dump($responseRegistroTarjetaHabiente1);
                //echo '<br/><br/>';
            }else{
                $this->messagePn = 'Registro de Tarjetahabiente fallido: codError=' . $responseRegistroTarjetaHabiente['codigoError'] 
                                    . ', ' .
                                    'descripcionError=' . $responseRegistroTarjetaHabiente['descripcionError'] 
                                    . '<br/>';	
            }

            //Preparo la invocación del WS registroMdd
            //Metodo para registrar transacciones hacia cybersource.
            //------------------------------------------------------------------------------------
            $comercioId                  = '760';  
            $id                          = '1';	  //id transaccion del MDD
            $transaccionMdd              = 'A';   // A=Alta, M=Modificacion, B=Baja de datos de un transaccion Cybersource .
            $vertical                    = 'Servicios'; //Tipo de servicio puede ser: Servicios,Retail Servicios, Delivery Foods, Retail, Travel, Hoteles (Sintesis lo provee)
            
        
            $entry= array(
                array(
                'key'     => "merchant_defined_data1",   // Se describe en un excel que provee Sintesis
                'value'	  => 'SI',
                ),
                array(
                'key'     => "merchant_defined_data11",
                'value'	  => '4837235LP',
                )
            );

            $mdd = array(
                'entry'          => $entry,
            );

            $datosMdd = array(
                'comercioId'        => $comercioId,
                'id'                => $id,
                'mdd'               => $mdd,
                'transaccion'       => $transaccionMdd,
                'transaccionId'     => $resultPlan['idTransaccion'],
                'vertical'          => $vertical,
            );


            $paramsRegistroMdd = array(
                'datos' => $datosMdd,
                'cuenta' => $cuenta,
                'password' => $password,
            );

            $responseRegistroMdd1 =$client->__soapCall("registroMdd", array($paramsRegistroMdd));
            
            $responseRegistroMdd =get_object_vars($responseRegistroMdd1);
            $responseRegistroMdd=$responseRegistroMdd['return'];
            $responseRegistroMdd=get_object_vars($responseRegistroMdd);

            //Analizo la respuesta	
            if ($responseRegistroMdd['codigoError'] === 1){
                $this->messagePn = '<h>Registro del Tarjetahabiente exitoso... <br/>';	
                //var_dump($responseRegistroMdd1);
                //echo '<br/><br/>';
            }else{
                $this->messagePn = 'Registro de transaccion hacia cybersource fallido: codError=' . $responseRegistroMdd['codigoError'] 
                                    . ', ' .
                                    'descripcionError=' . $responseRegistroMdd['descripcionError'] 
                                    . '<br/>';	
            }

        } catch(Exception $ex){
            //echo $ex->getMessage();
            if ($client != null){
                $this->escribirHandler($client->__getLastRequest() , $metodo, 'Request');
                $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');
            }
        }
    }

    //Funciones auxiliares 
	//-----------------------------------------------------------------------------------------------
	 public function obj2array($obj) {
	    $out = array();
	    foreach ($obj as $key => $val) {
	      switch(true) {
	        case is_object($val):
		    //$out[$key] = obj2array($val);
		  break;
		case is_array($val):
		    //$out[$key] = obj2array($val);
		  break;
		default:
		  $out[$key] = $val;
	      }
	    }
	    return $out;
	  }


	public function escribirHandler($raw_xml, $metodo, $tipo){
	  if ($raw_xml == null){
			return;
	  }	
	  $doc = new DOMDocument();
	  $doc->formatOutput = TRUE;
	  $doc->loadXML($raw_xml);
	  $newxml = $doc->saveXML();
	  
	  $outputFilename   = 'log/handler_' . date("Ymd") .'.txt';
	  $handle = fopen($outputFilename, "a");
	  fwrite($handle, '******************************************************' . PHP_EOL);
	  fwrite($handle, 'Método: ' . $metodo .  PHP_EOL);
	  fwrite($handle, 'Hora: ' .  date("H:i:s") . PHP_EOL);
	  fwrite($handle, 'Tipo: ' . $tipo . PHP_EOL);
	  fwrite($handle, $newxml);
	  fwrite($handle, PHP_EOL);
	  fclose($handle);	
	}

}
