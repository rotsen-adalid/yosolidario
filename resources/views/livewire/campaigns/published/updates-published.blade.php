<div>
    <div x-data="{ imgModalUpdates : false, imgModalSrcUpdates : '', imgModalDescUpdates : '' }">
        <template @imgu-modal.window="imgModalUpdates = true; imgModalSrcUpdates = $event.detail.imgModalSrcUpdates; imgModalDescUpdates = $event.detail.imgModalDescUpdates;" x-if="imgModalUpdates">
          <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrcUpdates = ''" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
            <div @click.away="imgModalUpdates = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
              <div class="z-50">
                <button @click="imgModalUpdates = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                    <i class=" text-white uil uil-times-circle text-3xl"></i>
                </button>
              </div>
              <div class="p-2">
                <img :alt="imgModalSrcUpdates" class="object-contain h-1/2-screen" :src="imgModalSrcUpdates">
                <p x-text="imgModalDescUpdates" class="text-center text-white"></p>
              </div>
            </div>
          </div>
        </template>
    </div>
    
    @if($campaign_id != 0)
    <!-- collection-->
        @if ($collection->count() > 0)
        <div x-data="{}">
        @php ($i = $collection->count())
        
        <div class="relative mt-0">

            @foreach ($collection as $item)
            <div class="@if ($i != $collection->count())  @php($i++)  @endif py-0"> <!--border-b border-gray-200 -->
                <div class="flex justify-between items-center sm:px-0">
                    <div class="flex items-center">
                        @if($item->user->profile_photo_path)
                        <div class="flex-shrink-0 w-12 h-12 cursor-pointer">
                            <img class="h-12 w-12 rounded-full object-cover"
                                src="{{ URL::to('/') }}{{$item->user->profile_photo_path}}"
                                alt="" />
                        </div>
                        @else 
                        <div class="flex-shrink-0 w-12 h-12 cursor-pointer">
                            <img class="h-12 w-12 rounded-full object-cover"
                                src="{{ $item->user->profile_photo_url }}" alt="{{ $item->user->name }}" />
                        </div>
                        @endif
                        <a  href="{{ route('campaign/manage/communications/shared', $item->id) }}" class=" flex">
                            <div class="ml-3 space-y-2">
                                <div class="text-gray-700 text-sm sm:text-base cursor-pointer font-bold"> 
                                    {{$item->user->name}}
                                </div>
                            </div>
                            <div class="font-bold text-2xl flex items-center text-gray-500 px-2">
                                <span class="material-icons-outlined text-xs">access_time_filled</span>
                            </div>
                            <div class=" text-gray-500">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </div>
                        </a>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-center  mt-2">

                        @if ($item->video)
                            <iframe class="h-44 md:h-76 md:w-3/6 lg:h-72 lg:w-4/6" src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F{{$this->urlVideo($item->video->url)}}%2F&width=500&show_text=false&appId=738141669970459&height=280"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
                        @elseif ($item->image)
                            <div @click="$dispatch('imgu-modal', {  imgModalSrcUpdates: '{{URL::to('/').$item->image->url}}', imgModalDescUpdates: '' })" class="flex justify-center sm:block">
                                @if ($item->image->url)
                                    <img class="h-44 md:h-76 md:w-3/6 lg:h-72 lg:w-auto mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$item->image->url}}" 
                                    />
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="sm:px-14">
                        {!! nl2br(e($item->body), false) !!}
                    </div>
                </div>
            </div>
            @php ($i--)
            @endforeach
            
            <div class="sm:px-14">
                {{$collection->onEachSide(1)->links()}}
            </div>
        </div>

        </div>
        @else
            <div class="text-center py-5 ">
                <span class="text-xl sm:text-2xl font-bold">{{__('No updates')}}</span>
            </div>
        @endif

        <div class=" flex sm:justify-center sm:items-center mt-5 sm:mt-5 space-x-4">
            <button
                wire:click="$emit('backThisCampaign', {{$campaign->id}})" wire:loading.attr="disabled"  
                class="w-full lg:w-72 px-4 py-2 sm:py-3 text-center bg-yellow-400 border border-yellow-500 shadow-lg rounded-md font-bold text-base text-black uppercase tracking-widest hover:bg-yellow-300 active:bg-yellow-300 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <!-- <img src="{asset('images/icono.png')}}" class="h-7" alt=""> -->
                <span>{{__('Back this campaign')}}</span>
            </button>
           
        </div>
    @else
    <div class="text-center py-5 ">
        <span class="text-xl sm:text-2xl font-bold">{{__('Refresh to see updates')}}</span>
    </div>
    @endif

</div>
