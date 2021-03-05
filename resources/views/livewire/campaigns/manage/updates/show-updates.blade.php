<x-slot name="title">
    {{__('Updates')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div class="bg-red-50">
<x-section-content>
    <x-slot name="header">
        <livewire:campaigns.manage.show-header :campaign="$campaign"/>
    </x-slot>
    <x-slot  name="content">
        <x-section-title>
            <x-slot name="title">
                <x-button wire:click="addUpdates" wire:loading.attr="disabled">
                    {{ __('Add update') }}
                </x-button>
            </x-slot>
            <x-slot name="description">
            </x-slot>
        </x-section-title>
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
              <div> 
                <h2 class="mt-4 text-center text-xl font-light">
                    {{ __('No updates') }}
                </h2>
              </div>
            </div>
        </div>
        <!-- -->
        <x-dialog-modal wire:model="updatesDialog">
            <x-slot name="title">
              <div class="font-bold">
                {{ __('New update') }}
              </div>
            </x-slot>
                <x-slot name="content">
                    <!-- Title -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="off" />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>
                    <!-- Body -->
                    <div class="mt-2 col-span-6 sm:col-span-4">
                        <x-jet-label for="body" value="{{ __('Contents') }}" />
                        <x-textarea id="body" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="body" autocomplete="off"/>
                        <x-jet-input-error for="body" class="mt-2" />
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

                        <x-jet-label for="photoOne" value="{{ __('Image') }} ({{ __('optional') }})" />
                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="!photoPreview">
                            @if( $this->update_photo_path)
                                <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                                    <i class="uil uil-trash text-base"></i>
                                </x-icon-button>
                                <img src="{{ URL::to('/') }}{{$this->update_photo_path}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
                            @else 
                                <img x-on:click.prevent="$refs.photo.click()" src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover cursor-pointer">
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
                                <img x-on:click.prevent="$refs.photo.click()" src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover cursor-pointer">
                            @endif
                        </div>
                        <!-- 
                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            { __('Select A Image') }}
                        </x-jet-secondary-button>
                        -->
                        <x-jet-input-error for="photoOne" class="mt-2" />
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('updatesDialog')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-secondary-button>
                    <x-button class="ml-2" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                        {{ __('Add') }}
                    </x-button>
                </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-section-content>
</div>
<livewire:footer/>