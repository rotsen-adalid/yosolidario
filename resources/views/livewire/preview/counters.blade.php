<div class="h-5 relative max-w-xl rounded-full overflow-hidden mt-5 sm:mt-10">
    <div class="w-full h-full bg-gray-200 absolute"></div>
    <div class="h-full bg-ys1 absolute rounded-full" style="width:{{$this->campaign->amount_percentage_collected}}%"></div>
</div>
<div class="mt-3 sm:mt-5 text-3xl sm:text-4xl text-ys1 font-bold">
    <span>{{ number_format($this->campaign->amount_collected, 2 ) }}</span>
    <span class="ml-1">{{$this->campaign->country->currency_symbol}}</span>
</div>
<div class="space-x-1">
    <span>{{__('raised from the goal of')}} </span>
    <span class="font-bold">
        {{ number_format($this->campaign->amount_target, 2 ) }}
        {{$this->campaign->country->currency_symbol}}
    </span>
</div>
<!-- -->
<div class="mt-3 sm:mt-5 text-2xl sm:text-3xl text-black font-bold">
    <span>{{$this->campaign->collaborators}}</span>
</div>
<div class="space-x-1">
    <span>{{__('collaborators')}} </span>
</div>
<!-- -->
<div class="mt-3 sm:mt-5  text-2xl sm:text-3xl text-black font-bold">
    <span>{{$this->campaign->period}}</span>
</div>
<div class="space-x-1">
    <span>{{__('more days')}} </span>
</div>
<!-- -->
<div class="mt-5">
    <button class="w-full px-4 py-2 sm:py-4 text-center bg-yellow-400 border border-yellow-500 rounded-md font-bold text-lg text-black uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-500 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
        {{__('Back this campaign')}}
    </button>
</div>

<div class="flex mt-2 space-x-2">
    <button class="w-full text-center px-4 py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-base text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-bookmark"></i>
        {{__('Remind me')}}
    </button>
    <button class="w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-base text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-share-alt"></i>
        {{__('Share')}}
    </button>
</div>