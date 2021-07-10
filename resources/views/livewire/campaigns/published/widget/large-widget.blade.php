<x-slot name="title">
    {{$campaign->title}} : YoSolidario
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
<div class="min-h-screen flex flex-col sm:justify-center sm:items-center">
    <div class="border rounded-lg" style="width: 280px;">
        <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
            style="background-image: url({{ URL::to('/').$campaign->image->url}})">
        </div>

        <div class=" w-full bg-white -mt-10  rounded-lg overflow-hidden p-2">
            <span class="text-xl font-bold">
                {{$campaign->title}}
            </span>
            <!-- -->
            <div class="h-1 relative max-w-xl rounded-full overflow-hidden mt-3">
                <div class="w-full h-full bg-gray-200 absolute"></div>
                <div class="h-full bg-green-500 absolute" style="width:{{$campaign->campaignCollected->amount_percentage_collected}}%"></div>
            </div>
            <!-- -->

            @if ($this->campaign->agency->country->code == $this->country_code)
                <div class=" space-x-2 mt-3 campaigns-start">
                    <span class="text-2xl font-bold">
                        {{ number_format($this->campaign->campaignCollected->amount_collected, 2 ) }}
                        {{$this->campaign->agency->country->currency_symbol}}
                    </span>
                    <span>{{__('raised from the goal of')}} </span>
                    <span class="font-bold">
                        {{ number_format($this->campaign->campaignCollected->amount_target, 2 ) }}
                        {{$this->campaign->agency->country->currency_symbol}}
                    </span>
                </div>
            @else 
                <!-- sharing -->
                @if($this->campaign->campaignSharing)
                    <div class=" space-x-2 mt-3 campaigns-start">
                        <span class="text-2xl font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $this->campaign->campaignSharing->campaignSharingConvert->campaignCollected->amount_collected, 
                                    $this->campaign->campaignSharing->campaignSharingConvert->agency->id,
                                    $this->campaign->campaignSharing->campaignSharingConvert->agency->agencySetting->money_id
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                        <span>{{__('raised from the goal of')}} </span>
                        <span class="font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $this->campaign->campaignSharing->campaignSharingConvert->campaignCollected->amount_target, 
                                    $this->campaign->campaignSharing->campaignSharingConvert->agency->id,
                                    $this->campaign->campaignSharing->campaignSharingConvert->agency->agencySetting->money_id
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                    </div>
                @else 
                    <div class=" space-x-2 mt-3 campaigns-start">
                        <span class="text-2xl font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $this->campaign->campaignCollected->amount_collected, 
                                    $this->campaign->agency->id,
                                    $this->campaign->agency->agencySetting->money_id
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                        <span>{{__('raised from the goal of')}} </span>
                        <span class="font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $this->campaign->campaignCollected->amount_target, 
                                    $this->campaign->agency->id,
                                    $this->campaign->agency->agencySetting->money_id
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                    </div>
                @endif
            @endif
            <!-- -->
            <div class="mt-4">
                <a href="https://www.yosolidario.com/{{$this->campaign->slug}}" target="_blank" class="flex justify-center w-full px-4 py-2 sm:py-3 text-center bg-ys1 border border-ys2 rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-ys2 active:bg-ys2 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <span><img src="{{asset('images/icono.png')}}" class="h-5" alt=""></span>
                    <span>&nbsp;{{__('Back this campaign')}}</span>
                </a>
                <!-- <img src="{asset('images/icono.png')}}" class="h-14" alt=""> -->
            </div>
        </div>
    </div>
</div>