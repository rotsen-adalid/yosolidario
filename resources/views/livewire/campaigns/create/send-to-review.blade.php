<x-dialog-modal wire:model="confirmingSendReview">
    <x-slot name="title">
        <div class="text-red-500 font-semibold text-xl">
            {{ __('Send for review?') }}
        </div>
    </x-slot>
    <x-slot name="content">
        @if(Auth::user()->profile->count() > 0 )

        <div class="font-bold text-lg">
            {{ __('Your campaign') }}:
        </div>

        <div class="font-bold text-lg">
            <span>{{$campaign->title}}</span>
        </div>

        <div class="summary-post text-base text-justify mt-5">
            {{ __('It will be sent for review, we will contact you in less than 48 hours and your campaign will be published.') }}
        </div>

        <div class="flex items-center pt-3">
            @if(Auth::user()->profile_photo_path)
            <div class="flex-shrink-0 w-10 h-10">
                <img class="w-full h-full rounded-full"
                    src="{{ URL::to('/') }}{{Auth::user()->profile_photo_path}}"
                    alt="" />
            </div>
            @else 
            <div class="flex-shrink-0 w-15 h-15">
                <img class="w-full h-full rounded-full"
                    src="{{Auth::user()->profile_photo_url }}" alt="{{Auth::user()->name }}" />
            </div>
            @endif
            <div class="ml-3 space-y-2 my-4">
                <div class="text-gray-700"> 
                    <span class="font-bold">{{__('Organizator')}}: </span>
                    {{Auth::user()->name}}
                </div>
                <a href="tel:{{$campaign->country->telephone_prefix}}{{$campaign->telephone}}" class="flex space-x-1 items-center">
                    <svg class="h-5" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 405.333 405.333" style="enable-background:new 0 0 405.333 405.333;" xml:space="preserve">
                    <path style="fill:#009688;" d="M373.333,266.88c-24.696,0.048-49.241-3.856-72.704-11.563c-10.97-3.836-23.163-1.254-31.637,6.699
                        l-46.037,34.731c-49.441-24.823-89.557-64.931-114.389-114.368l33.813-44.928c8.537-8.543,11.59-21.136,7.915-32.64
                        C142.558,81.316,138.633,56.735,138.667,32c0-17.673-14.327-32-32-32H32C14.327,0,0,14.327,0,32
                        c0.235,206.089,167.244,373.098,373.333,373.333c17.673,0,32-14.327,32-32V298.88C405.333,281.207,391.006,266.88,373.333,266.88z"
                        />
                    <g>
                        <path style="fill:#455A64;" d="M394.667,170.667c-5.891,0-10.667-4.776-10.667-10.667
                            c-0.094-76.545-62.122-138.573-138.667-138.667c-5.891,0-10.667-4.776-10.667-10.667S239.442,0,245.333,0
                            c88.327,0.094,159.906,71.673,160,160C405.333,165.891,400.558,170.667,394.667,170.667z"/>
                        <path style="fill:#455A64;" d="M309.333,170.667c-5.891,0-10.667-4.776-10.667-10.667c0-29.455-23.878-53.333-53.333-53.333
                            c-5.891,0-10.667-4.776-10.667-10.667c0-5.891,4.776-10.667,10.667-10.667C286.571,85.333,320,118.763,320,160
                            C320,165.891,315.224,170.667,309.333,170.667z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g>
                    </g><g></g><g></g><g></g><g></g><g></g>
                    </svg>
                    <div>
                        {{$campaign->telephone}}
                    </div>
                </a>
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="my-5">
            <x-jet-label for="terms">
                <div class="flex items-center">
                    <x-jet-checkbox name="terms" id="terms" wire:model.defer="terms"/>

                    <div class="ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
                <x-jet-input-error for="terms" class="mt-1" />
            </x-jet-label>
        </div>
        @endif

        @else 
        <div class="flex justify-start items-center space-x-1">
            <svg class="h-5" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 455.111 455.111" style="enable-background:new 0 0 455.111 455.111;" xml:space="preserve">
            <circle style="fill:#E24C4B;" cx="227.556" cy="227.556" r="227.556"/>
            <path style="fill:#D1403F;" d="M455.111,227.556c0,125.156-102.4,227.556-227.556,227.556c-72.533,0-136.533-32.711-177.778-85.333
                c38.4,31.289,88.178,49.778,142.222,49.778c125.156,0,227.556-102.4,227.556-227.556c0-54.044-18.489-103.822-49.778-142.222
                C422.4,91.022,455.111,155.022,455.111,227.556z"/>
            <path style="fill:#FFFFFF;" d="M331.378,331.378c-8.533,8.533-22.756,8.533-31.289,0l-72.533-72.533l-72.533,72.533
                c-8.533,8.533-22.756,8.533-31.289,0c-8.533-8.533-8.533-22.756,0-31.289l72.533-72.533l-72.533-72.533
                c-8.533-8.533-8.533-22.756,0-31.289c8.533-8.533,22.756-8.533,31.289,0l72.533,72.533l72.533-72.533
                c8.533-8.533,22.756-8.533,31.289,0c8.533,8.533,8.533,22.756,0,31.289l-72.533,72.533l72.533,72.533
                C339.911,308.622,339.911,322.844,331.378,331.378z"/>
            <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
            <div class="font-bold text-lg">
                {{ __('You need to complete your profile') }}
            </div>
        </div>

        <div class="flex items-center pt-3">
            @if(Auth::user()->profile_photo_path)
            <div class="flex-shrink-0 w-10 h-10">
                <img class="w-full h-full rounded-full"
                    src="{{ URL::to('/') }}{{Auth::user()->profile_photo_path}}"
                    alt="" />
            </div>
            @else 
            <div class="flex-shrink-0 w-15 h-15">
                <img class="w-full h-full rounded-full"
                    src="{{Auth::user()->profile_photo_url }}" alt="{{Auth::user()->name }}" />
            </div>
            @endif
            <div class="ml-3 space-y-2 my-4">
                <div class="text-gray-700"> 
                    <span class="font-bold">{{__('Organizator')}}: </span>
                    {{Auth::user()->name}}
                </div>
                <div>
                    <x-button class="ml-2" wire:click="editProfile" wire:loading.attr="disabled">
                        {{ __('Complete your profile') }}
                    </x-button>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingSendReview')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-secondary-button>
        @if(Auth::user()->profile->count() > 0 )
            <x-button class="ml-2" wire:click="sendReview" wire:loading.attr="disabled">
                {{ __('Send') }}
            </x-button>
        @endif
    </x-slot>
</x-dialog-modal>