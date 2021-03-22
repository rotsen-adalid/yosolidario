<x-slot name="title">
    @if ($campaign_update_id)
        {{ __('Update data') }} : YoSolidario
    @else
        {{ __('New update') }} : YoSolidario
    @endif
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div class="bg-purple-50">
<x-section-content>
    <x-slot name="header">
        <livewire:campaigns.manage.show-header :campaign="$campaign"/>
    </x-slot>
    <x-slot  name="content">
        <x-form-section submit="StoreOrUpdate" class="mt-10 sm:mt-0">
            <x-slot name="title">
                @if ($campaign_update_id)
                    {{ __('Update data') }}
                @else
                    {{ __('New update') }}
                @endif
            </x-slot>
        
            <x-slot name="description">
                <div class="sm:pt-3">
                    @if ($campaign_update_id)
                        {{__('Update the data of your communication to your collaborators.')}}
                    @else
                        {{ __('Communicate to your collaborators about your campaign') }}
                    @endif
                </div>
            </x-slot>
            <x-slot name="form">
                <!-- Title -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="title" value="{{ __('Title') }}" required/>
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="off" />
                    <x-input-error for="title" class="mt-2" />
                </div>
                <!-- Body -->
                <div class="mt-2 col-span-6 sm:col-span-4">
                    <x-label for="body" value="{{ __('Contents') }}" required/>
                    <x-textarea id="body" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="body" autocomplete="off"/>
                    <x-input-error for="body" class="mt-2" />
                </div>
                <!-- Photo -->
                <div x-data="{photoName: null, photoPreview: null}" class="mt-2 col-span-6 sm:col-span-4">
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

                    <x-label for="photoOne" value="{{ __('Image') }}" />
                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!photoPreview">
                        @if( $update_photo_path)
                            <x-icon-button wire:click="deleteOne" class="py-1 m-1 m-1 opacity-70">
                                <span class="material-icons-outlined">delete</span>
                            </x-icon-button>
                            <img src="{{ URL::to('/') }}{{$update_photo_path}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
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
                        @if($photoOne)
                            <span class="block rounded-sm w-full h-60 sm:h-64"
                                x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                <x-icon-button wire:click="deleteOne" class="py-1 m-1 opacity-70">
                                    <span class="material-icons-outlined">delete</span>
                                </x-icon-button>
                            </span>
                        @else 
                            <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-60 sm:h-64">
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
                <!-- Video link  -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="video_url" value="{{ __('Video link YouTube ') }}"/>
                    <x-input id="video_url" type="text" class="mt-1 block w-full" wire:model.defer="video_url"  autocomplete="off" minlength="3" maxlength="50"/>
                    <x-input-error for="video_url" class="mt-2" />
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
<livewire:footer/>