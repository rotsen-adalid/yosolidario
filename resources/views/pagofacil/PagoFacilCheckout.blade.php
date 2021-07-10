<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://checkout.pagofacil.com.bo//application/assets/assets/css/app.min.css" type="text/css">
<!-- begin::preloader-->
<div class="preloader" >
    <div style="-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;height: 100px ; width: 100px;text-align: center; background-image:url('https://checkout.pagofacil.com.bo//application/assets/assets/media/image/iconopreloader.png');"  >   
    </div>
    <div class=" preloaderleonardo preloader-iconleo" >
    </div>
</div>
 <!-- end::preloader -->

<div style="display:none0">
    <fieldset>
        <form id="FormCliente" >
            @csrf
            <label for=""> PedidoDeVenta: </label>
            <input type="text" name="PedidoDeVenta" value="{{$data->code_collection}}" >
            <br>
            <label for=""> Email: </label>
            <input type="text" name="Email" value="{{$data->email}}" >
            <br>
            <label for=""> Celular: </label>
            <input type="text" name="Celular" value="{{$data->phone}}" >
            <br>
            <label for=""> Monto: </label>
            <input type="number" name="Monto" value='{{$data->amount_total}}' >
            <br>
            <label for=""> MonedaVenta: </label>
            @if ($data->money->id == 1)
                <input type="text" name="MonedaVenta" value="2" >
            @elseif ($data->money->id == 2)
                <input type="text" name="MonedaVenta" value="1" >
            @endif
            
            <!--
            <select name="MonedaVenta" id="">
                <option value="2">Bs</option>
                <option value="1"> $u$</option>
            </select>
            -->
        </form>
    </fieldset>
    <br>
    <input type="button" name="" id="" value="Pagar Compra"  onclick="PrepararParametros()">

</div>
<!-- Este es el formulario del boton de pago checkout 
    que tiene los parametros que se envian al checkout  que son tcParametros  -  tcCommerceID -->
<form   method="post" id="FormPagoFacilCheckout" style="display:none" 
        action="https://checkout.pagofacil.com.bo/es/pay" enctype="multipart/form-data"  class="form">			
    <input   name="tcParametros" id="tcParametros"  type="text"  value="" > 
    <input   name="tcCommerceID"  id="tcCommerceID" type="text"  value=""  >
    <input type="submit" class="btn btn-primary" id="btnpagar" value="">
</form>

<script src="http://code.jquery.com/jquery-1.11.1.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="1e80906edbc96c168d73edb0-text/javascript"></script>
<script src="{{ asset('js/PagoFacilCheckoutClient.js') }}"></script> 
<script>
    PrepararParametros();
</script>
<style>
    @media
      only screen 
        and (max-width: 760px) {
    
        .imagenpreloader{
          
        
        height: 70px;
        margin: auto;
        opacity: 0.5;
        top: 44%;
        left: 43%;
        
        }
        .preloaderleo{
            display: inline-block;
            margin-top: 62px;
        }
        .preloaderleonardo{
            position: fixed;
            
    
        }
    }
    
    @media screen and (min-width: 770px) {
        .imagenpreloader{
            
        height: 70px;
        margin: auto;
        opacity: 0.5;
        top: 40%;
        left: 48%;
        
    }
    
    .preloaderleonardo{
        position: fixed;
           
    
        }
    }
    
</style>