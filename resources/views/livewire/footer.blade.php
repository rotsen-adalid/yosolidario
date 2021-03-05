<footer class="footer bg-white relative pt-1 border-t border-gray-150 h-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:mt-8">
            <div class="mt-8 sm:mt-0 sm:w-full flex flex-col md:flex-row justify-between">
                <div class="flex flex-col">
                    <span class="font-bold text-gray-700 uppercase mb-2">
                        <x-application-mark/>
                    </span>
                    <div class="my-5">
                        <div>
                            {{ __('Write to us') }} info@yosolidario.com
                        </div>
                        <div>
                            {{__('by Facebook Messenger')}}
                        </div>
                    </div>
                    <!-- 
                    <form wire:submit.prevent="change">
                    <x-select class="mt-1 block w-full" id="language" wire:model="language">
                        <x-slot name="option">
                            <option value="SPANISH">{ __('Spanish') }}</option>
                            <option value="ENGLISH">{ __('English') }}</option>
                        </x-slot>
                    </x-select>
                    </form>

                    <a href="{route('set_language', 'es')}}">Espanish</a>
                    <a href="{route('set_language', 'en')}}">English</a>
                    -->
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-ys1 uppercase mb-2">{{ __('Join up') }}</span>
                    <span class="my-2"><a href="{{ route('campaign/create') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('Create campaign') }}</a></span>
                    <span class="my-2"><a href="#" class="text-gray-700  text-md hover:text-gray-900">{{ __('Collaborate') }}</a></span>
                    <span class="my-2"><a href="{{ route('register') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('Create an account') }}</a></span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-ys1 uppercase mb-2">{{ __('We ') }}</span>
                    <span class="my-2"><a href="{{ route('about/know-us') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('Know us') }}</a></span>
                    <span class="my-2"><a href="{{ route('about/how-it-works') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('How does it work?') }}</a></span>
                    <span class="my-2"><a href="#" class="text-gray-700  text-md hover:text-gray-900">{{ __('Join the team') }}</a></span>
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-ys1 uppercase mb-2">{{ __('Legal ') }}</span>
                    <span class="my-2"><a href="{{ url('terms-of-service') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('Terms and conditions') }}</a></span>
                    <span class="my-2"><a href="{{ url('privacy-policy') }}" class="text-gray-700  text-md hover:text-gray-900">{{ __('Privacy policy') }}</a></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pt-7">
        <div class="max-w-7xl mx-auto flex pb-5 pt-5  px-4
            border-t border-gray-150 text-gray-900  
            flex-col md:flex-row max-w-6xl">
            <div class="mt-2 text-center sm:text-left text-base">
                © Copyright 2021 - {{ __('year. All Rights Reserved.') }}
            </div>

            <!-- Required Unicons (if you want) -->
            <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex justify-center sm:justify-start item-center text-xl">
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-facebook-f"></i>
                </a>
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-twitter-alt"></i>
                </a>
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-youtube"></i>
                </a>
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-linkedin"></i>
                </a>
                <a href="#" class="w-6 mx-1">
                    <i class="uil uil-instagram"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
