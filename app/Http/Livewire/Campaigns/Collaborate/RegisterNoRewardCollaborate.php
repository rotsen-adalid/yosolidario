<?php

namespace App\Http\Livewire\Campaigns\Collaborate;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\Campaign;
use App\Models\Money;
use Carbon\Carbon;
use DateTime;
use DOMDocument;
use Exception;
use SoapClient;

class RegisterNoRewardCollaborate extends Component
{
    public $campaign;
    public $currency, $country_code; 

    // data ys
    public $amount, $amount_percentage_ys, $amount_total, $amount_ys;
    public $name, $lastname, $email;

    public $collected_percentage_ys;
   
    // data pagosNet
    public $messagePn, $codigoRecaudacionPn, $idTransaccionPn;

    public function mount(Campaign $campaign)
    {
        if($campaign->status == 'PUBLISHED') {
            $this->campaign = $campaign;
            
            // ipapi
            $response = Http::get('http://api.ipapi.com/179.58.47.20?access_key=c161289d6c8bc62e50f1abad0c4846aa');
            $ipapi = $response->json();

            if ($ipapi != null) {
                $this->country_code = $ipapi['country_code'];
            } else {
                $this->country_code = 'US';
            }
            //$this->country_code = 'US';
            if($this->campaign->agency->country->code == $this->country_code) {
                $this->currency = $this->campaign->agency->agencySetting->money->currency_symbol;
            } else {
                $currency = Money::find(2);
                $this->currency = $currency->currency_symbol; 
            }

        } else {
            return redirect()->route('home');
        }

        //
        $this->collected_percentage_ys = array(
            array("value" => "7","amount" => 0),
            array("value" => "10","amount" => 0),
            array("value" => "12","amount" => 0),
            array("value" => "15","amount" => 0),
        );
        $this->amount_percentage_ys = 12;

        // other

    } 

    public function render()
    {
        return view('livewire.campaigns.collaborate.register-no-reward-collaborate');
    }

    public function amountTotal() {
        if($this->amount >= 5 and $this->amount <= 14) {
            $this->collected_percentage_ys = array(
                array("value" => "1","amount" => 1),
                array("value" => "2","amount" => 2),
                array("value" => "3","amount" => 3),
            );
            if($this->amount_percentage_ys) {
                $this->amount_percentage_ys = $this->amount_percentage_ys;
            } else {
                //$this->amount_percentage_ys = 1;
            }
            $this->amount_total = $this->amount + $this->amount_percentage_ys;
            
        } elseif($this->amount >= 15) {
            $x7 = $this->amount * 7 / 100;
            $x10 = $this->amount * 10 / 100;
            $x12 = $this->amount * 12 / 100;
            $x15 = $this->amount * 15 / 100;

            $this->collected_percentage_ys = array(
                array("value" => "7","amount" => $x7),
                array("value" => "10","amount" => $x10),
                array("value" => "12","amount" => $x12),
                array("value" => "15","amount" => $x15),
            );
    
            $this->amount_percentage_ys = 7;
            $this->amount_total = $this->amount + ($this->amount * $this->amount_percentage_ys / 100);
        } else {
            $this->collected_percentage_ys = array(
                array("value" => "7","amount" => 0),
                array("value" => "10","amount" => 0),
                array("value" => "12","amount" => 0),
                array("value" => "15","amount" => 0),
            );
    
            // $this->amount_percentage_ys = 12;
            $this->amount_total = 0;
        }
    }

    public function percentageAmountTotal() {
        if($this->amount_percentage_ys != 'OTHER') {
            if($this->amount >= 5 and $this->amount <= 14) {
                $this->amount_total = $this->amount + $this->amount_percentage_ys;
            } elseif($this->amount >= 15) { 
                $this->amount_total = $this->amount + ($this->amount * $this->amount_percentage_ys / 100);
            } else { 
                $this->amount_percentage_ys = 12;
                $this->amount_total = 0;
            }
        } elseif($this->amount_percentage_ys == 'OTHER') { 
            $this->amount_percentage_ys = 'OTHER';
            $this->amount_total = $this->amount + (float)$this->amount_ys;
        }
    }
    
    public function amountOther() {
        if($this->amount_percentage_ys == 'OTHER') {
            $this->amount_total = $this->amount + (float)$this->amount_ys;
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

    public function convertCurrency($amount, $buy_usd) {
        if ($amount > 0) {
            $convert = $amount / $buy_usd;
            return $convert;
        } else {
            return $amount;
        }
    }
    // end convert

    //--------------------------------------- pagosNet
    public function pagosNetEfectivo() {
    
        if($this->currency == 'Bs') {
            $monedaPn = 'BS';
        } elseif($this->currency == '$') {
            $monedaPn = 'US';
        }
        // URL WS ambiente de PRE-PRODUCCION
        define("WSDL_PAGOSNET", "https://test.sintesis.com.bo/WSApp-war/ComelecWS?WSDL");
        //URL ambiente de PRODUCCION
        // wwwwwwwwww.wsdl produccion
        
        // echo ("Datos para registroPlan"); 
        //-----------------------   Registro Plan    ----------------------------
        //Request
        $codigoRecaudacionPn = '9' . date("Ymd") . '-' . date("His") ;
        
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
        $montoCreditoFiscal          = $this->amount_total;
        $montoPago                   = $this->amount_total;
        $nitFactura                  = 6052128010;
        $nombreFactura               = 'YOSOLIDARIO';
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
