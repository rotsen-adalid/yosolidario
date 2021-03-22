<div>
@if ($collection->count() > 0)
    <div class="my-10 text-xl sm:text-3xl font-bold">
        {{__('Top fundraiser')}}
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-10">
        @foreach ($collection as $item)
        <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
            <div wire:click="view({{$item->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md border border-gray-100 bg-cover bg-center" 
                style="background-image: url({{ URL::to('/').$item->image->url}})">
            </div>

            <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">

                <div class="hidden lg:flex text-ys1 text-sm mb-1 uppercase font-bold" >
                    {!! nl2br(e($this->cutLetter($item->locality, 38)), false) !!}
                </div>

                <div class="lg:hidden text-ys1 text-sm mb-1 uppercase font-bold" >
                    {!! nl2br(e($this->cutLetter($item->locality, 33)), false) !!}
                </div>
                <!-- -->
                <div class="hidden lg:flex h-10 text-xl font-bold" >
                    {!! nl2br(e($this->cutLetter($item->title, 33)), false) !!}
                </div>

                <div class="lg:hidden h-16 text-xl font-bold" >
                    {!! nl2br(e($this->cutLetter($item->title, 60)), false) !!}
                </div>

                <div class="hidden lg:flex sm:h-14" >
                    {!! nl2br(e($this->cutLetter($item->extract, 100)), false) !!}
                </div>

                <div class="lg:hidden h-14" >
                    {!! nl2br(e($this->cutLetter($item->extract, 80)), false) !!}
                </div>

                <div class="space-x-1">
                    @if ($item->campaignCollected->last_deposit)
                        <span>{{__('Last collaboration')}}</span>
                        <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                    @else
                        <span>{{__('No collaborations')}}</span>
                    @endif
                </div>

                <!-- -->
                <div class="h-1 relative max-w-xl rounded-full overflow-hidden mt-2">
                    <div class="w-full h-full bg-gray-200 absolute"></div>
                    <div class="h-full bg-green-500 absolute" style="width:{{$item->campaignCollected->amount_percentage_collected}}%"></div>
                </div>
                <!-- -->
                <div class=" space-x-0 mt-3 campaigns-start">

                    @if ($item->agency->country->code == $this->country_code)
                        <span class="text-xl font-bold">
                            {{ number_format($item->campaignCollected->amount_collected, 2 ) }}
                            {{$item->agency->agencySetting->money->currency_symbol}}
                        </span>
                        <span class="lowercase">{{__('Raised from the goal of')}} </span>
                        <span class="font-bold">
                            {{ number_format($item->campaignCollected->amount_target, 2 ) }}
                            {{$item->agency->agencySetting->money->currency_symbol}}
                        </span>
                    @else
                        <span class="text-xl font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $item->campaignCollected->amount_collected, 
                                    $item->agency->agencySetting->buy_usd
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                        <span class="lowercase">{{__('Raised from the goal of')}} </span>
                        <span class="font-bold">
                            {{  number_format(
                                $this->convertCurrency(
                                    $item->campaignCollected->amount_target, 
                                    $item->agency->agencySetting->buy_usd
                                ), 2 ) }}
                            {{$this->currency}}
                        </span>
                    @endif
                   
                </div>

            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-10 justify-end flex items-center">
        <div  wire:click="discover" wire:loading.attr="disabled" class="float-right text-base text-gray-600 cursor-pointer">
             <span>{{__('See more')}}</span>
             <i class="uil uil-angle-right-b"></i>
        </div>
     </div>
@else
    <div>

    </div>
@endif

</div>