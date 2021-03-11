<x-slot name="title">
    {{__('Updates')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div class="bg-violet-50">
<x-section-content>
    <x-slot name="header">
        <livewire:campaigns.manage.show-header :campaign="$campaign"/>
    </x-slot>
    <x-slot  name="content">
        <x-section-title>
            <x-slot name="title">
                <x-button class="ml-2 font-bold text-base" wire:click="addUpdates" wire:loading.attr="disabled">
                    <i class="uil uil-plus text-base"></i>
                    <span>{{__('Add update')}}</span>
                </x-button>
            </x-slot>
            <x-slot name="description">
            </x-slot>
        </x-section-title>
        @php ($i = $collection->count())
        @if ($collection->count() > 0)
        
        <div class="relative mt-8"> <!-- w-1/2 -->
            <div class="border-r-2 border-green-500 absolute h-full top-0" style="left: 15px"></div>
            <ul class="list-none m-0 p-0">
            @foreach ($collection as $item)
                <li class="mb-2 ">
                    <div class="flex mb-1">
                        <div class="z-20 ">
                            <div class="flex items-center bg-green-500 rounded-full h-8 w-8">
                                <span class="mx-auto font-semibold text-lg text-white">{{$i}}</span>
                            </div>
                        </div>
                        <div class="ml-2 sm:ml-12 bg-white border rounded-lg shadow px-2 py-2 sm:px-4 sm:py-4">
                            <div class="flex-1 font-medium">
                                <span class="capitalize font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </span>
                                <span class="font-bold text-gray-800"> - </span>
                                <span class="mb-3 font-bold text-gray-800 text-lg">
                                    {{$item->title}}
                                </span>
                            </div>
                            <div class="flex space-x-2">
                                <i class="uil uil-edit text-lg font-bold cursor-pointer" 
                                    wire:click="updateDialog({{$item->id}})" wire:loading.attr="disabled"></i>
                                <i class="uil uil-trash text-lg text-red-500 cursor-pointer" 
                                    wire:click="deleteConfirm({{$item->id}})" wire:loading.attr="disabled"></i>
                            </div>
                            <p class="my-5 text-sm leading-snug tracking-wide text-gray-900 text-opacity-100 text-justify">
                                {!! nl2br(e($item->body), false) !!}
                            </p>
                            @if ($item->update_photo_path)
                                <img src="{{ URL::to('/').$item->update_photo_path}}" alt="">
                            @endif
                        </div>
                    </div>
                </li>
            @php ($i--)
            @endforeach
            </ul>
        </div>
        @else
            <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-8">
                <div> 
                    <h2 class="mt-4 text-center text-xl font-light">
                        {{ __('No updates') }}
                    </h2>
                </div>
                </div>
            </div>
        @endif
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
                                <img src="{{asset('images/photo_upload.png')}}" alt="" class="rounded-sm h-60 sm:h-64 w-full object-cover">
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
                </x-slot>
                <x-slot name="footer">
                    <x-secondary-button wire:click="$toggle('updatesDialog')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-secondary-button>
                    @if ($campaign_update_id)
                        <x-button class="ml-2" wire:click="StoreOrUpdate" wire:loading.attr="disabled">
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
                    <x-secondary-button wire:click="$toggle('deleterDialog')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-secondary-button>
                    <x-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-button>
                </x-slot>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-section-content>
</div>
<livewire:footer/>