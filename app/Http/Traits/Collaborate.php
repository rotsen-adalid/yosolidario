<?php
namespace App\Http\Traits;
use DOMDocument;
use Exception;
use SoapClient;

use App\Http\Traits\Utilities;

trait Collaborate {

    use Utilities;

    public $message;
    public $cuentaPagosNet      = 'wssolidario';
    public $passwordPagosNet    = 'Wssolidario2020';

    public function amountTotal() {
        if($this->amount_user != '') {
            /*
            if($this->amount_user >= 5 and $this->amount_user <= 14) {
                $this->collected_percentage_ys = array(
                    array("value" => "1","amount_user" => 1),
                    array("value" => "2","amount_user" => 2),
                    array("value" => "3","amount_user" => 3),
                );
                $this->amount_percentage_yosolidario = 1;
                $this->amount_yosolidario = $this->amount_percentage_yosolidario;
                $this->amount_total = (float)$this->amount_user + (float)$this->amount_percentage_yosolidario;
            */
            if($this->amount_user >= 5) {
                $x7 = $this->amount_user * 7 / 100;
                $x10 = $this->amount_user * 10 / 100;
                $x12 = $this->amount_user * 12 / 100;
                $x15 = $this->amount_user * 15 / 100;

                $this->collected_percentage_ys = array(
                    array("value" => "7","amount_user" => $x7),
                    array("value" => "10","amount_user" => $x10),
                    array("value" => "12","amount_user" => $x12),
                    array("value" => "15","amount_user" => $x15),
                );
        
                $this->amount_percentage_yosolidario = 12;
                $this->amount_yosolidario = (float)$this->amount_user * (float)$this->amount_percentage_yosolidario / 100;
                $this->amount_total = (float)$this->amount_user + (float)($this->amount_user * $this->amount_percentage_yosolidario / 100);
            } else {
                $this->collected_percentage_ys = array(
                    array("value" => "7","amount_user" => 0),
                    array("value" => "10","amount_user" => 0),
                    array("value" => "12","amount_user" => 0),
                    array("value" => "15","amount_user" => 0),
                );
        
                // $this->amount_percentage_yosolidario = 12;
                $this->amount_total = 0;
            }
        } else {
            $this->amount_yosolidario = 0;
        }
    }
    
    public function percentageAmountTotal() {
        if($this->amount_user) {
            if($this->amount_percentage_yosolidario != 'OTHER') {
                /*
                if($this->amount_user >= 5 and $this->amount_user <= 14) {
                    $this->amount_yosolidario = $this->amount_percentage_yosolidario;
                    $this->amount_total = (float)$this->amount_user + (float)$this->amount_percentage_yosolidario;
                */
                if($this->amount_user >= 5) { 
                    $this->amount_yosolidario = (float)($this->amount_user * $this->amount_percentage_yosolidario / 100);
                    $this->amount_total = $this->amount_user + (float)($this->amount_user * $this->amount_percentage_yosolidario / 100);
                } else { 
                    $this->amount_percentage_yosolidario = 12;
                    $this->amount_total = 0;
                }

            } elseif($this->amount_percentage_yosolidario == 'OTHER') {

                if($this->amount_user >= 5 and $this->amount_user <= 14) {
                    $this->amount_yosolidario = 0;
                }elseif($this->amount_user >= 15) {
                    $this->amount_yosolidario = 0;
                }

                $this->amount_total = $this->amount_user + (float)$this->amount_yosolidario;
            }
        }
    }
    
    public function amountOther() {
        if($this->amount_percentage_yosolidario == 'OTHER') {
            $this->amount_total = $this->amount_user + (float)$this->amount_yosolidario;
        }
    }

    //--------------------------------------- pagosNet
    private function conexionPagosNet() {
        // URL WS ambiente de PRE-PRODUCCION
        define("WSDL_PAGOSNET", "http://test.sintesis.com.bo/WSApp-war/ComelecWS?WSDL");
        //URL ambiente de PRODUCCION
        // wwwwwwwwww.wsdl produccion
    }

