<div>
    @php ($i = $collection->count())
    @if ($collection->count() > 0)
    <div class="relative mt-5"> <!-- w-1/2 -->
        <div class="border-r-2 border-green-500 absolute h-full top-0" style="left: 15px"></div>
        <ul class="list-none m-0 p-0">
        @foreach ($collection as $item)
            <li class="mb-2 ">
                <div class="flex mb-1">
                    <div class="z-20 ">
                        <div class="flex items-center bg-green-500 rounded-full h-8 w-8">
                            <span class="mx-auto font-semibold text-lg text-white">{{$i}}</span>
                        </div>
                    </div>
                    <div class="ml-2 sm:ml-12 bg-white border rounded-lg shadow px-2 py-2 sm:px-4 sm:py-4">
                        <div class="flex-1 font-medium">
                            <span class="capitalize font-bold text-gray-800">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </span>
                            <span class="font-bold text-gray-800"> - </span>
                            <span class="mb-3 font-bold text-gray-800 text-lg">
                                {{$item->title}}
                            </span>
                        </div>
                        <p class="my-5 text-sm leading-snug tracking-wide text-gray-900 text-opacity-100 text-justify">
                            {!! nl2br(e($item->body), false) !!}
                        </p>
                        @if ($item->update_photo_path)
                            <img src="{{ URL::to('/').$item->update_photo_path}}" alt="">
                        @endif
                    </div>
                </div>
            </li>
        @php ($i--)
        @endforeach
        </ul>
    </div>
    @else
    <div class="text-center py-5 ">
        <span>{{__('No updates yet ')}}</span>
    </div>
    
    @endif
</div>