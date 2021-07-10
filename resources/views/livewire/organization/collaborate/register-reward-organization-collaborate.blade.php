<x-slot name="title">
    {{__('Collaborate with')}} {{$this->organization->name}}
</x-slot>
<x-slot  name="seo">
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-collaborate/>
</x-slot>

<div class="mt-10 sm:mt-16" style="background-color:#fbf8f6">
    <!-- -->
    <div class="max-w-5xl mx-auto px-4 sm:px-2 py-10">
        <div class="md:grid md:grid-cols-3 md:gap-6">

            <div class="mt-5 md:mt-0 md:col-span-2">
            
                <div class="shadow-md sm:rounded-md sm:overflow-hidden">
                <div class="p-5 sm:px-16 sm:pt-10 sm:pb-16 bg-white space-y-6 ">
                    <a href="{{ route('org',  $this->organization->slug) }}" 
                        class="flex items-center space-x-1 py-1 px-2 w-auto">
                        <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                        <span>{{__('Return')}}</span>
                    </a>
                
                    <div class="flex flex-col sm:flex-row space-x-2 items-center">
                        <div>
                            <img src="{{ $host.$this->organization->logo_path}}" alt="" class="h-28 w-24 object-cover">
                        </div>
                        <div>
                            <div>
                                <span class="text-base">{{__('You\'re supporting')}}</span>
                                <span class="text-lg font-bold">{{$organization->name}}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">{{__('Benerifiario de tu donativo')}}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-center ">
                        <div class="flex rounded-md shadow-sm sm:mx-0 w-full bg-gray-100">
                            @if ($organizationReward->organization->agency->country->code == $this->country_code)
                                <span class="w-full py-2 inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 text-gray-900 text-2xl sm:text-4xl font-bold">
                                    {{$this->currency}}

                                </span>
                                <span class="inline-flex py-2 items-center pr-3 rounded-r-md border border-l-0 border-gray-300 text-gray-900 text-2xl sm:text-4xl font-bold ">
                                    {{ number_format($organizationReward->amount, 2 )}}
                                </span>
                            @else
                                <span class="w-full py-2 inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 text-gray-900 text-2xl sm:text-4xl font-bold">
                                    {{$this->currency}}

                                </span>
                                <span class="inline-flex py-2 items-center pr-3 rounded-r-md border border-l-0 border-gray-300 text-gray-900 text-2xl sm:text-4xl font-bold ">
                                    {{  number_format(
                                        $this->convertCurrency(
                                            $organizationReward->amount, 
                                            $organizationReward->organization->agency->id,
                                            $organizationReward->organization->agency->agencySetting->money_id
                                        ), 2 ) }}
                                </span>
                            @endif
                        </span>
                        </div>
                    </div>

                    <div>
                        <div class="mb-4">
                            <span class="font-bold uppercase">{{__('Tip YOSOLIDARIO services')}}</span>
                        </div>
                        <div class="mt-1 block text-basefont-medium text-gray-700">{{__('YoSolidiario will continue to offer its services thanks to an optional contribution that collaborators will make here:')}}</div>
                        <div class="flex space-x-5 mt-4">
                            <div class="w-6/12">
                                <x-select class="mt-1 w-full" id="amount_percentage_yosolidario" wire:model="amount_percentage_yosolidario" wire:change="percentageAmountTotal">
                                    <x-slot name="option">
                                        @foreach ($collected_percentage_ys as $this->organizationReward)
                                            <option value="{{$this->organizationReward['value']}}">
                                                <!-- 
                                                if ($this->amount_user >= 5 and $this->amount_user <= 14)
                                                    <span>{$this->organizationReward['amount_user']}}</span>
                                                    <span>
                                                        {$this->currency}}
                                                    </span>
                                                -->
                                                @if($this->amount_user >= 5)
                                                    <span>{{$this->organizationReward['value']}}%</span>
                                                    @if ($this->organizationReward['amount_user'] != 0)
                                                        <span>
                                                            (<span>{{ number_format($this->organizationReward['amount_user'], 2 ) }}</span>
                                                            <span>
                                                                {{$this->currency}}
                                                            </span>)
                                                        </span>
                                                    @endif 
                                                @else
                                                    <span>{{$this->organizationReward['value']}}%</span>
                                                @endif
                                            </option>
                                        @endforeach
                                        <option value="OTHER">{{__('Other')}}</option>
                                    </x-slot>
                                </x-select>
                                <x-input-error for="amount_percentage_yosolidario" class="mt-2" />
                            </div>
                            <div class="w-6/12">
                                @if ($this->amount_percentage_yosolidario == 'OTHER')
                                <div class="">
                                    <x-input type="text" class="mt-1 block w-full" name="amount_yosolidario" id="amount_yosolidario" wire:model="amount_yosolidario" autocomplete="off" wire:keyup="amountOther" onKeyPress="return validar(event)"/>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- your nane -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="sm:flex space-y-4 sm:space-y-0 sm:space-x-2">
                            <div class="w-full">
                                <x-label for="name" class="font-bold" value="{{ __('Name') }}" required/>
                                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autocomplete="off"/>
                                <x-input-error for="name" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-label for="lastname" class="font-bold" value="{{ __('Lastnames') }}" required/>
                                <x-input id="lastname" type="text" class="mt-1 block w-full" wire:model="lastname" autocomplete="off"/>
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

                    <!-- address -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="sm:flex space-y-4 sm:space-y-0 sm:space-x-2">
                            <div class="w-full">
                                <x-label for="locality" class="font-bold" value="{{ __('City or locality') }}" required/>
                                <x-input id="locality" type="text" class="mt-1 block w-full" wire:model="locality" autocomplete="off"/>
                                <x-input-error for="locality" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <x-label for="address" class="font-bold" value="{{ __('Your address') }}"/>
                                <x-input id="address" type="text" class="mt-1 block w-full" wire:model="address" autocomplete="off"/>
                                <x-input-error for="address" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- country --
                    <div class="col-span-6 sm:col-span-4">
                        <div class="sm:flex space-y-4 sm:space-y-0 sm:space-x-2">
                            <div class="w-full">
                                <x-label for="phone" class="font-bold" value="{ __('Your country') }}"/>
                                <x-select class="mt-1 block w-full" id="country_id" name="country_id" wire:model="country_id">
                                    <x-slot name="option">
                                            <option value="">{ __('Country') }}</option>
                                        foreach ($collection_countries as $this->organizationReward)
                                            <option value="{$this->organizationReward->id}}">{ __($this->organizationReward->name) }}</option>
                                        endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                            <div class="w-full">
                                <x-label for="phone" class="font-bold" value="{__('Your')}} {__($this->states_denomination)}}"/>
                                <x-select class="mt-1 block w-full" id="country_state_id" name="country_state_id" wire:model="country_state_id">
                                    <x-slot name="option">
                                            <option value="">{__($this->states_denomination)}}</option>
                                        foreach ($collection_country_states as $this->organizationReward)
                                            <option value="{$this->organizationReward->id}}">{__($this->organizationReward->name) }}</option>
                                        endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- email -->
                    <div class="col-span-6 sm:col-span-4">
                        <div class="sm:flex space-y-4 sm:space-y-0 sm:space-x-2">
                            <div class="w-full">
                                <x-label for="email" class="font-bold" value="{{ __('Your email address') }}"/>
                                <x-input id="email" type="text" class="mt-1 block w-full" wire:model="email" autocomplete="off"/>
                                <x-input-error for="email" class="mt-2" />
                            </div>
                            <div class="w-full">
                                <!-- phone -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-label for="phone" class="font-bold" value="{{ __('Your number phone') }}" required/>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-white text-gray-900 text-sm font-bold">
                                            {{$this->phone_prefix}}
                                        </span>
                                        <input type="text" name="phone" id="phone" wire:model="phone"   minlength="6" maxlength="20"
                                        class="focus:ring focus:ring-gray-50 focus:ring-opacity-50 focus:border-gray-200 flex-1 block rounded-r border-gray-200 shadow-xs  bg-white w-20"> <!-- placeholder="{__('Number phone')}}" -->
                                    </div>
                                    <x-input-error for="phone" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- commentary 
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="commentary" class="font-semibold" value="{{ __('Write here what you want to say to the beneficiary of the campaign') }}"/>
                        <x-textarea id="commentary" class="mt-1 block w-full" rows="2" wire:model.defer="commentary" autocomplete="off" minlength="5" maxlength="170"/>
                        <x-input-error for="commentary" class="mt-2" />
                    </div>
                    -->
                    <div  class="">
                        <div class="font-bold uppercase mb-4">
                            {{__('Payment method')}}
                        </div>
                        @if ($this->organization->agency->country->code == $this->country_code)
                        <div class="flex sm:flex-col flex-col space-y-2 sm:space-y-2 justify-center">
                            <div class="flex items-center space-x-2">
                                <input wire:model="payment_method" name="payment_method" type="radio" value="CASH"
                                class="rounded-full h-5 w-5 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                <div>
                                    <div class="font-bold text-base">{{__('Cash payment')}}</div>
                                    <div class="">+1800 {{__('Payment points, Banks, Pharmacies, Commercial premises, etc')}}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 border-t border-gray-100 py-2">
                                <input wire:model="payment_method" name="payment_method" type="radio" value="CARD"
                                class="rounded-full h-5 w-5 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                <div>
                                    <div class="font-bold">{{__('Visa Mastercard card')}}</div>
                                    <div>{{__('Debit, credit and prepaid')}}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 border-t border-gray-100 py-2">
                                <input wire:model="payment_method" name="payment_method" type="radio" value="MOBILE_WALLET"
                                class="rounded-full h-5 w-5 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                <div>
                                    <div class="font-bold">{{__('Mobile wallet')}}</div>
                                    <div>{{__('TigoMoney, SoliPagos PagoFacil ')}}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 border-t border-gray-100 py-2">
                                <input wire:model="payment_method" name="payment_method" type="radio" value="QR_PAYMENT"
                                class="rounded-full h-5 w-5 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                <div>
                                    <div class="font-bold">{{__('QR Payment')}}</div>
                                    <div>{{__('QR bank transfer')}}</div>
                                </div>
                            </div>
                        </div>
                        @else 
                        <div class="flex sm:flex-col flex-col space-y-2 sm:space-y-2 justify-center">
                            <div class="flex items-center space-x-2 border-t border-gray-100 py-2">
                                <input wire:model="payment_method" name="payment_method" type="radio" value="CARD"
                                class="rounded-full h-5 w-5 border-green-500 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50" />
                                <div>
                                    <div class="font-bold">{{__('Visa Mastercard card')}}</div>
                                    <div>{{__('Debit, credit and prepaid')}}</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <x-input-error for="payment_method" class="mt-2 text-center" />
                    </div>
                    
                    <div class="px-4 text-center sm:px-6">
                        <x-accent-button wire:click="pay" wire:loading.attr="disabled" class="text-lg py-4 px-10">
                            {{__('Donate')}}
                        </x-accent-button>
                        
                    </div>

                    <div class="hidden sm:block">
                        <div class="py-1">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>
                    
                    <div class="px-10">
                        <div class="block text-sm font-medium text-gray-900">
                            {{__('By continuing, you accept the conditions of YoSolidario and agree to our privacy statement.')}}
                        </div>
                    </div>

                </div>
                </div>
            
            </div>
            
            <div class="md:col-span-1 mt-5 sm:mt-0">
            <div class="p-4 shadow-md bg-white border border-gray-50 rounded-md">
                <div class="leading-6 text-gray-900 mt-2 sm:mt-0 font-bold uppercase">
                    {{__('Your donation')}}
                </div>
                <div class="border-b border-gray-200 py-5">
                    <div class="flex justify-between text-gray-600 text-base">
                        <span>{{__('Your donation')}}</span>
                        @if ($this->amount_user)
                            <span>{{ number_format($this->amount_user, 2 ) }}
                                {{$this->currency}}
                            </span>
                        @else
                            <span>0.00
                                {{$this->currency}}
                            </span>
                        @endif
                        
                    </div>
                    <div class="flex justify-between text-gray-600 pt-2">
                        <span>{{__('YoSolidario tip')}}</span>
                        @if ($this->amount_yosolidario)
                            <span>{{ number_format($this->amount_yosolidario, 2 ) }}
                                {{$this->currency}}
                            </span>
                        @else
                            <span>0.00
                                {{$this->currency}}
                            </span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="flex justify-between pt-2 text-base font-semibold">
                        <span>{{__('Total due today')}}</span>
                        @if ($this->amount_total)
                            <span>{{ number_format($this->amount_total, 2 ) }}
                                {{$this->currency}}
                            </span>
                        @else
                            <span>0.00
                                {{$this->currency}}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
           
            <!-- -->
            <div class=" mt-6  max-w-sm mx-auto">
                <div class="uppercase font-bold text-left mb-2">{{__('Your reward')}}</div>
                @if($organizationReward->image_url)
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg bg-cover bg-center" 
                        style="background-image: url({{ URL::to('/').$organizationReward->image_url}})">
                    </div>
                @endif
                <div class=" w-full bg-white @if($organizationReward->image_url) -mt-10 @endif  shadow-md rounded-lg overflow-hidden p-5">
                    @if ($organizationReward->organization->agency->country->code == $this->country_code)
                        <div class="title-post font-semibold text-xl">
                            {{$organizationReward->amount}} 
                            {{$this->currency}}
                        </div>
                    @else
                        <div class="title-post font-semibold text-xl">
                            {{  number_format(
                                $this->convertCurrency(
                                    $organizationReward->amount, 
                                    $organizationReward->organization->agency->id,
                                    $organizationReward->organization->agency->agencySetting->money_id
                                ), 2 ) }}
                            {{$this->currency}}
                        </div>
                    @endif
                    <!-- description -->
                    <div class="summary-post text-base text-justify mt-4">
                        {{$organizationReward->description}}
                    </div>
                    <!-- delivery_date -->
                    @if ($organizationReward->delivery_date)
                    <div class="text-sm text-justify mt-1">
                        {{__('Estimated delivery date')}}
                        <span class="font-semibold">
                            {{ \Carbon\Carbon::parse($organizationReward->delivery_date)->toFormattedDateString() }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="my-5">
                <div class="font-bold uppercase ">{{__('We protect your donation')}}</div>
                <div class="flex justify-start items-center space-x-2">
                    <img class="h-12" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjUxMnB0IiB2aWV3Qm94PSIwIC0xNTUgNTEyIDUxMiIgd2lkdGg9IjUxMnB0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Im0yNTMuNjc1NzgxIDg1Ljk2MDkzOGMtNi41IDAtMTEuNzg5MDYyLTQuNDcyNjU3LTExLjc4OTA2Mi05Ljk2ODc1IDAtNS40OTYwOTQgNS4yODkwNjItOS45Njg3NSAxMS43ODkwNjItOS45Njg3NSA1LjExMzI4MSAwIDkuNjI1IDIuNzc3MzQzIDExLjIyMjY1NyA2LjkxNDA2MiAyLjk4ODI4MSA3LjcyNjU2MiAxMS42Nzk2ODcgMTEuNTY2NDA2IDE5LjQwMjM0MyA4LjU3ODEyNSA3LjcyNjU2My0yLjk4ODI4MSAxMS41NjY0MDctMTEuNjc1NzgxIDguNTc4MTI1LTE5LjQwMjM0NC02LjAzNTE1Ni0xNS42MDU0NjktMjEuNzg5MDYyLTI2LjA4OTg0My0zOS4yMDMxMjUtMjYuMDg5ODQzLTIzLjA0Mjk2OSAwLTQxLjc4OTA2MiAxNy45Mjk2ODctNDEuNzg5MDYyIDM5Ljk2ODc1IDAgMjIuMDM5MDYyIDE4Ljc0NjA5MyAzOS45Njg3NSA0MS43ODkwNjIgMzkuOTY4NzUgNi41MDM5MDcgMCAxMS43OTI5NjkgNC40NzI2NTYgMTEuNzkyOTY5IDkuOTY4NzUgMCA1LjUtNS4yODkwNjIgOS45Njg3NS0xMS43OTI5NjkgOS45Njg3NS00Ljk1MzEyNSAwLTkuNDIxODc1LTIuNjY3OTY5LTExLjEwOTM3NS02LjY0MDYyNi0zLjI0MjE4Ny03LjYyNS0xMi4wNTA3ODEtMTEuMTcxODc0LTE5LjY3NTc4MS03LjkzMzU5My03LjYyNSAzLjI0MjE4Ny0xMS4xNzU3ODEgMTIuMDU0Njg3LTcuOTI5Njg3IDE5LjY3NTc4MSA2LjQzMzU5MyAxNS4xMjUgMjEuNjI4OTA2IDI0Ljg5ODQzOCAzOC43MTQ4NDMgMjQuODk4NDM4IDIzLjA0Njg3NSAwIDQxLjc5Mjk2OS0xNy45Mjk2ODggNDEuNzkyOTY5LTM5Ljk2ODc1IDAtMjIuMDM5MDYzLTE4Ljc0NjA5NC0zOS45Njg3NS00MS43OTI5NjktMzkuOTY4NzV6bTAgMCIvPjxwYXRoIGQ9Im0zNTguMjg1MTU2IDg1Ljk2MDkzOGMtNi41MDM5MDYgMC0xMS43OTI5NjgtNC40NzI2NTctMTEuNzkyOTY4LTkuOTY4NzUgMC01LjQ5NjA5NCA1LjI4OTA2Mi05Ljk2ODc1IDExLjc5Mjk2OC05Ljk2ODc1IDUuMTEzMjgyIDAgOS42MjEwOTQgMi43NzczNDMgMTEuMjIyNjU2IDYuOTE0MDYyIDIuOTg4MjgyIDcuNzI2NTYyIDExLjY3OTY4OCAxMS41NjY0MDYgMTkuMzk4NDM4IDguNTc4MTI1IDcuNzMwNDY5LTIuOTg4MjgxIDExLjU3MDMxMi0xMS42NzU3ODEgOC41ODIwMzEtMTkuNDAyMzQ0LTYuMDM5MDYyLTE1LjYwNTQ2OS0yMS43OTI5NjktMjYuMDg5ODQzLTM5LjIwMzEyNS0yNi4wODk4NDMtMjMuMDQyOTY4IDAtNDEuNzkyOTY4IDE3LjkyOTY4Ny00MS43OTI5NjggMzkuOTY4NzUgMCAyMi4wMzkwNjIgMTguNzUgMzkuOTY4NzUgNDEuNzkyOTY4IDM5Ljk2ODc1IDYuNSAwIDExLjc5Mjk2OSA0LjQ3MjY1NiAxMS43OTI5NjkgOS45Njg3NSAwIDUuNS01LjI5Mjk2OSA5Ljk2ODc1LTExLjc5Mjk2OSA5Ljk2ODc1LTQuOTU3MDMxIDAtOS40MjE4NzUtMi42Njc5NjktMTEuMTEzMjgxLTYuNjQwNjI2LTMuMjQyMTg3LTcuNjI1LTEyLjA1MDc4MS0xMS4xNzE4NzQtMTkuNjc1NzgxLTcuOTMzNTkzLTcuNjIxMDk0IDMuMjQyMTg3LTExLjE3MTg3NSAxMi4wNTQ2ODctNy45Mjk2ODggMTkuNjc1NzgxIDYuNDM3NSAxNS4xMjUgMjEuNjMyODEzIDI0Ljg5ODQzOCAzOC43MTg3NSAyNC44OTg0MzggMjMuMDQyOTY5IDAgNDEuNzkyOTY5LTE3LjkyOTY4OCA0MS43OTI5NjktMzkuOTY4NzUgMC0yMi4wMzkwNjMtMTguNzUtMzkuOTY4NzUtNDEuNzkyOTY5LTM5Ljk2ODc1em0wIDAiLz48cGF0aCBkPSJtNDk3IDEzMy40NjA5MzhoLTQzLjMzOTg0NHYtODBjMC04LjI4MTI1LTYuNzE0ODQ0LTE1LTE1LTE1cy0xNSA2LjcxODc1LTE1IDE1djk1YzAgOC4yODUxNTYgNi43MTQ4NDQgMTUgMTUgMTVoNTguMzM5ODQ0YzguMjg1MTU2IDAgMTUtNi43MTQ4NDQgMTUtMTUgMC04LjI4MTI1LTYuNzE0ODQ0LTE1LTE1LTE1em0wIDAiLz48cGF0aCBkPSJtMTQyLjYxMzI4MSA3MC4yNzM0Mzh2LTE3LjQzNzVjMC0yOS4xMzY3MTktMjUuMTA5Mzc1LTUyLjgzNTkzOC01NS45NzI2NTYtNTIuODM1OTM4LTMwLjg1NTQ2OSAwLTU1Ljk1NzAzMSAyMy43MDMxMjUtNTUuOTU3MDMxIDUyLjgzNTkzOHYxNy40MzM1OTNjLTE3LjczNDM3NSA1LjMzOTg0NC0zMC42ODM1OTQgMjEuNzYxNzE5LTMwLjY4MzU5NCA0MS4xNDQ1MzF2NDcuNTI3MzQ0YzAgMjMuNjk5MjE5IDE5LjM1NTQ2OSA0Mi45ODQzNzUgNDMuMTQ4NDM4IDQyLjk4NDM3NWg4Ni45ODQzNzRjMjMuNzg5MDYzIDAgNDMuMTQ0NTMyLTE5LjI4NTE1NiA0My4xNDQ1MzItNDIuOTg0Mzc1di00Ny41MjczNDRjMC0xOS4zNzUtMTIuOTM3NS0zNS43OTI5NjgtMzAuNjY0MDYzLTQxLjE0MDYyNHptLjY2NDA2MyA4OC42Njc5NjhjMCA3LjE1NjI1LTUuODk0NTMyIDEyLjk4NDM3NS0xMy4xNDQ1MzIgMTIuOTg0Mzc1aC04Ni45ODQzNzRjLTcuMjUgMC0xMy4xNDg0MzgtNS44MjQyMTktMTMuMTQ4NDM4LTEyLjk4NDM3NXYtNDcuNTI3MzQ0YzAtNy4xNTYyNSA1Ljg5ODQzOC0xMi45ODA0NjggMTMuMTQ4NDM4LTEyLjk4MDQ2OGg4Ni45ODQzNzRjNy4yNSAwIDEzLjE0NDUzMiA1LjgyNDIxOCAxMy4xNDQ1MzIgMTIuOTgwNDY4em0tNTYuNjM2NzE5LTEyOC45NDE0MDZjMTQuMzI0MjE5IDAgMjUuOTc2NTYzIDEwLjI0MjE4OCAyNS45NzY1NjMgMjIuODM1OTM4djE1LjU5NzY1NmgtNTEuOTMzNTk0di0xNS42MDE1NjNjMC0xMi41ODk4NDMgMTEuNjQ0NTMxLTIyLjgzMjAzMSAyNS45NTcwMzEtMjIuODMyMDMxem0wIDAiLz48cGF0aCBkPSJtMTAwLjc1NzgxMiAxMzYuOTcyNjU2YzAtNy43NS02LjMyMDMxMi0xNC4wMzUxNTYtMTQuMTE3MTg3LTE0LjAzNTE1NnMtMTQuMTE3MTg3IDYuMjg1MTU2LTE0LjExNzE4NyAxNC4wMzUxNTZjMCA3Ljc1MzkwNiA2LjMyMDMxMiAxNC4wMzkwNjMgMTQuMTE3MTg3IDE0LjAzOTA2M3MxNC4xMTcxODctNi4yODUxNTcgMTQuMTE3MTg3LTE0LjAzOTA2M3ptMCAwIi8+PC9zdmc+" />
                    <img class="h-6" src="{{asset('images/in.png')}}" alt="">
                </div>
            </div>
            </div>
        </div>
        </div>

    <!-- -->
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
