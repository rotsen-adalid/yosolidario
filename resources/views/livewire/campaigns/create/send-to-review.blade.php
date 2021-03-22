<x-dialog-modal wire:model="confirmingSendReview">
    <x-slot name="title">
        <div class="font-semibold text-xl">
            {{ __('Publish campaign') }}?
        </div>
    </x-slot>
    <x-slot name="content">
        @if(Auth::user()->profile)

        <div class="font-bold text-lg">
            {{ __('Your campaign') }}:
        </div>

        <div class="font-bold text-lg">
            {{$campaign->title}} 
            <span class="material-icons-outlined">format_quote</span>
        </div>

        <div class="summary-post text-base text-justify mt-5">
            {{ __('You can start fundraising now.') }}
        </div>
        <div class="summary-post text-base text-justify mt-2">
            {{ __('We will contact you in less than 24 hours to verify the authenticity of your campaign.') }}
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
                    <span class="material-icons-outlined">call</span>
                    <span class="font-bold">
                        {{$campaign->telephone}}
                    </span>
                </a>
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="my-5">
            <x-label for="terms">
                <div class="flex items-center">
                    <x-checkbox name="terms" id="terms" wire:model.defer="terms"/>

                    <div class="ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </div>
                </div>
                <x-input-error for="terms" class="mt-1" />
            </x-label>
        </div>
        @endif

        @else 
        <div class="flex justify-start items-center space-x-1">
            <i class="uil uil-times-circle text-red-500 text-2xl"></i>
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
                    <span>{{Auth::user()->name}}</span>
                </div>
                <div>
                    <x-button class="ml-2 text-sm" wire:click="editProfile" wire:loading.attr="disabled">
                        {{ __('Complete your profile') }}
                    </x-button>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingSendReview')" wire:loading.attr="disabled">
            <span class="">{{ __('Nevermind') }}</span>
        </x-secondary-button>
        @if(Auth::user()->profile)
            <x-button class="ml-2" wire:click="sendReview" wire:loading.attr="disabled">
               <span class=""> {{ __('Publish campaign') }}</span>
            </x-button>
        @endif
    </x-slot>
</x-dialog-modal>