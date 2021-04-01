<x-slot name="title">
    {{__('Collection code')}}: {{$paymentOrder->code_collection}}
</x-slot>
<x-slot  name="seo">
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-collaborate/>
</x-slot>
<div>
    <!--
    Tarjeta: 4000 0000 0000 0002
    Fecha de vencimiento: 01/23
    CVV: 123
    Password Verify by Visa: 1234 (si requiere)
    -->
    <div class="mt-10 sm:mt-16" style="background-color:#ecf1f6">
        <div class="max-w-5xl mx-auto py-0 px-0 sm:py-0 sm:px-0 ">
            <iframe src="https://test.sintesis.com.bo/payment-cybersource/#/cybersource?entidad=760&ref={{$paymentOrder->id_transaction}}&red={{$this->host}}/api/pagosnet/notification/cash" class="w-full h-screen sm:h-screen -mt-2 sm:-mt-14 pb-2 sm:pb-5 rounded-lg" scrolling="no">
            </iframe>
        </div>
    </div>
</div>
<livewire:footer.footer-collaborate/>
