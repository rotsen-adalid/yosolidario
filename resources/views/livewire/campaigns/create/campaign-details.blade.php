
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
    @livewire('navigation')
</x-slot>
<div class="bg-gray-50">
<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-4">
                    @if ($this->campaign_id > 0)
                        {{ __('Details') }} 
                        <span class="ml-1 mr-1">/</span>
                        <a class="underline hover:text-gray-900" href="{{ route('campaign/update/questions',  $this->campaign) }}">
                            {{ __('Questions') }}
                        </a>
                        <span class="ml-1 mr-1">/</span>
                        <a class="underline hover:text-gray-900" href="{{ route('campaign/update/rewards',   $this->campaign) }}">
                            {{ __('Rewards') }}
                        </a>
                    @else
                        {{ __('Create campaigns') }}
                    @endif
                </h2>
                
                @if ($this->status_register == 'COMPLETE')
                <div class="flex items-center leading-tight space-x-2">
                    <x-button wire:click="reviewConfirm" wire:loading.attr="disabled">
                        <span class="uppercase">{{ __('Publish campaign') }}</span>
                    </x-button>
                    <x-secondary-button wire:click="preview({{$this->campaign_id}})" wire:loading.attr="disabled">
                        <span class="uppercase">{{ __('Preview') }}</span>
                    </x-secondary-button>
                </div>
                @endif
    
            </div>
        </header>
    </x-slot>
    <x-slot  name="content">
        <x-form-section-multiple submit="StoreOrUpdate">
            <x-slot name="form">
                <x-input-section>
                    <x-slot name="title">
                        {{ __('State your goal') }}
                    </x-slot>
                
                    <x-slot name="description">
                        <div class="sm:pt-3">
                            {{ __('If you\'re not sure what amount to start with, it might help to know that most campaigns set a goal of $ 500.') }}
                        </div>
                    </x-slot>
                    <x-slot name="form">
                        <!-- Agency -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="agency_id" value="{{ __('Tell us where you mainly reside.') }}" />
                            <div class="flex">
                                <x-select class="mt-1 block w-full" id="agency_id" name="agency_id" wire:model.defer="agency_id" wire:change="agency" autofocus>
                                    <x-slot name="option">
                                            <option value="">{{ __('Select your country') }}</option>
                                        @foreach ($collection_agencies as $item)
                                            <option value="{{$item->id}}">{{ __($item->country->name) }}</option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                            <x-jet-input-error for="agency_id" class="mt-2" />
                        </div> 
                        <!-- amount -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="amount_target" value="{{ __('Amount to raise') }}" />
                            <div class="flex">
                                <x-jet-input id="amount_target" type="number" class="mt-1 block w-full font-bold text-xl" wire:model.defer="amount_target"  autocomplete="off"  minlength="3" Number maxlength="8"/>
                                <x-jet-input id="amount_target" disabled type="text" class="mt-1 ml-1 block w-16 font-bold text-xl" placeholder="{{$this->currency_symbol}}" autocomplete="off"/>
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
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="title" value="{{ __('Title') }}" />
                            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title"  autocomplete="off" minlength="10" maxlength="60" wire:keyup="generateSlug" /> <!-- wire:keyup="generateSlug"  -->
                            <x-jet-input-error for="title" class="mt-2" />
                        </div>
                        <!-- extract -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="extract" value="{{ __('Short description') }}" />
                            <x-textarea id="extract" class="mt-1 block w-full" rows="3" wire:model.defer="extract" autocomplete="off" minlength="60" maxlength="170"/>
                            <x-jet-input-error for="extract" class="mt-2" />
                        </div>
                        <!-- category campaign-->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="category_campaign_id" value="{{ __('Category campaign') }}" />
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
                            <x-jet-input-error for="category_campaign_id" class="mt-2" />
                        </div>
                        <!-- type campaña -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="type_campaign" value="{{ __('Who do you raise the money for?') }}" />
                            <div class="flex">
                                <x-select class="mt-1 block w-full" id="type_campaign" wire:model="type_campaign">
                                    <x-slot name="option">
                                        <option value="">{{ __('Who do you raise the money for?') }}</option>
                                        <option value="PERSONAL">{{ __('Myself or someone else') }}</option> <!--selected -->
                                        <option value="ORGANIZATION">{{ __('Foundation, ONG or Company') }}</option>
                                    </x-slot>
                                </x-select>
                            </div>
                            <x-input-error for="type_campaign" class="mt-2" />
                        </div>
                        <!-- Organization -->
                        @if($this->type_campaign == 'ORGANIZATION')
                          @if ($collection_organization)
                          <div class="col-span-6 sm:col-span-4">
                              <x-label for="organization_id" value="{{ __('Foundation, ONG, Company or Social Organization') }}" />
                              <div class="flex">
                                  <x-select class="mt-1 block w-full" id="organization_id" name="organization_id" wire:model.defer="organization_id">
                                      <x-slot name="option">
                                              <option value="">{{ __('Choose Foundation, ONG or Company') }}</option>
                                          @foreach ($collection_organization as $item)
                                              <option value="{{ ($item->id) }}">{{ __($item->name) }}</option>
                                          @endforeach
                                      </x-slot>
                                  </x-select>
                              </div>
                              <x-jet-input-error for="organization_id" class="mt-2" />
                            </div>
                            @endif
                        @endif
                        <!-- locality -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="locality" value="{{ __('Campaign location: locality or city') }}" />
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
                                    <x-jet-input-error for="country_id" class="mt-2" />
                                </div>
                                <div class="w-full">
                                    <x-jet-input id="locality" type="text" class="mt-1 block w-full" wire:model.defer="locality" autocomplete="off" minlength="3" maxlength="100"/>
                                    <x-jet-input-error for="locality" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <!-- Telephone -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="telephone" value="{{ __('Telephone') }}" />
                            <div class="flex space-x-1">
                                <div class="w-16">
                                    <x-jet-input disabled type="text" class="block w-16" placeholder="{{$this->telephone_prefix}}" autocomplete="off"/>
                                </div>
                                <div class="w-full">
                                    <x-jet-input id="telephone" type="text" class="block w-full" wire:model.defer="telephone" autocomplete="off"  minlength="7" maxlength="15" />
                                </div>
                            </div>
                            <x-jet-input-error for="telephone" class="mt-2" />
                        </div>
                        <!-- slug -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-label for="slug" value="{{ __('Slug') }}" /><span class="text-gray-500 w-full">https://yosolidario.com/</span>
                            <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" autocomplete="off" minlength="3" maxlength="200"/>
                            <x-input-error for="slug" class="mt-2" />
                        </div>

                    </x-slot>
                </x-input-section>
                <x-jet-section-border />
                <x-input-section class="mt-10 sm:mt-0">
                    <x-slot name="title">
                        {{ __('Image and video') }}
                    </x-slot>
                
                    <x-slot name="description">
                        <div class="sm:pt-3">
                            {{ __('Upload an image') }}
                        </div>
                        <div class="sm:pt-1">
                            {{ __('JPEG o PNG 800 x 400 pixels Limit 2 MB') }}
                        </div>
                        <div class="sm:pt-3">
                            {{ __('Paste video link') }}
                            {{ __('YouTube') }}
                        </div>
                    </x-slot>
                    <x-slot name="form">
                        <!-- Photo -->
                        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
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
            
                            <x-jet-label for="photoOne" value="{{ __('Image') }}" />
                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="!photoPreview">
                                @if( $this->photo_url)
                                    <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                                        <i class="uil uil-trash text-base"></i>
                                    </x-icon-button>
                                    <img src="{{ URL::to('/') }}{{$this->photo_url}}" alt="" class="rounded-sm h-60 w-full object-cover">
                                @else 
                                    <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 w-full object-cover ">
                                @endif
                            </div>
            
                            <!-- Image Preview -->
                            <div class="mt-2" x-show="photoPreview">
                                @if($this->photoOne)
                                    <span class="block rounded-sm w-full h-60 sm:h-64"
                                        x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                        <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                            <i class="uil uil-trash text-base"></i>
                                        </x-icon-button>
                                    </span>
                                @else 
                                    <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
                                @endif
                            </div>
                                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                    {{ __('Select A Image') }}
                                </x-jet-secondary-button> 
                            <x-jet-input-error for="photoOne" class="mt-2" />
                        </div>

                        <!-- Video link -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="video_url" value="{{ __('Video link YouTube ') }}" />
                            <x-jet-input id="video_url" type="text" class="mt-1 block w-full" wire:model.defer="video_url"  autocomplete="off" minlength="3" maxlength="50"/>
                            <x-jet-input-error for="video_url" class="mt-2" />
                        </div>
                    </x-slot>
                </x-input-section>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="message">
                    {{ __($this->message) }}
                </x-jet-action-message>
                <x-button wire:loading.attr="disabled">
                   <span class="px-2 uppercase font-bold text-base"> {{ __('next') }}</span>
                   <i class="uil uil-angle-right-b text-base"></i>
                </x-button>
            </x-slot>
        </x-form-section-multiple>
        <!-- Send to review Modal -->
        @if($this->campaign)
            @include('livewire.campaigns.create.send-to-review')
        @endif
    </x-slot>
</x-section-content>
</div>
<livewire:footer/>