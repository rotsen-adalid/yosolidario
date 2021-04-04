<div class=" py-5 ">
    <div class="flex flex-col flex-col sm:justify-center sm:items-center">
        <div class="flex justify-start space-x-4">
            <div>
                @include('livewire.campaigns.published.svg.amor') 
            </div>
            <div>
                <div class="text-xl sm:text-2xl font-bold">{{__('Be the first to help')}}</div>
                <div>{{__('Your initial support will go a long way and help inspire others to collaborate.')}}</div>
                <div class=" flex sm:justify-center sm:items-center mt-5">
                    <button class="w-full lg:w-72 px-4 py-2 sm:py-4 text-center bg-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-500 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
                        <span>{{__('Back this campaign')}}</span>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
