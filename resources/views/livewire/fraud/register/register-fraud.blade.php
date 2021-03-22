
<x-slot name="title">
    {{__('Report a Fundraiser')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
      
<div class="mt-20 bg-wthite">
<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-4">
                    {{__('Report a Fundraiser')}}
                </h2>
            </div>
        </header>
    </x-slot>
    <x-slot  name="content">
        <x-form-section-multiple submit="Store">
            <x-slot name="form">
                <x-input-section>
                    <x-slot name="title">
                        <!-- <span class="font-semibold">{ __('Reporting a Fundraiser') }}</span> -->
                    </x-slot>
                
                    <x-slot name="description">
                        <div class="sm:pt-3">
                            {{ __('YoSolidario is dedicated to empowering people to help others, and an overwhelming majority of fundraisers on our platform are safe and legitimate. In the rare instance that someone creates a fundraiser with the intention to mislead collaboratos , our team takes swift action.') }}
                        </div>
                        <div class="sm:pt-3">
                            {{ __('Among other things, we rely on community reports for information. In most instances, information reported to us will not be shared with the organizer or beneficiary by us. Your help in keeping our platform safe is greatly appreciated.') }}
                        </div>
                    </x-slot>
                    <x-slot name="form">
                         <!-- name -->
                         <div class="col-span-6 sm:col-span-4">
                            <x-label for="name" value="{{ __('Your name') }}" required/>
                            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autofocus  autocomplete="off" minlength="2" maxlength="100" /> <!-- wire:keyup="generateSlug"  -->
                            <x-input-error for="name" class="mt-2" />
                        </div>
                        <!-- country_id -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="locality" value="{{ __('Your number phone') }}" required/>
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
                                    <x-input id="number_phone" type="text" class="mt-1 block w-full" placeholder="{{__('Number phone')}}" wire:model.defer="number_phone" autocomplete="off" minlength="6" maxlength="20"/>
                                    <x-input-error for="number_phone" class="mt-2" />
                                </div>
                            </div>
                            <x-input-error for="country_id" class="mt-2" />
                            <x-input-error for="number_phone" class="mt-2" />
                        </div>
                        <!-- email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="email" value="{{ __('Your email') }}" required/>
                            <x-input id="email" type="text" class="mt-1 block w-full" wire:model.defer="email"  autocomplete="off" minlength="2" maxlength="100" /> <!-- wire:keyup="generateSlug"  -->
                            <x-input-error for="email" class="mt-2" />
                        </div>
                        <!-- url_campaign -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="url_campaign" value="{{ __('URL page') }}" required/>
                            <x-input id="url_campaign" type="text" class="mt-1 block w-full" wire:model.defer="url_campaign"  autocomplete="off" minlength="2" maxlength="100" /> <!-- wire:keyup="generateSlug"  -->
                            <x-input-error for="url_campaign" class="mt-2" />
                            <div class="text-gray-500 text-sm mt-2">{{ __('Please enter the URL in this format: https://www.yosolidario.com/example-campaign') }}</div>
                        </div>
                        <!-- know_organizer -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="know_organizer" value="{{ __('Do you know the Campaign Organizer?') }}" required/>
                            <div class="flex">
                                <x-select class="mt-1 block w-full" id="know_organizer" wire:model="know_organizer">
                                    <x-slot name="option">
                                        <option value="">{{ __('Pleace select one') }}</option>
                                        <option value="YES">{{ __('Yes, I know the Campaign Organizer') }}</option> <!--selected -->
                                        <option value="NO">{{ __('No, I do not know the Campaign Organizer') }}</option>
                                    </x-slot>
                                </x-select>
                            </div>
                            <x-input-error for="know_organizer" class="mt-2" />
                        </div>
                        <!-- know_organizer_describe -->
                        @if ($know_organizer == 'YES')
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="know_organizer_describe" value="{{ __('How do you know the campaign organizer?') }}" required/>
                            <x-textarea id="know_organizer_describe" type="text" class="mt-1 block w-full" wire:model.defer="know_organizer_describe"  autocomplete="off" />
                            <x-input-error for="know_organizer_describe" class="mt-2" />
                        </div>
                        @endif
                        @if ($know_organizer == 'NO')
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="know_organizer_describe" value="{{ __('How are you connected to the campaign?') }}" required/>
                                <x-textarea id="know_organizer_describe" type="text" class="mt-1 block w-full" wire:model.defer="know_organizer_describe"  autocomplete="off" />
                                <x-input-error for="know_organizer_describe" class="mt-2" />
                            </div>
                        @endif
                        
                         <!-- whistleblower -->
                         <div class="col-span-6 sm:col-span-4">
                            <x-label for="whistleblower" value="{{ __('Which best describes you?') }}" required/>
                            <div class="flex">
                                <x-select class="mt-1 block w-full" id="whistleblower" wire:model="whistleblower">
                                    <x-slot name="option">
                                        <option value="">{{ __('Pleace select one') }}</option>
                                        <option value="BENEFICIARY">{{ __('I am a beneficiary') }}</option> <!--selected -->
                                        <option value="COLLABORATOR">{{ __('I am a collaborator') }}</option>
                                        <option value="OTHER">{{ __('I am a individual concerned about this campaign') }}</option>
                                    </x-slot>
                                </x-select>
                            </div>
                            <x-input-error for="whistleblower" class="mt-2" />
                        </div>
                        <!-- whistleblower_other -->
                        @if ($whistleblower == 'OTHER')
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="whistleblower_other" value="{{ __('Which best describes you?') }}" required/>
                            <div class="flex">
                                <x-select class="mt-1 block w-full" id="whistleblower_other" wire:model="whistleblower_other">
                                    <x-slot name="option">
                                        <option value="">{{ __('Pleace select one') }}</option>
                                        <option value="LEGAL_DISPUTE">{{ __('I am inolved in a legal dispute with the Campaign Organizer') }}</option> <!--selected -->
                                        <option value="INFLAMMATORY_STATEMENTS">{{ __('This campaign includes libelous statements') }}</option>
                                        <option value="INCORRECT_INFORMATION">{{ __('Campaign includes factually incorrect information') }}</option>
                                        <option value="INCORRECT_USE_OF_FUNDS">{{ __('Campaign Organizer has not used funds for the stated purpose') }}</option>
                                        <option value="SUPPLIED_THE_CAMPAIGN">{{ __('They are impersonating someone or have copied another campaign') }}</option>
                                    </x-slot>
                                </x-select>
                            </div>
                            <x-input-error for="whistleblower_other" class="mt-2" />
                        </div>
                        @endif
                         <!-- whistleblower_describe -->
                         <div class="col-span-6 sm:col-span-4">
                            @if ($whistleblower == 'BENEFICIARY')
                                <x-label for="whistleblower_describe" value="{{ __('How much money is being withheld and why?') }}" required/>
                                <x-textarea id="whistleblower_describe" type="text" class="mt-1 block w-full" wire:model.defer="whistleblower_describe"  autocomplete="off"  />
                                <x-input-error for="whistleblower_describe" class="mt-2" />
                            @endif
                            @if ($whistleblower == 'COLLABORATOR')
                                <x-label for="whistleblower_describe" value="{{ __('Why are you concerned about your colaboration?') }}" required/>
                                <x-textarea id="whistleblower_describe" type="text" class="mt-1 block w-full" wire:model.defer="whistleblower_describe"  autocomplete="off"  />
                                <x-input-error for="whistleblower_describe" class="mt-2" />
                            @endif
                            @if ($whistleblower == 'OTHER')
                                @if($whistleblower_other == '')
                                <x-label for="whistleblower_describe" value="{{ __('Please describe your concerns') }}" required/>
                                @endif
                                @if($whistleblower_other == 'LEGAL_DISPUTE')
                                <x-label for="whistleblower_describe" value="{{ __('Please explain your concern(s) in detail') }}" required/>
                                @endif
                                @if($whistleblower_other == 'INFLAMMATORY_STATEMENTS')
                                <x-label for="whistleblower_describe" value="{{ __('Which statements are libelous and why?') }}" required/>
                                @endif
                                @if($whistleblower_other == 'INCORRECT_INFORMATION')
                                <x-label for="whistleblower_describe" value="{{ __('Which statements are incorrect and why?') }}" required/>
                                @endif
                                @if($whistleblower_other == 'INCORRECT_USE_OF_FUNDS')
                                <x-label for="whistleblower_describe" value="{{ __('How have the campaign’s collaborations been spent?') }}" required/>
                                @endif
                                @if($whistleblower_other == 'SUPPLIED_THE_CAMPAIGN')
                                <x-label for="whistleblower_describe" value="{{ __('What is the original campaign link/title?') }}" required/>
                                @endif
                                <x-textarea id="whistleblower_describe" type="text" class="mt-1 block w-full" wire:model.defer="whistleblower_describe"  autocomplete="off"  />
                                <x-input-error for="whistleblower_describe" class="mt-2" />
                            @endif
                        </div>
                    </x-slot>
                </x-input-section>
            </x-slot>
            <x-slot name="actions">
                <x-button wire:loading.attr="disabled">
                   <span class="px-2 font-bold sm:text-base"> {{ __('Send') }}</span>
                   <span class="material-icons-outlined ml-1">send</span>
                </x-button>
            </x-slot>
        </x-form-section-multiple>
        <!-- Send to review Modal -->
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>