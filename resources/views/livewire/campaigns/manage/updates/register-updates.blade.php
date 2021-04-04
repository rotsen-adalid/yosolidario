<div>
    @if ($button == 1)
        <div class="flex justify-center mt-10">
            <x-button class=" justify-center" wire:click="addUpdates" wire:loading.attr="disabled">
                <span class="text-base font-bold">{{ __('Post an update') }}</span>
            </x-button>
        </div>
    @elseif($button == 2)
        <x-secondary-button class="ml-2 mt-5 sm:mt-0 font-bold text-base" wire:click="addUpdates" wire:loading.attr="disabled">
            <span class="material-icons-outlined">add</span>
            <span>{{__('Post an update')}}</span>
        </x-secondary-button>
    @elseif($button == 3)
        <span   wire:click="editUpdates({{$campaign_update_id}})" wire:loading.attr="disabled"
            class="material-icons-outlined text-lg font-bold cursor-pointer shadow py-1 px-2 rounded-lg border border-gray-100">
            edit
        </span>
    @endif
    

    <x-dialog-modal wire:model="storeUpdateDialog">
        <x-slot name="title">
          <div class="font-bold text-2xl text-center">
            @if ($campaign_update_id)
                {{ __('Edit communication') }}
            @else
                {{ __('Post an update') }}
            @endif
          </div>
        </x-slot>
        <x-slot name="content">
            
           <!-- Title -->
            <div class="mt-6">
                <x-label for="title" class="font-bold" value="{{ __('Title') }}" required/>
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="off" />
                <x-input-error for="title" class="mt-2" />
            </div>
            <!-- Body -->
            <div class="mt-2 mt-6">
                <x-label for="body"  class="font-bold" value="{{ __('Contents') }}" required/>
                <x-textarea id="body" class="mt-1 block w-full h-24 sm:h-24" wire:model.defer="body" autocomplete="off"/>
                <x-input-error for="body" class="mt-2" />
            </div>
            <!-- Photo -->
            <div x-data="{photoName: null, photoPreview: null}" class="mt-2 mt-6">
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

                <x-label for="photoOne" class="font-bold"  value="{{ __('Image') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="!photoPreview">
                    @if( $update_photo_path)
                        <x-icon-button wire:click="deleteOne" class="absolute m-1 opacity-70 py-1">
                            <span class="material-icons-outlined">delete</span>
                        </x-icon-button>
                        <img src="{{ URL::to('/') }}{{$update_photo_path}}" alt="" class="rounded-sm h-36 sm:h-40 w-2/4 object-cover">
                    @else 
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-2/4 h-36 sm:h-40">
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
                        <span class="block rounded-sm w-2/4 h-36 sm:h-40"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                            <x-icon-button wire:click="deleteOne" class="py-1 m-1 opacity-70">
                                <span class="material-icons-outlined">delete</span>
                            </x-icon-button>
                        </span>
                    @else 
                        <div class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-2/4 h-36 sm:h-40">
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
            <div class="mt-6">
                <x-label for="video_url"  class="font-bold" value="{{ __('Video link YouTube ') }}"/>
                <x-input id="video_url" type="text" class="mt-1 block w-full" wire:model.defer="video_url"  autocomplete="off" minlength="3" maxlength="50"/>
                <x-input-error for="video_url" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <!-- button --> 
            <div class="mt-2 flex justify-center">
                <x-button wire:click="StoreOrUpdate" wire:loading.attr="disabled">
                   <div class="my-2 mx-3">
                        <span class="px-2 font-bold sm:text-base"> {{ __('Save') }}</span>
                   </div>
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>