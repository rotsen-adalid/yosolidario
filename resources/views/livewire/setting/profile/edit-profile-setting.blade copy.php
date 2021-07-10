<x-slot name="title">
    {{__('Edit profile')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>

<x-slot  name="menu">
    <livewire:menu.navigation-panel/>
</x-slot>
<div class="mt-20 bg-white">
    <x-banner on="saved" style="{{$this->bannerStyle}}">
        {{ __($this->message) }}
    </x-banner>
    <header class="bg-white shadow pt-2 mb-5 sm:mb-5"> 
        <div class="justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="flex items-center font-bold text-2xl text-gray-800 leading-tight pt-6">
                {{ __('Setting') }}
            </h2>
            <livewire:setting.menu.menu-setting/>
        </div>
    </header>
    <div class="max-w-2xl mx-auto px-0 sm:px-2 pt-0 sm:pt-4 sm:pb-8">
        <div class="border border-gray-100 my-5 py-5 px-4 sm:px-10 rounded shadow bg-white">
    
            <div class="text-center font-bold text-2xl">
                {{ __('Present yourself') }}
            </div>

            <!-- Profile Photo -->
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null, buttonUpload: true, buttonDelete: false}" class="mt-4">
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
                        <x-label for="photo" value="{{ __('Photo') }}" />
                        <x-action-message class="mr-3" on="messagePhoto">
                            {{ __($message) }}
                        </x-action-message>
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

                    <x-secondary-button x-show="! photoPreview" 
                        class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('New Photo') }}
                    </x-secondary-button>

                    <x-secondary-button x-show="photoPreview"  @click="photoPreview = null"
                        type="button" class="mt-2">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>

                    <x-input-error for="photoOne" class="mt-2" />
                </div>
            @endif
            <form wire:submit.prevent="StoreOrUpdate">
            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" class="font-semibold" value="{{ __('Name') }}" required/>
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" autofocus autocomplete="off" />
                <x-input-error for="name" class="mt-2" />
            </div>

             <!-- slug -->
             <div class="mt-4">
                <x-label for="slug" class="font-semibold" value="{{ __('Slug') }}" required/> <span class="text-gray-500 w-full">https://yosolidario.com/user/</span>
                <x-input id="slug" type="text" class="mt-1 block w-full" wire:model.defer="slug" autocomplete="off"/>
                <x-input-error for="slug" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" class="font-semibold" value="{{ __('Email') }}" required/>
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"  autocomplete="off" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <!-- Biography -->
            <div class="mt-4">
                <x-label for="biography" class="font-semibold" value="{{ __('Biography') }}" />
                <x-textarea id="biography" class="mt-1 block w-full" rows="2" wire:model.defer="biography" autocomplete="off"/>
                <x-input-error for="biography" class="mt-2" />
            </div>

            <!-- Facebook -->
            <div class="mt-4">
                <x-label for="facebook" class="font-bold" value="{{ __('Facebook') }} " /> 
                <x-input id="facebook" type="text" class="mt-1 block w-full" wire:model.defer="facebook" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-input-error for="facebook" class="mt-2" />
            </div>

            <!-- Twitter -->
            <div class="mt-4">
                <x-label for="twitter" class="font-semibold" value="{{ __('Twitter') }} " />
                <x-input id="twitter" type="text" class="mt-1 block w-full" wire:model.defer="twitter" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-input-error for="twitter" class="mt-2" />
            </div>

            <!-- Instagram -->
            <div class="mt-4">
                <x-label for="instagram" class="font-semibold" value="{{ __('Instagram') }} " />
                <x-input id="instagram" type="text" class="mt-1 block w-full" wire:model.defer="instagram" placeholder="{{__('Profile url')}}" autocomplete="off"/>
                <x-input-error for="instagram" class="mt-2" />
            </div>
            
            <!-- WhatsApp --
            <div class="mt-4">
                <x-label for="whatsApp" value="{ __('WhatsApp') }} " />
                <div class="flex space-x-1">
                    <div class="w-36">
                        <x-select class="block w-36" id="country_id" name="country_id" wire:model.defer="country_id" wire:change="country">
                            <x-slot name="option">
                                    <option value="">{ __('Country') }}</option>
                                foreach ($collection_countries as $item)
                                    <option value="{$item->id}}">{ __($item->name) }}</option>
                                endforeach
                            </x-slot>
                        </x-select>
                        
                    </div>
                    <div class="w-full">
                        <x-input id="whatsapp" type="text" class="block w-full" wire:model.defer="whatsapp"  autocomplete="off" />
                    </div>
                </div>
                <x-input-error for="country_id" class="mt-2" />
                <x-input-error for="whatsapp" class="mt-2" />
            </div>

             Telegram -->
             <div class="mt-4">
                <x-label for="telegram" class="font-semibold" value="{{ __('Telegram') }} " />
                <x-input id="telegram" type="text" class="mt-1 block w-full" wire:model.defer="telegram" placeholder="{{__('Number or Profile url')}}" autocomplete="off"/>
                <x-input-error for="telegram" class="mt-2" />
            </div>

              <!-- WebSite -->
              <div class="mt-4">
                <x-label for="website" class="font-semibold" value="{{ __('Website') }} " />
                <x-input id="website" type="text" class="mt-1 block w-full" wire:model.defer="website" placeholder="{{__('Url')}}" autocomplete="off"/>
                <x-input-error for="website" class="mt-2" />
            </div>

            <!-- status -->
            <div class="mt-4">
                <x-label for="status_profile" class="font-semibold" value="{{ __('Profile status') }}" required/>
                <x-select class="mt-1 block w-full" id="status_profile" wire:model.defer="status_profile">
                    <x-slot name="option">
                        <option value="">{{ __('Choose status') }}</option>
                        <option value="PUBLIC">{{ __('Public') }}</option> <!--selected -->
                        <option value="PRIVATE">{{ __('Private') }}</option>
                    </x-slot>
                </x-select>
                <x-input-error for="status_profile" class="mt-2" />
            </div>

            <!-- action -->
            <div class="flex justify-center items-center mt-4">
                <x-button class="text-sm font-bold" wire:loading.attr="disabled">
                    <span class="py-2 px-20 text-base">{{ __('Save') }}</span>
                </x-button>
                <x-action-message class="ml-3" on="message">
                    {{ __($message) }}
                </x-action-message>
            </div>
            </form>
        </div>
    </div>
</div>
<livewire:footer.footer-app/>