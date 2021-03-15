<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Biography -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="biography" value="{{ __('Biography') }}" />
            <x-textarea id="biography" class="mt-1 block w-full" wire:model.defer="state.biography" />
            <x-input-error for="biography" class="mt-2" />
        </div>

         <!-- Facebook -->
         <div class="col-span-6 sm:col-span-4">
            <x-label for="facebook" value="{{ __('Facebook') }}" />
            <x-input id="facebook" type="text" class="mt-1 block w-full" wire:model.defer="state.facebook" />
            <x-input-error for="facebook" class="mt-2" />
        </div>

        <!-- Twitter -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="twitter" value="{{ __('Twitter') }}" />
            <x-input id="twitter" type="text" class="mt-1 block w-full" wire:model.defer="state.twitter" />
            <x-input-error for="twitter" class="mt-2" />
        </div>

        <!-- Instagram -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="instagram" value="{{ __('Instagram') }}" />
            <x-input id="instagram" type="text" class="mt-1 block w-full" wire:model.defer="state.instagram" />
            <x-input-error for="instagram" class="mt-2" />
        </div>

        <!-- Status Acount
        <div class="col-span-6 sm:col-span-4">
            <label for="status" class="flex items-center">
                <x-checkbox id="status" name="status" wire:model.defer="state.status" value="state.status"/>
                <span class="ml-2 text-sm text-gray-600">{{ __('Private account') }}</span>
            </label>
        </div>
        -->
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
