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
                <div x-data="{ form:  @entangle('formAlpine'), option: @entangle('optionAlpine'), photo: @entangle('photoAlpine'), video: @entangle('videoAlpine') }">
                
                    <div x-show="form">
                         <!-- Body -->
                        <div class="mt-6">
                            <x-label for="body" class="font-semibold" value="{{ __('Share your news') }}" />
                            <x-textarea id="body" class="mt-1 block w-full h-28 sm:h-48" wire:model="body"
                                autocomplete="off" />
                            <x-input-error for="body" class="mt-2" />
                        </div>
                    </div>

                    <div x-show="option" class="mt-6">
                        <x-secondary-button @click="photo = true, option = false, video = false">
                            {{ __('Add photo') }}
                        </x-secondary-button>
                        <x-secondary-button @click="video = true, option = false, photo = false" >
                            {{ __('Add video') }}
                        </x-secondary-button>
                    </div>

                    <div x-show="photo">
                        <div class="mt-6">
                            <x-secondary-button @click="photo = false, video = true">
                                {{ __('Add video') }}
                            </x-secondary-button>
                        </div>
                        <!-- form upload -->
                        <div div class="font-semibold text-2xl text-center border-t border-gray-200 mt-3 pt-3">
                            @if ($campaign_update_id)
                                {{ __('Modify the photo') }}
                            @else
                                {{ __('Add a photo') }}
                            @endif
                        </div>
                        <!-- Photo -->
                        <div x-data="{photoName: @entangle('photoName'), photoPreview: @entangle('photoPreview')}" class="mt-2 mt-6">
                            <!-- Profile Photo File Input -->
                            <input type="file" class="hidden" accept="image/*" wire:model="photoOne" x-ref="photo"
                                x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                            <!-- <x-label for="photoOne" class="font-semibold" value="{ __('Image') }}" /> -->
                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="!photoPreview">
                                @if ($update_photo_path)
                                    <x-icon-button wire:click="deleteOne" @click="photoPreview = null" class="flex absolute justify-center m-1 opacity-70 py-1">
                                        <span class="material-icons-outlined">delete</span>
                                    </x-icon-button>
                                    <img src="{{ URL::to('/') }}{{ $update_photo_path }}" alt=""
                                        class="rounded-sm w-full h-36 sm:h-72 object-cover rounded-md">
                                @else
                                    <div x-on:click.prevent="$refs.photo.click()"
                                        class="mt-1 flex justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-full h-36 sm:h-72">
                                        <div  class="cursor-pointer space-y-1 text-center">
                                            <span class="material-icons-outlined text-5xl text-gray-500">add_a_photo</span>
                                            <p class="text-xs text-gray-500">
                                                {{__('PNG, JPG up to 2MB')}}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Image Preview -->
                            <div class="mt-2" x-show="photoPreview">
                                <span class="block rounded-sm w-full h-36 sm:h-72"
                                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                    <x-icon-button @click="photoPreview = null" class="flex justify-center py-1 m-1 opacity-70">
                                        <span class="material-icons-outlined">delete</span>
                                    </x-icon-button>
                                </span>
                                <!-- 
                                <div class="mt-5 flex">
                                    <x-button class="ml-2 mb-2" click="photo = false, video = false, form = true">
                                        <span class="py-2 sm:px-5 text-base">{ __('Save') }}</span>
                                    </x-button>
                                </div>
                                -->
                            </div>
                            <x-input-error for="photoOne" class="mt-2" />
                        </div>
                        <div class="mt-3  text-center">
                            {{__('A high-quality photo or video will help tell your story.')}}
                        </div>

                    </div>
    
                    <div x-show="video">
                        <div class="mt-6">
                            <x-secondary-button @click="photo = true, video = false">
                                {{ __('Add photo') }}
                            </x-secondary-button>
                        </div>
                        <!-- form upload -->
                        <div div class="font-semibold text-2xl text-center border-t border-gray-200 mt-3 pt-3">
                            @if ($campaign_update_id)
                                {{ __('Modify the video') }}
                            @else
                                {{ __('Add a video') }}
                            @endif
                        </div>

                        <!-- Video link  -->
                        <div class="mt-6">
                            <x-label for="video_url" class="font-semibold" value="{{ __('Video link Facebook') }}" />
                            <x-input id="video_url" type="text" class="mt-1 block w-full" wire:model="video_url" wire:keyup="urlVideo"
                                autocomplete="off" minlength="3" maxlength="49" />
                            <x-input-error for="video_url" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            @if ($video_iframe)
                                <iframe class="h-44 md:h-56 md:w-5/12 lg:h-72 lg:w-full" src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F{{$video_iframe}}%2F&width=500&show_text=false&appId=738141669970459&height=280"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
                            @endif
                        </div>

                        <div class="mt-3  text-center">
                            {{__('A high-quality photo or video will help tell your story.')}}
                        </div>
                    </div>

                    <div class="border-b border-gray-200 py-5">
                        <div class="font-bold">{{ __('Send update to') }}:</div>
                    </div>

                    <div class="flex space-x-2 mt-4">
                        <x-checkbox name="terms" id="terms" checked disabled />
                        <span>{{ __('Campaign Page (default)') }}</span>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        <x-checkbox name="terms" id="terms" />
                        <span>{{ __('Collaborators & followers') }}</span>
                    </div>
                    <!-- 
                    <div class="flex space-x-2 mt-4">
                        <x-checkbox name="terms" id="terms" />
                        <span>{ __('Facebook') }}</span>
                    </div>
                   
                    <div class="flex space-x-2 mt-4">
                        <x-checkbox name="terms" id="terms" />
                        <span>{{ __('Telegram') }}</span>
                    </div>
                    -->
                    <div class="flex justify-center mt-5 sm:mt-10">
                        <x-button class="ml-2 mb-2" wire:loading.attr="disabled">
                            <span class="py-2 sm:px-5 text-base">{{ __('Post communication') }}</span>
                        </x-button>
                    </div>
                    <!-- -->
                </div>
            </form>
        </div>
    </div>
</div>
<livewire:footer.footer-app/>
