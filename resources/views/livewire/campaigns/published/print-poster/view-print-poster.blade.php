<x-slot name="title">
    {{$campaign->title}} : YoSolidario.com
</x-slot>
<x-slot  name="seo">
    
        <!-- facebook -->
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
        <meta property="og:url"        content="http://yosolidario.com/{{$campaign->slug}}" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="{{$campaign->title}}" />
        <meta property="og:description"  content="{{$campaign->extract}}" />
        <meta property="og:image"      content="https://yosolidario.com{{$campaign->image->url}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$campaign->title}}">
        <meta name="twitter:description" content="{{$campaign->extract}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$campaign->image->url}}">

</x-slot>
<x-slot  name="menu">

</x-slot>
<div class="bg-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">

    <div id="areaImprimir" class="flex justify-center flex-col items-center">
        <div  class="py-10 border-b">
            <img src="{{asset('images/logo-page.png')}}" class="h-20" alt="">
        </div>
        <div class="text-2xl py-5 items-center font-bold text-gray-700">
            <span class="material-icons-outlined">search</span>
            <span>{{__('Search yosolidario.com for')}}</span>
        </div>
        <div class="pt-5 font-bold text-5xl text-center">
            {{$campaign->title}}
        </div>
        <div class="pt-5">
            <img src="{{$campaign->image->url}}" class="h-96" alt="">
        </div>
       
        <div class="pt-7 font-bold text-lg text-ys1">
            yosolidario.com/{{$campaign->slug}}
        </div>
        <div class="font-semibold py-5  font-bold text-gray-700 text-2xl">
            {{__('Show your support by going to this link')}}
        </div>
    </div>
</div>

<script>
    printDiv();
    function printDiv() {
        var nombreDiv = 'areaImprimir';
        var contenido= document.getElementById(nombreDiv).innerHTML;
        var contenidoOriginal= document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
</script>