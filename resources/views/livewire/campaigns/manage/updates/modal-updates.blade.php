<!-- -->
<x-dialog-modal wire:model="updatesDialog">
    <x-slot name="title">
      <div class="font-bold">
        @if ($campaign_update_id)
            {{ __('Update data') }}
        @else
            {{ __('New update') }}
        @endif
       
      </div>
    </x-slot>
        <x-slot name="content">
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
                        <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70">
                            <i class="uil uil-trash text-base"></i>
                        </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$update_photo_path}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
                    @else 
                        <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
                    @endif
                </div>

                <!-- Image Preview -->
                <div class="mt-2" x-show="photoPreview">
                    @if($photoOne)
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

                <x-secondary-button class="mt-2 mr-2 uppercase" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A Image') }}
                </x-secondary-button>

                <x-input-error for="photoOne" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button class="uppercase" wire:click="$toggle('updatesDialog')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>
            @if ($campaign_update_id)
                <x-button class="ml-2 uppercase" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            @else
                <x-button class="ml-2 uppercase" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                    {{ __('Add') }}
                </x-button>
            @endif

        </x-slot>
</x-dialog-modal>
<!-- delete -->
<x-dialog-modal wire:model="deleterDialog">
    <x-slot name="title">
      <div class="font-bold">
            {{ __('Do you want to delete?') }}
      </div>
    </x-slot>
    <x-slot name="content">
        <x-slot name="footer">
            <x-secondary-button class="uppercase" wire:click="$toggle('deleterDialog')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-button class="ml-2 uppercase" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-slot>
</x-dialog-modal>