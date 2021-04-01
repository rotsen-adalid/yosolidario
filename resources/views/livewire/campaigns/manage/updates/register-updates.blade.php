<x-slot name="title">
    @if ($campaign_update_id)
        {{ __('Edit communication') }} : YoSolidario
    @else
        {{ __('Post an update') }} : YoSolidario
    @endif
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel/>
</x-slot>
<div class="pt-20 bg-white">
    <div class="hidden lg:flex lg:items-center">
        <header class="bg-white shadow pt-1 w-full"> 
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <a  href="{{ route('campaign/manage/communications/show', $campaign) }}" class="cursor-pointer my-4 border border-gray-300 py-1 px-2 flex space-x-1 w-20">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                    <span class="font-bold">{{__('Back')}}</span>
                </a>
                <div class="flex space-x-4 items-center">
                    <div>
                        <img src="{{ URL::to('/').$campaign->image->url}}" alt="{{$campaign->title}}" class="h-16">
                    </div>
                    <div>
                        @if ($campaign_update_id)
                            <h2 class="flex items-center font-bold text-2xl text-gray-800 leading-tight pt-4">
                                {{ __('Edit communication') }}
                            </h2>
                        @else 
                            <h2 class="flex items-center font-bold text-2xl text-gray-800 leading-tight pt-4">
                                {{ __('Post an update') }}
                            </h2>
                        @endif
                        <a href="{{ route('campaign/published', $campaign->slug) }}" 
                            class="font-bold text-base cursor-pointer text-gray-600">
                            {{$campaign->title}}
                        </a>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- Responsive -->
    <div class="lg:hidden">
        <div class="border-b border-gray-200 pt-5 pb-4  px-4">
            <a  ref="{{ route('campaign/manage/communications/show', $campaign) }}" class="cursor-pointer flex space-x-1 w-24">
                <span class="material-icons-outlined text-sm">arrow_back_ios</span>
            </a>
            <div class="flex items-center justify-center text-xl font-bold -mt-6">{{__('Post an update')}}</div>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-0 sm:pt-5 sm:pb-10">
        <div class="border border-gray-100 my-5 py-4 sm:py-10 px-4 sm:px-20 rounded shadow bg-white">

            <div class="hidden lg:flex space-x-16 items-center justify-center">
                <div class="font-bold text-2xl">
                    @if ($campaign_update_id)
                        {{ __('Edit communication') }}
                    @else
                        {{ __('Post an update') }}
                    @endif
                </div>
            </div>

            <form wire:submit.prevent="StoreOrUpdate">
            <!-- Title -->
            <div class="mt-6">
                <x-label for="title" class="font-bold" value="{{ __('Title') }}" required/>
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" autocomplete="off" />
                <x-input-error for="title" class="mt-2" />
            </div>
            <!-- Body -->
            <div class="mt-2 mt-6">
                <x-label for="body"  class="font-bold" value="{{ __('Contents') }}" required/>
                <x-textarea id="body" class="mt-1 block w-full h-36 sm:h-36" wire:model.defer="body" autocomplete="off"/>
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
            <div class="mt-6">
                <x-label for="video_url"  class="font-bold" value="{{ __('Video link YouTube ') }}"/>
                <x-input id="video_url" type="text" class="mt-1 block w-full" wire:model.defer="video_url"  autocomplete="off" minlength="3" maxlength="50"/>
                <x-input-error for="video_url" class="mt-2" />
            </div>
            <!-- button --> 
            <div class="mt-6 flex justify-center">
                <x-button wire:loading.attr="disabled">
                   <div class="my-2 mx-3">
                        <span class="px-2 font-bold sm:text-base"> {{ __('Save') }}</span>
                   </div>
                </x-button>
            </div>
            </form>
        </div>
    </div>
</div>
<livewire:footer.footer-app/>
