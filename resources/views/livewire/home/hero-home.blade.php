<div class=" shadow-lg bg-gray-600 w-full flex flex-row flex-wrap p-3 antialiased" style="
    background-image: url('{{asset('images/3.jpg')}}');
    background-repeat: no-repat;
    background-size: cover;
    background-blend-mode: multiply;
    ">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:py-10">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

            <div class="col-span-6 pt-5 sm:py-10">
                <h1 class="text-center sm:text-left font-bold text-3xl sm:text-4xl md:text-5xl max-w-xl text-white leading-tight">
                {{ __('Raise funds today for the causes that move you the most') }}
                </h1>
            <!-- 
                <hr class="item-center w-12 h-1 bg-orange-500 rounded-full mt-4 sm:mt-8">
            -->
                <p class="text-xl sm:text-2xl text-center sm:text-left text-white leading-relaxed mt-6 sm:mt-8 font-thin">
                    {{ __('Starting is easy.') }}
                    {{$this->commission_percentage}}%
                    {{ __('platform fee for organizers*.') }}
                </p>
                <div class="get-app flex space-x-5 mt-2 sm:mt-10 justify-center md:justify-start">
                    <button wire:click="createCampaign" wire:loading.attr="disabled" 
                    class="focus:outline-none text-white text-lg font-bold bg-ys1 shadow-md px-4 py-2 rounded-md flex items-center space-x-4 hover:text-white mt-4 hover:bg-ys2">
                    {{ __('Start a campaign') }}
                    </button>
                </div>
            </div>
            <!-- hero image 
            <div class="hero-image col-span-6">
            <img class="rounded-full  w-full" src="{asset('images/3.jpg')}}" alt="">
            </div>
            -->
        </div>
    </div>
</div>