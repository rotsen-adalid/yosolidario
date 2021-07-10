<div>
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-10">
        @foreach ($collection as $item)
        <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
            <div wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-28 sm:h-56 w-full rounded border border-gray-100 bg-cover bg-center" 
                style="background-image: url({{$host.$item->url}})">
            </div>
        </div>
        @endforeach
        
    </div>
    <div class="mt-2 sm:mt-5">
        {{$collection->links()}}
    </div>
</div>