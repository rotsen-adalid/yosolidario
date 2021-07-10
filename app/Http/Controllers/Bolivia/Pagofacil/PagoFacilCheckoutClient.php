<?php
namespace App\Http\Controllers\Bolivia\Pagofacil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentOrder;

class PagoFacilCheckoutClient extends Controller
{
    public $PedidoDeVenta, $Email, $Celular, $Monto, $MonedaVenta;

    public function inicio(PaymentOrder $paymentOrder){
        
        $PedidoDeVenta = $paymentOrder;

        return View('pagofacil.PagoFacilCheckout', ['data' => $PedidoDeVenta]);
    }

    public function Encript(){

        parse_str( $_POST['goFormularioCliente'], $loFormDatos);
		 // campos del formulario del cliente
		 $lcPedidoID=$loFormDatos['PedidoDeVenta'] ;
		 $lcEmail= $loFormDatos['Email'] ;
		 $lnTelefono=$loFormDatos['Celular'] ;
		 $lnMonto=$loFormDatos['Monto'] ; 
		 $lcMoneda=$loFormDatos['MonedaVenta'] ;
		 $lcParametro1="https://admin.yosolidario.com/api/pagofacil/callback";
		 $lcParametro2="Url Return (Página de retorno para el cliente final, e.g. Página de confirmación de compra)";
		 $lcParametro3="";
		 $lcParametro4="11";// este parametro es estatco para este tipo de integracion se debe mantener en 11 nomas
 
         /***
          *  $lcParametros1 =   URL callback del comerciok, este metodo se utiliza para notificar al comercio que el pago fue realizado correctamente, 
                                el comercio debera realizar sus procesos correspondientes al realizar un pago.

             $lcParametros2 =   URL de retorno, esta ruta es netamente web, y sera la URL de redireccion del comercio, hacia donde se redirigira
                                al cliente luego de terminar el pago.
          */
        
		// aqui estoy guardando lo mismo pero para crear la firma
		$tcCommerceID ="16dc368a89b428b2485484313ba67a3912ca03f2b2b42429174a4f8b3dc84e44";
        $lcTokenServicio="51247fae280c20410824977b0781453df59fad5b23bf2a0d14e884482f91e09078dbe5966e0b970ba696ec4caf9aa5661802935f86717c481f1670e63f35d50420a1442db87f3c878211b61aca1eedd96c62c9c9d3f39868ecde5a62698bbf8999bacc11a190cfcb76cf10bff86cd4302b30e85bda6ba70ac0c8cc6a191f3dc5";
        $lcTokenSecret="79672FAC98234006BD8FB11A";
        
        try {
            
            $lcCadenaAFirmar= "$lcTokenServicio|$lcEmail|$lnTelefono|$lcPedidoID|$lnMonto|$lcMoneda|$lcParametro1|$lcParametro2|$lcParametro3|$lcParametro4" ;
		 
            // aqui se genera la firma  con la variable $lcCadenaAFirmar
            $lcFirma= hash('sha256', $lcCadenaAFirmar);
    
            // aqui  se concatena de nuevo pero utilizando la firma al comienzo 
            $lcDatosPago="$lcFirma|$lcEmail|$lnTelefono|$lcPedidoID|$lnMonto|$lcMoneda|$lcParametro1|$lcParametro2|$lcParametro3|$lcParametro4" ;
            
            //Esto es el proceso de encriptacion que ocupa php 
            $lnSizeDatosPago=strlen($lcDatosPago);

            $lcDatosPago=str_pad($lcDatosPago,($lnSizeDatosPago+8-($lnSizeDatosPago%8)), "\0");
            //aqui se genera y se guarda  la variable tcparametros, resultado de la encriptacion de los datos con 3DES

            $tcParametros =   openssl_encrypt($lcDatosPago, "DES-EDE3", $lcTokenSecret ,OPENSSL_ZERO_PADDING);

            $laData['tcParametros']= base64_encode($tcParametros);
            $laData['tcCommerceID']=$tcCommerceID;
            
            
            //este codigo solo sirve para verificar si lo que estan encriptando esta bien 
            $tcParametrosDesencriptado= openssl_decrypt($tcParametros, 'DES-EDE3', $lcTokenSecret,  OPENSSL_ZERO_PADDING);
            $laData['tcParametrosDesencriptado']= $tcParametrosDesencriptado;
            ////////////////////////////////////////////////////////////////////////////

            return response()->json($laData);
        } catch (\Throwable $th) {
            return null;
        }
    }
}
