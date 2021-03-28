<x-slot name="title">
    {{__('Collaborate with')}} {{$this->campaign->title}}
</x-slot>
<x-slot  name="seo">
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-collaborate/>
</x-slot>

<div>
    <x-dialog-modal-loading wire:model="loadindPay">
        <x-slot name="content">
            <span class="text-lg">{{__('equesting payment')}}...</span>
        </x-slot>
    </x-dialog-modal-loading>
    <div class="bg-gray-100 mt-16">
        <!-- -->
        <div class="max-w-5xl mx-auto px-4 sm:px-2 py-10">
            <div class="md:grid md:grid-cols-3 md:gap-6">

                <div class="mt-5 md:mt-0 md:col-span-2">
                
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="p-5 sm:px-16 sm:py-16 bg-white space-y-6 ">

                        <div class="text-center font-semibold text-3xl">
                            {{__('Indicate your collaboration')}} <br>
                        </div>
                        <div>
                            <div class="flex justify-center">
                                <div class="mt-1 flex rounded-md shadow-sm sm:mx-5">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-900 text-2xl sm:text-5xl font-bold">
                                        {{$this->currency}}
                                    </span>
                                    <input type="text" name="amount_collaborator" id="amount_collaborator" wire:model="amount_collaborator"  wire:keyup="amountTotal" onKeyPress="return validar(event)" maxlength="9" 
                                    class="focus:ring focus:ring-gray-50 focus:ring-opacity-50 focus:border-gray-200 flex-1 block w-full rounded-none text-2xl sm:text-5xl border-l-0 border-r-0 border-gray-200 font-bold shadow-xs text-right  bg-gray-50" placeholder="">
                                    <span class="inline-flex items-center pr-3 rounded-r-md border border-l-0 border-gray-300 bg-white text-gray-900 text-2xl sm:text-5xl font-bold  bg-gray-50">
                                        ,00
                                    </span>
                                </div>
                            </div>
                            <x-input-error for="amount_collaborator" class="mt-2" />
                        </div>

                        <div class="sm:px-5">
                            <div class="block text-basefont-medium text-gray-700">{{__('YoSolidiario will continue to offer its services thanks to an optional contribution that collaborators will make here:')}}</div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-10">
                                <div class="block text-base font-medium text-gray-700 mt-3">{{__('Thank you for your input from:')}}</div>

                                    <div class="space-y-2">

                                            <x-select class="mt-1 w-full" id="amount_percentage_yosolidario" wire:model="amount_percentage_yosolidario" wire:change="percentageAmountTotal">
                                                <x-slot name="option">
                                                    @foreach ($collected_percentage_ys as $item)
                                                        <option value="{{$item['value']}}">
                                                            @if ($this->amount_collaborator >= 5 and $this->amount_collaborator <= 14)
                                                                <span>{{$item['amount_collaborator']}}</span>
                                                                <span>
                                                                    {{$this->currency}}
                                                                </span>
                                                            @elseif($this->amount_collaborator >= 15)
                                                                <span>{{$item['value']}}%</span>
                                                                @if ($item['amount_collaborator'] != 0)
                                                                    <span>
                                                                        (<span>{{ number_format($item['amount_collaborator'], 2 ) }}</span>
                                                                        <span>
                                                                            {{$this->currency}}
                                                                        </span>)
                                                                    </span>
                                                                @endif 
                                                            @else
                                                                <span>{{$item['value']}}%</span>
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                    <option value="OTHER">{{__('Other')}}</option>
                                                </x-slot>
                                            </x-select>
                                            <x-input-error for="amount_percentage_yosolidario" class="mt-2" />
                                        
                                        @if ($this->amount_percentage_yosolidario == 'OTHER')
                                            <div class="">
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-900 text-sm font-bold">
                                                        {{$this->currency}}
                                                    </span>
                                                    <input type="text" name="amount_yosolidario" id="amount_yosolidario" wire:model="amount_yosolidario"  wire:keyup="amountOther"
                                                    class="focus:ring focus:ring-gray-50 focus:ring-opacity-50 focus:border-gray-200 flex-1 block rounded-r border-gray-200 font-bold shadow-xs text-right  bg-gray-50 w-20" placeholder="">
                                                    <!-- focus:ring focus:ring-gray-50 focus:ring-opacity-50 focus:border-gray-200 flex-1 block rounded-r sm:text-sm border-gray-200 font-bold shadow-xs text-right  bg-gray-50 -->
                                                </div>
                                                <x-input-error for="amount_collaborator" class="mt-2" />
                                            </div>
                                        @endif
                                        @if ($amount_total > 0)
                                            <div class="font-bold">
                                                {{__('Total')}}: 
                                                <span>{{ number_format($amount_total, 2 ) }}</span>
                                                <span>
                                                    {{$this->currency}}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                
                            </div>
                        </div>

                        <!-- your nane -->
                        <div class="col-span-6 sm:col-span-4">
                            <div class="sm:flex space-y-4 sm:space-y-0 sm:space-x-2">
                                <div class="w-full">
                                    <x-label for="name" value="{{ __('Name') }}" required/>
                                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autocomplete="off"/>
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-label for="lastname" value="{{ __('Lastnames') }}" required/>
                                    <x-input id="lastname" type="text" class="mt-1 block w-full" wire:model.defer="lastname" autocomplete="off"/>
                                    <x-input-error for="lastname" class="mt-2" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="show_name" class="flex items-center">
                                    <x-checkbox id="show_name" name="show_name" wire:model.defer="show_name" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Hide the name of everyone except the organizer') }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="email" value="{{ __('Your email address') }}"/>
                            <x-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="email" autocomplete="off"/>
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <!-- phone -->
                        @if ($this->campaign->agency->country->code == $this->country_code)
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="phone" value="{{ __('Your number phone') }}"/>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-white text-gray-900 text-sm font-bold">
                                        {{$this->telephone_prefix}}
                                    </span>
                                    <input type="text" name="phone" id="phone" wire:model="phone"   minlength="6" maxlength="20"
                                    class="focus:ring focus:ring-gray-50 focus:ring-opacity-50 focus:border-gray-200 flex-1 block rounded-r border-gray-200 shadow-xs  bg-white w-20"> <!-- placeholder="{__('Number phone')}}" -->
                                </div>
                                <x-input-error for="phone" class="mt-2" />
                            </div>
                        @else
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="locality" value="{{ __('Your number phone') }}"/>
                                <div class="flex space-x-1">
                                    <div class="w-56">
                                        <x-select class="mt-1 block w-full" id="country_id" name="country_id" wire:model.defer="country_id">
                                            <x-slot name="option">
                                                    <option value="">{{ __('Country') }}</option>
                                                @foreach ($collection_countries as $item)
                                                    <option value="{{$item->id}}">{{ __($item->name) }}</option>
                                                @endforeach
                                            </x-slot>
                                        </x-select>
                                    </div>
                                    <div class="w-full">
                                        <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone" autocomplete="off" minlength="6" maxlength="20"/>
                                        <x-input-error for="phone" class="mt-2" />
                                    </div>
                                </div>
                                <x-input-error for="country_id" class="mt-2" />
                                <x-input-error for="phone" class="mt-2" />
                            </div>
                        @endif
                        
                        <!-- commentary -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="commentary" value="{{ __('Write here what you want to say to the organizer of the campaign') }}"/>
                            <x-textarea id="commentary" class="mt-1 block w-full" rows="3" wire:model.defer="commentary" autocomplete="off" minlength="5" maxlength="170"/>
                            <x-input-error for="commentary" class="mt-2" />
                        </div>
                        {{$this->messagePn}}
                        <div class="col-span-6 sm:col-span-4">
                            <div class="flex sm:flex-row flex-col sm:space-x-4 space-y-2 sm:space-y-0 justify-center">
                                <div class="flex items-center space-x-2">
                                    <input wire:model="payment_method" name="payment_method" type="radio" value="CASH"
                                    class="rounded h-4 w-4 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                    <span class="font-semibold">{{__('Cash payment')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input wire:model="payment_method" name="payment_method" type="radio" value="CARD"
                                    class="rounded h-4 w-4 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                    <span class="font-semibold">{{__('Visa Mastercard card')}}</span>
                                </div>
                            </div>
                            <x-input-error for="payment_method" class="mt-2 text-center" />
                        </div>

                        <div class="hidden sm:block">
                            <div class="py-1">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        
                        <div class="px-4 text-center sm:px-6">
                            <x-accent-button wire:click="pagosNet(0)" wire:loading.attr="disabled" class="text-lg py-4 px-10">
                                {{__('Back this campaign')}}
                            </x-accent-button>
                        </div>

                        <div class="hidden sm:block">
                            <div class="py-1">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>
                        
                        <div class="px-10">
                            <div class="block text-sm font-medium text-gray-700">
                                {{__('By continuing, you accept the conditions of YoSolidario and agree to our privacy statement.')}}
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('campaign/published',  $this->campaign->slug) }}" class="text-ys1 font-bold">{{__('Return')}}</a>
                            </div>
                        </div>

                    </div>
                    </div>
                
                </div>
                
                <div class="md:col-span-1 mt-5 sm:mt-0">
                <div class="p-4 shadow bg-white border border-gray-50 rounded-md">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mt-2 sm:mt-0">
                        {{$this->cutLetter($campaign->title, 25)}}
                    </h3>
                    <div>
                        <img src="{{ URL::to('/').$this->campaign->image->url}}" alt="">
                    </div>
                    <div>
                        @if ($this->campaign->agency->country->code == $this->country_code)
                            <div class="mt-3 sm:mt-7 text-3xl sm:text-4xl text-ys1 font-bold">
                                <span>{{ number_format($this->campaign->campaignCollected->amount_collected, 2 ) }}</span>
                                <span class="ml-1">{{$this->currency}}</span>
                            </div>
                            <div class="space-x-1">
                                <span>{{__('Raised from the goal of')}} </span>
                                <span class="font-bold">
                                    {{ number_format($this->campaign->campaignCollected->amount_target, 2 ) }}
                                    {{$this->currency}}
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
                    </div>
                    <!-- -->
                    <div class="h-5 relative max-w-xl rounded-full overflow-hidden mt-5">
                        <div class="w-full h-full bg-gray-200 absolute"></div>
                        <div class="h-full bg-green-500 absolute" style="width:{{$this->campaign->campaignCollected->amount_percentage_collected}}%"></div>
                    </div>
                    <div class="mt-5 flex justify-center border-t border-gray-200 pt-3">
                        <img src="{{asset('images/logo-page.png')}}" class="h-7" alt="">
                    </div>
                </div>
                <div class="my-5">
                    <div class="text-base text-gray-700">{{__('Organizer information')}}</div>

                    <div class="mt-1 px-4 sm:p-4 shadow bg-white border border-gray-50 rounded-md">
                        <div class="flex my-2 sapce-x-2">
                            @if($this->campaign->user->profile_photo_path)
                            <div wire:click="viewUser({{$this->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                                <img class="w-full h-full rounded-full"
                                    src="{{ URL::to('/') }}{{$this->campaign->user->profile_photo_path}}"
                                    alt="" />
                            </div>
                            @else 
                            <div wire:click="viewUser({{$this->campaign->user->id}})" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                                <img class="w-full h-full rounded-full"
                                    src="{{ $this->campaign->user->profile_photo_url }}" alt="{{ $this->campaign->user->name }}" />
                            </div>
                            @endif
                            <div class="ml-3 space-y-2">
                                <div wire:click="viewUser({{$this->campaign->user->id}})" class="text-gray-700 text-sm sm:text-base cursor-pointer text-semibold"> 
                                    {{$this->campaign->user->name}}
                                </div>
                            </div>
                        </div>
                        <div class="my-5 pt-3 border-t border-gray-200 space-y-1">
                            <div class="text-sm text-gray-700">
                                {{__('This person receives the collaboration directly.')}}
                            </div>
                            <div class="text-sm text-gray-700">
                                {{__('The collaboration is protected by the YoSolidario guarantee.')}}
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </div>
            </div>

        <!-- -->
    </div>
</div>
<script type="text/javascript">
    function validar(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
        if (tecla==44) return true; //Coma ( En este caso para diferenciar los decimales )
        if (tecla==48) return true;
        if (tecla==49) return true;
        if (tecla==50) return true;
        if (tecla==51) return true;
        if (tecla==52) return true;
        if (tecla==53) return true;
        if (tecla==54) return true;
        if (tecla==55) return true;
        if (tecla==56) return true;
        patron = /1/; //ver nota
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }

    function validarOther(e) {
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==8) return true; //Tecla de retroceso (para poder borrar)
        if (tecla==44) return true; //Coma ( En este caso para diferenciar los decimales )
        if (tecla==48) return true;
        if (tecla==49) return true;
        if (tecla==50) return true;
        if (tecla==51) return true;
        if (tecla==52) return true;
        if (tecla==53) return true;
        if (tecla==54) return true;
        if (tecla==55) return true;
        if (tecla==56) return true;
        patron = /1/; //ver nota
        te = String.fromCharCode(tecla);
        return patron.test(te);
    }
</script>
<livewire:footer.footer-collaborate/>
