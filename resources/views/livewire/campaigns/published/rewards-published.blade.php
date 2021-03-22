<div>
    <div class=" border-b md:mt-4 mb-5 font-bold py-2 pb-2 text-2xl">
        {{__('Rewards')}}
    </div>
    <div class=" pt-10 md:pt-10 sm:pt-8">
        @foreach ($collection as $item)
        <div class=" md:mb-6 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto pb-10">
            @if($item->image_url)
                <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
                    style="background-image: url({{ URL::to('/').$item->image_url}})">
                </div>
            @endif

            <div class=" w-full bg-white @if($item->image_url) -mt-10 @endif  shadow-lg rounded-lg overflow-hidden p-5 border">
            
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
                                $item->campaign->agency->agencySetting->buy_usd
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
                            <span> 0 / {{$item->quantity}}</span>
                            {{__('Collaborators')}} 
                        @elseif ($item->limiter == 'NO')
                            0 {{__('Collaborators')}} 
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
                    <button  wire:loading.attr="disabled" class="flex items-center justify-center px-4 py-2 text-center border border-ys1 rounded-md font-bold text-base  text-ys1 tracking-widest hover:text-white hover:bg-ys2 focus:border-bg-ys2 active:bg-ys2 focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        <span class="material-icons-outlined pr-1">add_task</span>
                        <span>{{ __('Select this reward') }}</span>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>    
</div>