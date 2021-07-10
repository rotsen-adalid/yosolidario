<x-slot name="title">
    {{$organization->title}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
        <!-- facebook -->
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
        <meta property="og:url"        content="http://yosolidario.com/org/{{$organization->slug}}" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="{{$organization->name}}" />
        <meta property="og:description"  content="{{$organization->about}}" />
        <meta property="og:image"      content="https://yosolidario.com{{$organization->logo_path}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$organization->name}}">
        <meta name="twitter:description" content="{{$organization->about}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$organization->logo_path}}">

</x-slot>
<x-slot  name="menu">

</x-slot>
<div class="min-h-screen flex flex-col sm:justify-center sm:items-center">
    <div class="border rounded-lg" style="width: 258px;">
        <div class="bg-gray-300 h-64 w-64 rounded-lg shadow-md bg-cover bg-center object-cover" 
            style="background-image: url({{ $host.$organization->logo_path}})">
        </div>

        <div class=" w-full bg-white -mt-10  rounded-lg overflow-hidden p-2">
            <span class="text-xl font-bold">
                {{$organization->name}}
            </span>
            <!-- -->
            <div class="mt-4">
                <a href="https://www.yosolidario.com/{{$this->organization->slug}}" target="_blank" class="flex justify-center w-full px-4 py-2 sm:py-3 text-center bg-ys1 border border-ys2 rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-ys2 active:bg-ys2 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <span><img src="{{asset('images/icono.png')}}" class="h-5" alt=""></span>
                    <span>&nbsp;{{__('Donate now')}}</span>
                </a>
                <!-- <img src="{asset('images/icono.png')}}" class="h-14" alt=""> -->
            </div>
        </div>
    </div>
</div>