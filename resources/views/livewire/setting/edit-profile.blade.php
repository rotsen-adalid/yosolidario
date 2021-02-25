<x-slot name="title">
    {{__('Edit profile')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>

<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="justify-between items-start max-w-7xl mx-auto px-4 sm:px-2 lg:px-0">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-6">
                    {{ __('Setting') }}
                </h2>
                
                <x-menu-setting/>
            </div>
        </header>
    </x-slot>
    <x-slot  name="content">
        <x-form-section submit="StoreOrUpdatePhoto">
        <x-slot name="title">
            {{ __('Avatar') }}
        </x-slot>
    
        <x-slot name="description">
            <div class="sm:pt-3">
                {{ __('JPEG o PNG 160x160 píxeles Límite de 2 MB') }}
            </div>
        </x-slot>

        <x-slot name="form">

            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
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

                    <div class="flex space-x-2">
                        <x-jet-label for="photo" value="{{ __('Photo') }}" />
                        <x-jet-action-message class="mr-3" on="messagePhoto">
                            {{ __($message) }}
                        </x-jet-action-message>
                    </div>
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        @if($this->profile_photo_path)
                            <img src="{{ URL::to('/') }}{{$this->profile_photo_path}}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                        @else
                            <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                        @endif
                    </div>
                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview">
                        <span class="block rounded-full w-20 h-20"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('New Photo') }}
                    </x-jet-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto" @click="{photoPreview=null}">
                            {{ __('Remove Photo') }}
                        </x-jet-secondary-button>
                    @endif
                    <x-jet-input-error for="photoOne" class="mt-2" />
                </div>
            @endif
            
        </x-slot>

        <x-slot name="actions">
            <!--
            <x-jet-action-message class="mr-3" on="messagePhoto">
                { __($message) }}
            </x-jet-action-message>
            <x-button wire:loading.attr="disabled">
                { __('save') }}
            </x-button>
            -->
        </x-slot>

        </x-form-section>

        <x-jet-section-border />

        <x-form-section submit="StoreOrUpdate" class="mt-10 sm:mt-0">
            <x-slot name="title">
                {{ __('Present yourself') }}
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    {{ __('Update your profile information and email address for your account.') }}
                </div>
                <div class="hidden sm:block sm:mt-2">
                    {{ __('Your phone number will not be published on your profile') }}
                </div>
                <div class="hidden sm:block sm:mt-2">
                    {{ __('Private profile will only see people who have an account and public profile all people') }}
                </div>
            </x-slot>
            <x-slot name="form">

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autofocus autocomplete="off" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

             <!-- slug -->
             <div class="col-span-6 sm:col-span-4">
                <x-label for="slug" value="{{ __('Slug') }}" /> <span class="text-gray-500 w-full">https://yosolidario.com/user/</span>
                <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" autocomplete="off"/>
                <x-input-error for="slug" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"  autocomplete="off" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
        
            <!-- Biography -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="biography" value="{{ __('Biography') }} ({{ __('optional') }})" />
                <x-textarea id="biography" class="mt-1 block w-full" rows="5" wire:model.defer="biography" autocomplete="off"/>
                <x-jet-input-error for="biography" class="mt-2" />
            </div>

            <!-- Facebook -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="facebook" value="{{ __('Facebook') }} ({{ __('optional') }})" /> 
                <x-jet-input id="facebook" type="text" class="mt-1 block w-full" wire:model.defer="facebook" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-jet-input-error for="facebook" class="mt-2" />
            </div>

            <!-- Twitter -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="twitter" value="{{ __('Twitter') }} ({{ __('optional') }})" />
                <x-jet-input id="twitter" type="text" class="mt-1 block w-full" wire:model.defer="twitter" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-jet-input-error for="twitter" class="mt-2" />
            </div>

            <!-- Instagram -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="instagram" value="{{ __('Instagram') }} ({{ __('optional') }})" />
                <x-jet-input id="instagram" type="text" class="mt-1 block w-full" wire:model.defer="instagram" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-jet-input-error for="instagram" class="mt-2" />
            </div>

            <!-- WhatsApp -->
            <div class="col-span-6 sm:col-span-4">
                <div class="flex space-x-1">
                    <div class="w-36">
                        <x-label for="country_id" value="{{ __('Country') }} ({{ __('optional') }})" />
                        <x-select class="mt-1 block w-36" id="country_id" name="country_id" wire:model.defer="country_id">
                            <x-slot name="option">
                                    <option value="">{{ __('Country') }}</option>
                                @foreach ($countries_collection as $item)
                                    <option value="{{$item->id}}">{{ __($item->name) }}</option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error for="country_id" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="whatsApp" value="{{ __('WhatsApp') }} ({{ __('optional') }})" />
                        <x-jet-input id="whatsapp" type="text" class="mt-1 ml-2 block w-full" wire:model.defer="whatsapp"  autocomplete="off" />
                        <x-jet-input-error for="whatsapp" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Telegram -->
             <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="telegram" value="{{ __('Telegram') }} ({{ __('optional') }})" />
                <x-jet-input id="telegram" type="text" class="mt-1 block w-full" wire:model.defer="telegram" placeholder="{{__('Number or Profile url')}}" autocomplete="off"/>
                <x-jet-input-error for="telegram" class="mt-2" />
            </div>

              <!-- WebSite -->
              <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="website" value="{{ __('Website') }} ({{ __('optional') }})" />
                <x-jet-input id="website" type="text" class="mt-1 block w-full" wire:model.defer="website" placeholder="{{__('Url')}}" autocomplete="off"/>
                <x-jet-input-error for="website" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="status_profile" value="{{ __('Profile status') }}" />
                <x-select class="mt-1 block w-full" id="status_profile" wire:model.defer="status_profile">
                    <x-slot name="option">
                        <option value="">{{ __('Choose status') }}</option>
                        <option value="PUBLIC">{{ __('Public') }}</option> <!--selected -->
                        <option value="PRIVATE">{{ __('Private') }}</option>
                    </x-slot>
                </x-select>
                <x-input-error for="status_profile" class="mt-2" />
            </div>

        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="message">
                {{ __($message) }}
            </x-jet-action-message>
            <x-button wire:loading.attr="disabled">
                {{ __('save') }}
            </x-button>
        </x-slot>
        </x-form-section>
    </x-slot>
</x-section-content>
<livewire:footer/>
