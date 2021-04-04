
<x-slot name="title">
    @if ($this->campaign_id > 0)
    {{__('Details')}} : YoSolidario
    @else
        {{__('Create campaigns')}} : YoSolidario
    @endif
</x-slot>
<x-slot  name="seo">
    
</x-slot>
<x-slot  name="menu">
    @if ($this->campaign_id > 0)
        <livewire:menu.navigation-campaign-create :campaign="$campaign"/>
    @else
        <livewire:menu.navigation-campaign-create/>
    @endif
    
</x-slot>
<div class="pt-20 bg-gray-50">
    <x-banner on="saved" style="{{$this->bannerStyle}}">
        {{ __($this->message) }}
    </x-banner>
    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-0 sm:py-10">
        <div class="border border-gray-100 my-5 py-10 px-4 sm:px-20 rounded shadow bg-white">
            <div class="text-center font-bold text-2xl">
                {{__('Let’s start with the basics')}}
            </div>
            <form wire:submit.prevent="StoreOrUpdate">
            <!-- Agency -->
            <div class="mt-6">
                <x-label for="agency_id" class="font-semibold" value="{{ __('Tell us where you mainly reside.') }}" required />
                <div class="flex">
                    <x-select class="mt-1 block w-full" id="agency_id" name="agency_id" wire:model="agency_id" autofocus> <!-- wire:change="agency" -->
                        <x-slot name="option">
                                <option value="">{{ __('Select country') }}</option>
                            @foreach ($collection_agencies as $item)
                                <option value="{{$item->id}}">{{ __($item->country->name) }}</option>
                            @endforeach
                        </x-slot>
                    </x-select>
                </div>
                <x-input-error for="agency_id" class="mt-2" />
            </div> 
            <!-- amount -->
            <div class="mt-6">
                <x-label for="amount_target" class="font-semibold" value="{{ __('Amount to raise') }}" required/>
                <div class="flex">

                    <x-input id="amount_target" type="text" class="mt-1 block w-full font-bold text-xl" wire:model.defer="amount_target"  autocomplete="off"  minlength="3" Number maxlength="8" onKeyPress="return validar(event)"/>
                    <x-input id="amount_target" disabled type="text" class="mt-1 ml-1 block w-16 font-bold text-xl text-gray-900" placeholder="{{$this->currency_symbol}}" autocomplete="off"/>
                    <!-- 
                    <x-select class="mt-1 ml-2 block w-36" id="period" wire:model.defer="period">
                        <x-slot name="option">
                            <option value="">{ __('Period') }}</option>
                            <option value="10">{ __('10') }} { __('days') }} </option>
                            <option value="15">{ __('15') }} { __('days') }} </option>
                            <option value="30">{ __('30') }} { __('days') }} </option>
                            <option value="45">{ __('45') }} { __('days') }} </option>
                            <option value="60">{ __('60') }} { __('days') }} </option>
                            <option value="90">{ __('90') }} { __('days') }} </option>
                        </x-slot>
                    </x-select>
                    -->
                </div>
                <x-input-error for="amount_target" class="mt-2" />
                <x-input-error for="period" class="mt-2" />
            </div>
            <!-- title -->
            <div class="mt-6">
                <x-label for="title" class="font-semibold" value="{{ __('Title') }}" required/>
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title"  autocomplete="off" minlength="5" maxlength="60" wire:keyup="generateSlug" /> <!-- wire:keyup="generateSlug"  -->
                <x-input-error for="title" class="mt-2" />
            </div>
            <!-- extract -->
            <div class="mt-6">
                <x-label for="extract" class="font-semibold" value="{{ __('Short description') }}" required/>
                <x-textarea id="extract" class="mt-1 block w-full" rows="3" wire:model.defer="extract" autocomplete="off" minlength="5" maxlength="170"/>
                <x-input-error for="extract" class="mt-2" />
            </div>
            <!-- category campaign-->
            <div class="mt-6">
                <x-label for="category_campaign_id" class="font-semibold" value="{{ __('Category campaign') }}" required/>
                <div class="flex">
                    <x-select class="mt-1 block w-full" id="category_campaign_id" name="category_campaign_id" wire:model.defer="category_campaign_id">
                        <x-slot name="option">
                                <option value="">{{ __('Choose a category') }}</option>
                            
                            <optgroup label="{{__('Project')}}">
                                @foreach ($collection_category_campaign as $item)
                                    @if($item->type == 'PROJECT')
                                    <option value="{{$item->id}}">{{ __($item->name) }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            <optgroup label="{{__('Social impact')}}">
                                @foreach ($collection_category_campaign as $item)
                                    @if($item->type == 'SOCIAL_IMPACT')
                                    <option value="{{$item->id}}">{{ __($item->name) }}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        </x-slot>
                    </x-select>
                </div>
                <x-input-error for="category_campaign_id" class="mt-2" />
            </div>
            <!-- type campaña -->
            <div class="mt-6">
                <x-label for="type_campaign" class="font-semibold" value="{{ __('Who do you raise the money for?') }}" required/>
                <div class="flex">
                    <x-select class="mt-1 block w-full" id="type_campaign" wire:model="type_campaign">
                        <x-slot name="option">
                            <option value="">{{ __('Who do you raise the money for?') }}</option>
                            <option value="PERSONAL">{{ __('Myself or someone else') }}</option> <!--selected -->
                            <option value="ORGANIZATION">{{ __('Foundation, ONG, Social Organizacion or Company') }}</option>
                        </x-slot>
                    </x-select>
                </div>
                <x-input-error for="type_campaign" class="mt-2" />
            </div>
            <!-- Organization -->
            @if($this->type_campaign == 'ORGANIZATION')
              @if ($collection_organization)
              <div class="mt-6">
                  <x-label for="organization_id" class="font-semibold" value="{{ __('Foundation, ONG, Social Organizacion or Company') }}" required/>
                  <div class="flex">
                      <x-select class="mt-1 block w-full" id="organization_id" name="organization_id" wire:model.defer="organization_id">
                          <x-slot name="option">
                                  <option value="">{{ __('Choose Foundation, ONG, Social Organization or Company') }}</option>
                              @foreach ($collection_organization as $item)
                                  <option value="{{ ($item->id) }}">{{ __($item->name) }}</option>
                              @endforeach
                          </x-slot>
                      </x-select>
                  </div>
                  <x-input-error for="organization_id" class="mt-2" />
                </div>
                @endif
            @endif
            <!-- locality -->
            <div class="mt-6">
                <x-label for="locality" class="font-semibold" value="{{ __('Campaign location: locality or city') }}" required/>
                <div class="flex space-x-1">
                    @if ($collection_country_states)
                        <div class="w-56">
                            <x-select class="mt-1 block w-full" id="country_state_id" name="country_state_id" wire:model.defer="country_state_id">
                                <x-slot name="option">
                                    <!--
                                        <option value="">{__($states_denomination)}}</option>
                                        <option value=""></option>
                                    -->
                                    @foreach ($collection_country_states as $item)
                                        <option value="{{$item->id}}">{{ __($item->name) }}</option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                        </div>
                    @endif
                    <div class="w-full">
                        <x-input id="locality" type="text" class="mt-1 block w-full" wire:model.defer="locality" autocomplete="off" minlength="3" maxlength="100"/>
                    </div>
                </div>
                <x-input-error for="country_state_id" class="mt-2" />
                <x-input-error for="locality" class="mt-2" />
            </div>
            <!-- Telephone -->
            <div class="mt-6">
                <x-label for="phone" class="font-semibold" value="{{ __('Telephone') }}" required/>
                <div class="flex space-x-1">
                    <div class="w-16">
                        <x-input disabled id="phone_prefix" type="text" wire:model.defer="phone_prefix" class="block w-16" placeholder="{{$this->phone_prefix}}" autocomplete="off"/>
                    </div>
                    <div class="w-full">
                        <x-input id="phone" type="text" class="block w-full" wire:model.defer="phone" autocomplete="off"  minlength="7" maxlength="15" />
                    </div>
                </div>
                <x-input-error for="phone" class="mt-2" />
            </div>
            <!-- slug -->
            <div class="mt-6">
                <x-label for="slug" class="font-semibold" value="{{ __('Slug') }}" required/><span class="text-gray-500 w-full">https://yosolidario.com/</span>
                <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" autocomplete="off" minlength="3" maxlength="200"/>
                <x-input-error for="slug" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-6">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" accept="image/*"
                    wire:model.defer="photoOne"
                    x-ref="photo"
                    x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                    " />

                <x-label for="photoOne" class="font-semibold" value="{{ __('Image') }}" required/>
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $this->photo_url)
                        <x-icon-button wire:click="deleteOne" class=" flex justify-center absolute m-1 opacity-70">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$this->photo_url}}" alt="" class="rounded-sm h-48 sm:h-64 w-full object-cover">
                    @else 
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB
                            </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    @if($this->photoOne)
                        <span class="block rounded-sm w-full h-48 sm:h-64"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            <x-icon-button wire:click="deleteOne" class=" flex justify-center m-1 opacity-70">
                                <span class="material-icons-outlined">delete</span>
                            </x-icon-button>
                        </span>
                    @else 
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-48 sm:h-64">
                            <div class="space-y-1 text-center">
                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                            <p class="text-xs text-gray-500">
                                PNG, JPG up to 2MB
                            </p>
                            </div>
                        </div>
                    @endif
                </div>
                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A Image') }}
                    </x-secondary-button> 
                <x-input-error for="photoOne" class="mt-2" />
            </div>
            <!-- Video link -->
            <div class="mt-6">
                <x-label for="video_url" class="font-semibold" value="{{ __('Video link YouTube ') }}" required/>
                <x-input id="video_url" type="text" class="mt-1 block w-full" wire:model.defer="video_url"  autocomplete="off" minlength="3" maxlength="50"/>
                <x-input-error for="video_url" class="mt-2" />
            </div>
            <!-- button --> 
            <div class="mt-6 flex justify-center">
                <x-action-message class="mr-3" on="message">
                    {{ __($this->message) }}
                </x-action-message>
                <x-button wire:loading.attr="disabled">
                   <div class="my-2 mx-3">
                        <span class="px-2 font-bold sm:text-base"> {{ __('Next') }}</span>
                        <span class="material-icons-outlined ml-1 text-sm">arrow_forward_ios</span>
                   </div>
                </x-button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
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
</script>
<livewire:footer.footer-collaborate/>

