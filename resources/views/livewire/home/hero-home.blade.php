<div class=" shadow-sm bg-gray-150 w-full flex flex-row flex-wrap p-3 antialiased" style="
    background-image: url('{{asset('images/yosolidario-homepage-illustration-1920w.png')}}');
    background-repeat: no-repat;
    background-size: cover;
    background-blend-mode: multiply;
    ">

    <div class="max-w-6xl mx-auto px-4 md:px-4 lg:px-4 sm:py-10">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

            <div class="col-span-6 pt-5 sm:py-10">
                <h1 class="text-center sm:text-left font-bold text-3xl sm:text-4xl md:text-5xl max-w-xl text-gray-800 leading-tight">
                {{ __('Raise funds today for the causes that move you the most') }}
                </h1>
            <!-- 
                <hr class="item-center w-12 h-1 bg-orange-500 rounded-full mt-4 sm:mt-8">
            -->
                <p class="text-xl sm:text-2xl text-center sm:text-left text-gray-600 leading-relaxed mt-6 sm:mt-8 font-thin">
                    {{__('Get Started Today.')}}
                    <!-- { __('Starting is easy.') }}
                    {$this->commission_percentage}}%
                    { __('platform fee for organizers*.') }}
                    -->
                </p>
                <div class="get-app flex space-x-5 mt-2 sm:mt-10 justify-center md:justify-start">
                    <button wire:click="createCampaign" wire:loading.attr="disabled" 
                    class="focus:outline-none text-white text-lg font-bold bg-ys1 shadow-lg px-5 py-3 rounded flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
                    {{ __('Start a campaign') }}
                    </button>
                </div>
            </div>
            <!-- hero image 
            <div class="hero-image col-span-6">
            <img class="rounded-full  w-full" src="{asset('images/3.jpg')}}" alt="">
            </div>

            <div class="p-16">
                <p x-data="{length: 25}"
                x-init="originalContent = $el.firstElementChild.textContent.trim()">
                <span x-text="originalContent.slice(0, length)">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
                <button x-cloak @click="length = undefined" x-show="length">...</button>
                </p>
            </div>
            -->
        </div>
    </div>
</div>