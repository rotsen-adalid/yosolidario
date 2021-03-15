@if ($collection->count() > 0)
<div class="bg-transparent lg:pt-12 lg:flex lg:justify-center mt-10 sm:-mt-28">
    <div class="bg-white lg:mx-8 lg:flex lg:max-w-5xl shadow-lg rounded-lg  w-full lg:h-56">
        <div class=" w-full lg:w-96">
            <div class="h-44 lg:h-64 bg-cover rounded-t-lg sm:rounded-t-none lg:rounded-r-none lg:rounded-l-lg lg:h-full" 
                style="background-image:url('{{ URL::to('/').$collection[0]->campaign->image->url}}')"></div>
        </div>
        <div class="py-6 px-4  lg:w-full">
            <h2 class="text-base text-pink-700 font-bold uppercase">{{__('Urgent campaign')}}</h2>
            <p class="mt-4 text-lg font-bold text-justify">{{$collection[0]->campaign->title}}</p>
            <p class="mt-2 text-base">{{$collection[0]->campaign->extract}}</p>
            <div class="mt-4">
                <button wire:click="collaborate" wire:loading.attr="disabled" class="w-full sm:w-64 px-6 py-2 text-center border border-ys1 rounded-md font-bold text-base  text-ys1 tracking-widest hover:text-ys2 hover:border-ys2 focus:border-bg-ys2 active:bg-ys2 focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <span>{{__('Back this campaign')}}</span>
                </button>
            </div>
        </div>
    </div>
</div> 
@else
<div>

</div>
@endif