    private function pagosNetEfectivo(
        $currency, 
        $codeCollection,
        $email,
        $title,
        $amount_total,
        $name,
        $lastname
        ) 
    {

        // register data
        
        if($currency == 'Bs') {
            $monedaPn = 'BS';
        } elseif($currency == '$') {
            $monedaPn = 'US';
        }
       
        $codigoRecaudacionPn = $codeCollection;

        $this->conexionPagosNet();

        // echo ("Datos para registroPlan"); 
        //-----------------------   Registro Plan    ----------------------------
        //Request
        
        $categoriaProducto           = 1;
        $codigoComprador             = $codigoRecaudacionPn;      //código interno del cliente
        $codigoRecaudacion           = $codigoRecaudacionPn;  //identificador propio, el formato lo define el cliente
        $correoElectronico           = $email;
        $descripcionRecaudacion      = $title;
        $documentoIdentidadComprador = '';
        $fecha                       = date("Ymd");
        $fechaVencimiento            = 0;  //0 = no tiene vencimiento
        $hora                        = date("His");
        $horaVencimiento             = 0;  //0 = para no tiene vencimiento
        $moneda                      = $monedaPn; // BS=Bolivianos, US=Dolares, EU=Euros
        $nombreComprador             = $name.' '.$lastname;
        // Datos para array planillas
        $descripcion                 = $title;
        $montoCreditoFiscal          = 0; //$this->amount_total
        $montoPago                   = $amount_total;
        $nitFactura                  = '';
        $nombreFactura               = $name.' '.$lastname;
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
        $cuenta      = $this->cuentaPagosNet;
        $password    = $this->passwordPagosNet;

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
               
                $message = 'Registro Plan exitoso';
                $this->codigoRecaudacionPn = 'Recaudacion: ' . $codigoRecaudacion . '<br/>';
                $this->idTransaccionPn = 'Transaccion: ' . $resultPlan['idTransaccion'] . '<br/>';  	
                //var_dump($resultPlan1);
                //echo "<br/><br/>";
                //TODO: Cliente debe registrar las respuestas	
                
                $datosReturn = array(
                    'action' => true,

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
                    'descripcionError' => $message
                );

                return  $datosReturn;

            } else {
                $message =   'Registro Plan sin exito : { codError=' . $resultPlan['codigoError']
                                    . ', ' .
                                    'descripcionError=' . $resultPlan['descripcionError'] 
                                    . '}<br/>';	
                //TODO: Desplegar mensaje de error
                $datosReturn = array(
                    'action' => false,
                    'codigoRecaudacion' => $codigoRecaudacion,
                    'codigoError' => $resultPlan['codigoError'],
                    'descripcionError' => $resultPlan['descripcionError'] 
                );
                return  $datosReturn;
            }
            
        } catch(Exception $ex){
            //echo $ex->getMessage();
            if ($client != null){
                $this->escribirHandler($client->__getLastRequest() , $metodo, 'Request');
                $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');
            }
        }

    }

    public function pagosNetTarjeta(
                    $currency, 
                    $codeCollection,
                    $email,
                    $title,
                    $amount_total,
                    $name,
                    $lastname,
                    $locality,
                    $address
                    ) 
    {

        $ipapi = $this->ipapiData();

        // register data
        if($currency == 'Bs') {
            $monedaPn = 'BS';
        } elseif($currency == '$') {
            $monedaPn = 'US';
        }
       
        $codigoRecaudacionPn = $codeCollection;

        $this->conexionPagosNet();

        // echo ("Datos para registroPlan"); 
        //-----------------------   Registro Plan    ----------------------------
        //Request
        
        $categoriaProducto           = 3;
        $codigoComprador             = $codigoRecaudacionPn;      //código interno del cliente
        $codigoRecaudacion           = $codigoRecaudacionPn;  //identificador propio, el formato lo define el cliente
        $correoElectronico           = $email;
        $descripcionRecaudacion      = $title;
        $documentoIdentidadComprador = '';
        $fecha                       = date("Ymd");
        $fechaVencimiento            = 0;  //0 = no tiene vencimiento
        $hora                        = date("His");
        $horaVencimiento             = 0;  //0 = para no tiene vencimiento
        $moneda                      = $monedaPn; // BS=Bolivianos, US=Dolares, EU=Euros
        $nombreComprador             = $name.' '.$lastname;
        // Datos para array planillas
        $descripcion                 = $title;
        $montoCreditoFiscal          = 0; //$this->amount_total
        $montoPago                   = $amount_total;
        $nitFactura                  = '';
        $nombreFactura               = $name.' '.$lastname;
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
        $cuenta      = $this->cuentaPagosNet;
        $password    = $this->passwordPagosNet;

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
               
                $message = 'Registro Plan exitoso';
                $this->codigoRecaudacionPn = 'Recaudacion: ' . $codigoRecaudacion . '<br/>';
                $this->idTransaccionPn = 'Transaccion: ' . $resultPlan['idTransaccion'] . '<br/>';  	
                //var_dump($resultPlan1);
                //echo "<br/><br/>";
                //TODO: Cliente debe registrar las respuestas	
                
               

            } else {
                $message =   'Registro Plan sin exito : { codError=' . $resultPlan['codigoError']
                                    . ', ' .
                                    'descripcionError=' . $resultPlan['descripcionError'] 
                                    . '}<br/>';	
                //TODO: Desplegar mensaje de error
                $datosReturn = array(
                    'action' => false,
                    'codigoRecaudacion' => $codigoRecaudacion,
                    'codigoError' => $resultPlan['codigoError'],
                    'descripcionError' => $resultPlan['descripcionError'] 
                );
                return  $datosReturn;
            }

        if(!$address) {
            $adress = $locality;
        } else {
            $adress = $address;
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
        $telefono                    = $this->phone;
        $pais                        = $ipapi['country_name']; //'Bolivia';
        $departamento                = $ipapi['region_name']; //'La Paz';
        $ciudad                      = $locality;
        $direccion                   = $adress;

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
                $this->message = '<h>Registro de Tarjeta Habiente exitoso... <br/>';	
                //ar_dump($responseRegistroTarjetaHabiente1);
                //echo '<br/><br/>';
            }else{
                $this->message = 'Registro de Tarjetahabiente fallido: codError=' . $responseRegistroTarjetaHabiente['codigoError'] 
                                    . ', ' .
                                    'descripcionError=' . $responseRegistroTarjetaHabiente['descripcionError'] 
                                    . '<br/>';	
            }

            //Preparo la invocación del WS registroMdd
            //Metodo para registrar transacciones hacia cybersource.
            //------------------------------------------------------------------------------------
            $comercioId                  = '760';  
            $id                          = '0';	  //id transaccion del MDD
            $transaccionMdd              = 'A';   // A=Alta, M=Modificacion, B=Baja de datos de un transaccion Cybersource .
            $vertical                    = 'Servicios'; //Tipo de servicio puede ser: Servicios,Retail Servicios, Delivery Foods, Retail, Travel, Hoteles (Sintesis lo provee)
            
            if(auth()->user()) {
                $entry= array(
                    array(
                    'key'     => "merchant_defined_data1",   // Se describe en un excel que provee Sintesis
                    'value'	  => 'SI',
                    ),
                    /*array(
                    'key'     => "merchant_defined_data2",
                    'value'	  => auth()->user->created_at,
                    ),*/
                    array(
                        'key'     => "merchant_defined_data12",
                        'value'	  => $this->phone,
                    ),
                    array(
                        'key'     => "merchant_defined_data18",
                        'value'	  => $this->name.' '.$this->lastname,
                    ),
                    array(
                        'key'     => "merchant_defined_data87",
                        'value'	  => $codigoRecaudacionPn,
                    ),
                    array(
                        'key'     => "merchant_defined_data88",
                        'value'	  => $title,
                    )
                );
            } else {
                $entry= array(
                    array(
                    'key'     => "merchant_defined_data1",   // Se describe en un excel que provee Sintesis
                    'value'	  => 'NO',
                    ),
                    array(
                        'key'     => "merchant_defined_data12",
                        'value'	  => $this->phone,
                    ),
                    array(
                        'key'     => "merchant_defined_data18",
                        'value'	  => $this->name.' '.$this->lastname,
                    ),
                    array(
                        'key'     => "merchant_defined_data87",
                        'value'	  => $codigoRecaudacionPn,
                    ),
                    array(
                        'key'     => "merchant_defined_data88",
                        'value'	  => $title,
                    )
                );
            }


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
                $this->message = '<h>Registro del Tarjetahabiente exitoso... <br/>';	
                //var_dump($responseRegistroMdd1);
                //echo '<br/><br/>';
            }else{
                $this->message = 'Registro de transaccion hacia cybersource fallido: codError=' . $responseRegistroMdd['codigoError'] 
                                    . ', ' .
                                    'descripcionError=' . $responseRegistroMdd['descripcionError'] 
                                    . '<br/>';	
            }

            $datosReturn = array(
                'action' => true,

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
                'descripcionError' => $message,

                'transaccionTH' => $transaccionTH,
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'pais' => $pais,
                'departamento' => $departamento,
                'ciudad' => $ciudad,
                'direccion' => $direccion,

                'comercioId' => $comercioId,
                'id_mdd' => $id,
                'transaccionMdd' => $transaccionMdd,
                'vertical' => $vertical,
            );
            return  $datosReturn;
            
        } catch(Exception $ex){
            //echo $ex->getMessage();
            if ($client != null){
                $this->escribirHandler($client->__getLastRequest() , $metodo, 'Request');
                $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');
            }
        }

    }

    //Funciones para llamar a los servicios web de PagosNet

	/**
	 * Metodo para registrar una recaudacion en PagosNet
	 * @param type $client Instancia del cliente SOAP
	 * @param type $params Parametros para registrar una recaudacion en PagosNet.
	 */
	function registroPlan($client, $params) {
	    $metodo = 'registroPlan';
	    $response = $client->__soapCall($metodo, array($params));

	    //escribo el request y el response de la invocación. Esta información puede servir de log
	    //posteriormente
	    $this->escribirHandler($client->__getLastRequest(), $metodo, 'Request');
	    $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');

	    //Para comodidad, paso de objeto a array
	    $response =get_object_vars($response);
		$response=$response['return'];
		$responseRegistroPlan=get_object_vars($response);
	    return $responseRegistroPlan;
	}


	/**
	 * Metodo para registrar items a partir de una recaudacion previamente registrada.
	 * @param type $client Instancia del cliente SOAP
	 * @param type $params Parametros para invocar al servicio de registro de items.
	 * @return type
	 */
	function registroItem($client, $params) {
	    $metodo = 'registroItem';
	    $response = $client->__soapCall($metodo, array($params));

	    //escribo el request y el response de la invocación. Esta información puede servir de log
	    //posteriormente
	    $this->escribirHandler($client->__getLastRequest(),  $metodo, 'Request');
	    $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');

	    //Para comodidad, paso de objeto a array
	    $response =get_object_vars($response);
		$response=$response['return'];
		$responseRegistroItem=get_object_vars($response);
	    return $responseRegistroItem;
	}

	/**
	 * Metodo para registrar datos de un tarjetahabiente.
	 * @param type $client Instancia del cliente SOAP
	 * @param type $params Parametros para realizar el consumo del servicio web.
	 * @return type
	 */
	function registroTarjetaHabiente($client, $params) {
	    //invoco el servicio
	    $metodo = 'registroTarjetaHabiente';
	    $response = $client->__soapCall($metodo, array($params));

	    //escribo el request y el response de la invocación. Esta información puede servir de log
	    //posteriormente
	    $this->escribirHandler($client->__getLastRequest(),  $metodo, 'Request');
	    $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');

	    //Para comodidad, paso de objeto a array
	    $response =get_object_vars($response);
		$response=$response['return'];
		$responseRegistroTarjetaHabiente=get_object_vars($response);
	    return $responseRegistroTarjetaHabiente;
	}


     /**
	 * Metodo para registrar datos de un tarjetahabiente.
	 * @param type $client Instancia del cliente SOAP
	 * @param type $params Parametros para realizar el consumo del servicio web.
	 * @return type
	 */
	function registroMdd($client, $params) {
	    //invoco el servicio
	    $metodo = 'registroMdd';
	    $response = $client->__soapCall($metodo, array($params));

	    //escribo el request y el response de la invocación. Esta información puede servir de log
	    //posteriormente
	    $this->escribirHandler($client->__getLastRequest(),  $metodo, 'Request');
	    $this->escribirHandler($client->__getLastResponse(), $metodo, 'Response');

	    //Para comodidad, paso de objeto a array
	    $response =get_object_vars($response);
		$response=$response['return'];
		$responseRegistroMdd=get_object_vars($response);
	    return $responseRegistroMdd;
	}
    // LLamar a las funciones 
    





    //Funciones auxiliares 
	//-----------------------------------------------------------------------------------------------
	  function obj2array($obj) {
	    $out = array();
	    foreach ($obj as $key => $val) {
	      switch(true) {
	        case is_object($val):
		  $out[$key] = $this->obj2array($val);
		  break;
		case is_array($val):
		  $out[$key] = $this->obj2array($val);
		  break;
		default:
		  $out[$key] = $val;
	      }
	    }
	    return $out;
	  }


	function escribirHandler($raw_xml, $metodo, $tipo){
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