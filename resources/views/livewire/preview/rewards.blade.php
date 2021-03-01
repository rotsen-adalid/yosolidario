<div class=" border-b md:mt-4 mb-5 font-bold py-2 pb-2 text-2xl">
    {{__('Rewards')}}
</div>
<div class=" pt-10 md:pt-20 sm:pt-18">
    @foreach ($collection as $item)
    <div class=" md:mb-6 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto pb-10">
        <!--
        <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
            style="background-image: url()">
        </div>
        -->
        <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5 border">
        
            <div class="title-post font-semibold text-xl">{{$item->amount}} {{$item->campaign->country->currency_symbol}}</div>
      
            <!-- collaboratos -->
            <div class="header-content inline-flex ">
              <div class="category-title flex-1 text-sm">0 {{__('Collaborators')}}</div>
            </div>
            <!-- description -->
            <div class="summary-post text-base text-justify mt-4">
                {{$item->description}}
            </div>
            <!-- options -->
            <hr class="mt-2 mb-5">
            <div class="flex justify-center items-center mt-5 sm:mt-0">
                <button  wire:loading.attr="disabled" class=" px-4 py-2 text-center border border-ys1 rounded-md font-bold text-base  text-ys1 tracking-widest hover:text-white hover:bg-ys2 focus:border-bg-ys2 active:bg-ys2 focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Select this reward') }}
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
