<div>
    @if ($this->campaign->agency->country->code == $this->country_code)
        <div class="mt-3 sm:mt-7 text-3xl sm:text-4xl text-ys1 font-bold">
            <span>{{ number_format($this->campaign->campaignCollected->amount_collected, 2 ) }}</span>
            <span class="ml-1">{{$this->campaign->agency->agencySetting->money->currency_symbol}}</span>
        </div>
        <div class="space-x-1">
            <span>{{__('Raised from the goal of')}} </span>
            <span class="font-bold">
                {{ number_format($this->campaign->campaignCollected->amount_target, 2 ) }}
                {{$this->campaign->agency->agencySetting->money->currency_symbol}}
            </span>
        </div>
    @else
        <div class="mt-3 sm:mt-7 text-3xl sm:text-4xl text-ys1 font-bold">
            <span>
                {{  number_format(
                    $this->convertCurrency(
                        $this->campaign->campaignCollected->amount_collected, 
                        $this->campaign->agency->agencySetting->buy_usd
                    ), 2 ) }}
            </span>
            <span class="ml-1">{{$this->currency}}</span>
        </div>
        <div class="space-x-1">
            <span>{{__('Raised from the goal of')}} </span>
            <span class="font-bold">
                {{  number_format(
                    $this->convertCurrency(
                        $this->campaign->campaignCollected->amount_target, 
                        $this->campaign->agency->agencySetting->buy_usd
                    ), 2 ) }}
                {{$this->currency}}
            </span>
        </div>
    @endif
    <!-- -->
    <div class="flex justify-between items-start mt-3 md:mt-2">
        <div class="text-sm sm:text-base ">
            <div class="text-black font-bold underline">
                <span>{{round($this->campaign->campaignCollected->collaborators)}}</span>
            </div>
            <div class="space-x-1">
                <span>{{__('Collaborators')}} </span>
            </div>
        </div>
        <div class="text-sm sm:text-base ">
            <div class="text-black font-bold">
                <span>{{round($this->campaign->shareds)}}</span>
            </div>
            <div class="space-x-1">
                <span>{{__('Shares')}} </span>
            </div>
        </div>
        <div class="text-sm sm:text-base ">
            <div class="text-black font-bold">
                <span>{{$this->save_collection->count()}}</span>
            </div>
            <div class="space-x-1">
                <span>{{__('Follewers')}} </span>
            </div>
        </div>
    </div>
    <!-- 
    <div class="mt-3 sm:mt-5  text-2xl sm:text-3xl text-black font-bold">
        <span>{$this->campaign->period}}</span>
    </div>
    <div class="space-x-1">
        <span>{__('more days')}} </span>
    </div>
    -->
    <!-- -->
    <div class="mt-5">
        <button 
            wire:click="backThisCampaign({{$this->campaign->id}})" wire:loading.attr="disabled" 
            class=" w-full px-4 py-2 sm:py-4 text-center bg-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-500 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
            <span>{{__('Back this campaign')}}</span>
        </button>
    </div>

    <div class="flex mt-2 space-x-2">
        @if ($this->saveStatus)
            <button wire:click="deleteSaveCampaign({{$this->campaign_save_id}})" wire:loading.attr="disabled" 
                class="flex justify-center items-center w-full text-center px-4 py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                <span class="material-icons-outlined">bookmark</span>
                {{__('Saved')}}
            </button>
        @else
            <button wire:click="saveCampaign({{$this->campaign->id}})" wire:loading.attr="disabled" 
                class="flex justify-center items-center w-full text-center px-4 py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                <span class="material-icons-outlined">bookmark_add</span>
                {{__('Remind me')}}
            </button>
        @endif

        <button  wire:click="shared" 
            class="flex justify-center items-center w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
            <span class="material-icons-outlined">share</span>
            {{__('Share')}}
        </button>
    </div>
    @include('livewire.campaigns.published.shared-published')
    
</div>
