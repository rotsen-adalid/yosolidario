<div>
    @if ($collection)
        @if ($collection->count() > 0)
        <div class="my-10 text-2xl sm:text-3xl font-bold">
            {{__('Top fundraiser')}}
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-10">
            @foreach ($collection as $item)
            <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
                <div wire:click="view({{$item->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-36 sm:h-56 w-full rounded-lg sm:shadow sm:border border-gray-100 bg-cover bg-center" 
                    style="background-image: url({{URL::to('/').$item->image->url}})">
                </div>

                <div class=" w-full bg-white -mt-10 sm:shadow sm:rounded-lg overflow-hidden p-0 sm:p-5">

                    <div class="hidden lg:flex truncate-single-line  text-ys1 text-sm mb-1 uppercase font-bold" >
                        {!! nl2br(e($this->cutLetter($item->countryState->name, 38)), false) !!}
                    </div>

                    <div class="lg:hidden truncate-single-line text-ys1 text-sm mt-2 sm:mt-0 mb-1 uppercase font-bold" >
                        {!! nl2br(e($this->cutLetter($item->countryState->name, 33)), false) !!}
                    </div>
                    <!-- -->
                    <div class="hidden lg:flex h-10 text-xl font-bold truncate-single-line" >
                        {!! nl2br(e($this->cutLetter($item->title, 32)), false) !!}
                    </div>

                    <div class="lg:hidden h-16 text-xl font-bold" >
                        {!! nl2br(e($this->cutLetter($item->title, 21)), false) !!}
                    </div>

                    <div class="hidden lg:flex sm:h-14" >
                        {!! nl2br(e($this->cutLetter($item->extract, 100)), false) !!}
                    </div>

                    <div class="hidden h-14" >
                        {!! nl2br(e($this->cutLetter($item->extract, 18)), false) !!}
                    </div>

                    <div class="truncate-single-line space-x-1">
                        @if ($item->campaignCollected->last_deposit)
                            <span>{{__('Last collaboration')}}</span>
                            <span>{{ \Carbon\Carbon::parse($item->campaignCollected->last_deposit)->diffForHumans() }}</span>
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
                    
                    <div class="truncate-single-line space-x-0 mt-3 campaigns-start">
                        
                        <!-- campaign sharing-->

                        @if ($item->agency->country->code == $this->country_code)

                            <span class="sm:text-xl font-bold">
                                {{ number_format($item->campaignCollected->amount_collected, 2 ) }}
                                {{$item->agency->agencySetting->money->currency_symbol}}
                            </span>
                            <span class="lowercase">{{__('Raised from the goal of')}} </span>
                            <span class="font-bold">
                                {{ number_format($item->campaignCollected->amount_target, 2 ) }}
                                {{$item->agency->agencySetting->money->currency_symbol}}
                            </span>
                            
                        @else

                            <!-- sharing -->
                            @if($item->campaignSharing)
                                <span class="text-xl font-bold">
                                    {{  number_format(
                                        $this->convertCurrency(
                                            $item->campaignSharing->campaignSharingConvert->campaignCollected->amount_collected, 
                                            $item->campaignSharing->campaignSharingConvert->agency->id,
                                            $item->campaignSharing->campaignSharingConvert->agency->agencySetting->money_id
                                        ), 2 ) }}
                                    {{$this->currency}}
                                </span>
                                <span class="lowercase">{{__('Raised from the goal of')}} </span>
                                <span class="font-bold">
                                    {{  number_format(
                                        $this->convertCurrency(
                                            $item->campaignSharing->campaignSharingConvert->campaignCollected->amount_target, 
                                            $item->campaignSharing->campaignSharingConvert->agency->id,
                                            $item->campaignSharing->campaignSharingConvert->agency->agencySetting->money_id
                                        ), 2 ) }}
                                    {{$this->currency}}
                                </span>
                            @else 
                                <span class="text-xl font-bold">
                                    {{  number_format(
                                        $this->convertCurrency(
                                            $item->campaignCollected->amount_collected, 
                                            $item->agency->id,
                                            $item->agency->agencySetting->money_id
                                        ), 2 ) }}
                                    {{$this->currency}}
                                </span>
                                <span class="lowercase">{{__('Raised from the goal of')}} </span>
                                <span class="font-bold">
                                    {{  number_format(
                                        $this->convertCurrency(
                                            $item->campaignCollected->amount_target, 
                                            $item->agency->id,
                                            $item->agency->agencySetting->money_id
                                        ), 2 ) }}
                                    {{$this->currency}}
                                </span>
                            @endif
    
                        @endif

                    </div>

                </div>
            </div>
            @endforeach
        </div>
        <div class="hidden sm:flex mt-10 justify-end items-center">
            <div  wire:click="discover" wire:loading.attr="disabled" class="float-right text-base text-gray-600 cursor-pointer">
                <span>{{__('See more')}}</span>
                <i class="uil uil-angle-right-b"></i>
            </div>
        </div>
        <div  wire:click="discover" wire:loading.attr="disabled"
            class="sm:hidden mt-10 justify-center items-center w-full border border-ys1 py-2 rounded">
            <div  class="text-base text-center text-ys1 cursor-pointer">
                <span>{{__('See more')}}</span>
            </div>
        </div>
    @else
        <div>

        </div>
    @endif
    @endif
</div>
