<x-slot name="title">
    @if ($campaign_reward_id)
        {{__('Update reward')}} : YoSolidario
    @else
        {{ __('Register new reward') }} : YoSolidario
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
                    <i class="uil uil-angle-left-b"></i>
                    <a class="underline hover:text-gray-900" href="{{ route('campaign/rewards/show', $this->campaign) }}">
                        <span>{{ __('Show rewards') }}</span>
                    </a>
                </h2>
            </div>
        </header>
    </x-slot>
    <x-slot  name="content" >
        <x-form-section submit="StoreOrUpdate" class="mt-10 sm:mt-0">
            <x-slot name="title">
                @if ($campaign_reward_id)
                    {{__('Update reward')}}
                @else
                    {{ __('Register new reward') }}
                @endif
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    @if ($campaign_reward_id)
                        {{__('Update data, the reward can be physical, symbolic or digital.')}}
                    @else
                        {{ __('Enter a new reward, it can be physical, symbolic or digital.') }}
                    @endif
                </div>
                <div class="hidden sm:block sm:mt-2">
                    {{ __('Picture and delivery date is optional') }}
                </div>
            </x-slot>
            <x-slot name="form">

                        <!-- amount -->
            <div class="col-span-6 sm:col-span-4">
                <div class="sm:flex sm:space-x-2">
                    <div>
                        <x-label for="amount" class="text-base" value="{{ __('Amount') }}" required/>
                        <div class="flex">
                            <x-input id="amount" type="number" class="mt-1 block w-50" wire:model.defer="amount"  autocomplete="off"  minlength="1" maxlength="3"/>
                            <x-input id="amount" disabled type="text" class="mt-1 ml-1 block w-16" placeholder="{{$currency_symbol}}" autocomplete="off"/>
                        </div>
                        <x-input-error for="amount" class="mt-2" />
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <!-- delivery_date -->
                        <x-label for="delivery_date" class="text-base" value="{{ __('Estimated delivery date') }}" />
                        <x-input id="delivery_date" type="date" class="mt-1 block w-50" wire:model.defer="delivery_date" autocomplete="off" />
                        <x-input-error for="delivery_date" class="mt-2" />
                    </div>
                </div>
            </div>
            <!-- description -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <x-label for="description" class="text-base" value="{{ __('Description') }}" required/>
                <x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" autocomplete="off"/>
                <x-input-error for="description" class="mt-2" />
            </div>
            <!-- limiter -->
            <div class="col-span-6 sm:col-span-4 mt-4">
                <div class="flex space-x-1">
                    <div class="w-48">
                        <x-label for="limiter" class="text-base" value="{{ __('Limit quantity?') }}" required/>
                        <x-select class="block w-full" id="limiter" wire:model="limiter">
                            <x-slot name="option">
                                <option value="" >{{ __('Chosse') }} </option>
                                <option value="NO" >{{ __('No') }} </option> <!--selected -->
                                <option value="YES">{{ __('Yes') }} </option>
                            </x-slot>
                        </x-select>
                        <x-input-error for="limiter" class="mt-2" />
                    </div>
                    <div class="w-36">
                        @if ($limiter == 'YES')
                            <x-label for="limiter" class="ml-2 text-base" value="{{ __('Quantity') }}" />
                            <x-input id="quantity" type="number" class="ml-2 block w-full" wire:model.defer="quantity" placeholder="{{ __('Quantity') }}" autocomplete="off" />
                            <x-input-error for="quantity" class="mt-2" />
                        @endif
                    </div>
                </div>
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4 mt-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" accept="image/*"
                    wire:model="photoOne"
                    x-ref="photo"
                    x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                    " />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $image_url)
                    <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                        <i class="uil uil-trash text-base"></i>
                    </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$image_url}}" alt="" class="rounded-smh-48 sm:h-56 w-auto object-cover">
                    @else 
                        <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-48 sm:h-56 w-auto object-cover">
                    @endif
                </div>
                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    @if($photoOne)
                        <span class="block rounded-sm h-48 sm:h-56 w-auto"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            <x-icon-button wire:click="deleteOne" class="m-1 opacity-70">
                                <i class="uil uil-trash text-base"></i>
                            </x-icon-button>
                        </span>
                    @else
                        <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-48 sm:h-56 w-auto object-cover">
                    @endif
                </div>

                <x-secondary-button class="mt-2 mr-2 w-auto uppercase" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A Image') }} ({{ __('optional') }})
                </x-secondary-button>

                <x-input-error for="photoOne" class="mt-2" />
            </div>
            </x-slot>
            <x-slot name="actions">
                <x-button class="text-sm" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-form-section>

    </x-slot>
</x-section-content>
