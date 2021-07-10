<div>
    <div class="hidden border-none border-gray-100 md:mt-2 mb-6 md:mb-0 font-bold py-2 pb-2 text-2xl">
        {{__('Rewards')}}
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6 mt-7">
        @foreach ($collection as $item)
        <div class="px-4 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
        
            @if($item->image_url)
                <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow bg-cover bg-center" 
                    style="background-image: url({{ URL::to('/').$item->image_url}})">
                </div>
            @endif
            
            <div class=" w-full bg-white @if($item->image_url) -mt-10 @endif  shadow rounded-lg overflow-hidden p-5 border border-gray-100">
            
                @if ($item->campaign->agency->country->code == $this->country_code)
                    <div class="title-post font-semibold text-xl">
                        {{$item->amount}} 
                        {{$item->campaign->agency->agencySetting->money->currency_symbol}}
                    </div>
                @else
                    <div class="title-post font-semibold text-xl">
                        {{  number_format(
                            $this->convertCurrency(
                                $item->amount, 
                                $item->campaign->agency->id,
                                $item->campaign->agency->agencySetting->money_id
                            ), 2 ) }}
                        {{$this->currency}}
                    </div>
                @endif
                <!-- description -->
                <div class="summary-post text-base text-justify mt-4">
                    {{$item->description}}
                </div>
                <!-- collaboratos -->
                <div class="header-content inline-flex mt-4">
                    <div class="category-title flex-1 text-sm">
                        @if ($item->limiter == 'YES')
                            <span> {{$item->collaborators}} / {{$item->quantity}}</span>
                            {{__('Collaborators')}} 
                        @elseif ($item->limiter == 'NO')
                            {{$item->collaborators}} {{__('Collaborators')}} 
                        @endif
                    </div>
                </div>
                <!-- delivery_date -->
                @if ($item->delivery_date)
                    <div class="text-sm text-justify mt-1">
                        {{__('Estimated delivery date')}}
                        <span class="font-semibold">
                            {{ \Carbon\Carbon::parse($item->delivery_date)->toFormattedDateString() }}
                        </span>
                    </div>
                @endif
                <!-- delivery_date -->
                @if ($item->delivery_date)
                    <div class="text-sm text-justify mt-1">
                        {{__('Estimated delivery date')}}
                        <span class="font-semibold">
                            {{ \Carbon\Carbon::parse($item->delivery_date)->toFormattedDateString() }}
                        </span>
                    </div>
                @endif
                <!-- options -->
                <hr class="mt-4 mb-5">
                <div class="flex justify-center items-center mt-5 sm:mt-0">
                    @if ($item->status == 'ACTIVE')
                        <x-button wire:click="backThisCampaign({{$item->campaign->id}}, {{$item->id}})"  wire:loading.attr="disabled">
                            <span class="material-icons-outlined pr-1">add_task</span>
                            <span>{{ __('Select this reward') }}</span>
                        </x-button>  
                    @else
                        <x-status-inactive>
                            <span class=" px-5">{{__('Exhausted')}}</span>
                        </x-status-inactive>
                    @endif
                    <!--
                    <button  wire:loading.attr="disabled" class="flex items-center justify-center px-4 py-2 text-center border border-ys1 rounded-md font-bold text-base  text-ys1 tracking-widest hover:text-white hover:bg-ys2 focus:border-bg-ys2 active:bg-ys2 focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        <span class="material-icons-outlined pr-1">add_task</span>
                        <span>{ __('Select this reward') }}</span>
                    </button>
                    -->
                </div>
            </div>
        </div>
        @endforeach
    </div>   
</div>