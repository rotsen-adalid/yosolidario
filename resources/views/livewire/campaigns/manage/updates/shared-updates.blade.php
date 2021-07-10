<x-slot name="title">
    {{ __('Updates') }} : YoSolidario
</x-slot>
<x-slot name="seo">

</x-slot>
<x-slot name="menu">
    <livewire:menu.navigation-panel />
</x-slot>

<div class="mt-20 bg-white">
    <div class="max-w-2xl mx-auto px-4 sm:px-2 py-10 sm:py-10">
        <a  href="{{ route('campaign/published', $campaignUpdate->campaign->slug) }}" class="cursor-pointer my-4 border border-gray-300 py-1 px-2 flex space-x-1 w-20">
            <span class="material-icons-outlined text-sm">arrow_back_ios</span>
            <span class="font-bold">{{__('Back')}}</span>
        </a>
        <div class=""> <!--border-b border-gray-200 -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    @if($campaignUpdate->user->profile_photo_path)
                    <div class="flex-shrink-0 w-12 h-12 cursor-pointer">
                        <img class="h-12 w-12 rounded-full object-cover"
                            src="{{ URL::to('/') }}{{$campaignUpdate->user->profile_photo_path}}"
                            alt="" />
                    </div>
                    @else 
                    <div class="flex-shrink-0 w-12 h-12 cursor-pointer">
                        <img class="h-12 w-12 rounded-full object-cover"
                            src="{{ $campaignUpdate->user->profile_photo_url }}" alt="{{ $campaignUpdate->user->name }}" />
                    </div>
                    @endif
                    <div class="ml-3 space-y-2">
                        <div class="text-gray-700 text-sm sm:text-base cursor-pointer font-bold"> 
                            {{$campaignUpdate->user->name}}
                        </div>
                    </div>
                    <div class="font-bold text-2xl flex items-center text-gray-500 px-2">
                        <span class="material-icons-outlined text-xs">access_time_filled</span>
                    </div>
                    <div class=" text-gray-500">
                        {{ \Carbon\Carbon::parse($campaignUpdate->created_at)->diffForHumans() }}
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-center  mt-2">

                    @if ($campaignUpdate->video)
                        <iframe class="h-44 md:h-76 md:w-3/6 lg:h-72 lg:w-4/6" src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook%2Fvideos%2F{{$this->urlVideo($campaignUpdate->video->url)}}%2F&width=500&show_text=false&appId=738141669970459&height=280"  style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
                    @elseif ($campaignUpdate->image)
                        <div @click="$dispatch('imgu-modal', {  imgModalSrcUpdates: '{{URL::to('/').$campaignUpdate->image->url}}', imgModalDescUpdates: '' })" class="flex justify-center sm:block">
                            @if ($campaignUpdate->image->url)
                                <img class="h-44 md:h-76 md:w-3/6 lg:h-72 lg:w-auto mt-3 sm:mt-0 sm:mr-4 rounded cursor-pointer" src="{{URL::to('/').$campaignUpdate->image->url}}" 
                                />
                            @endif
                        </div>
                    @endif
                </div>
                <div class="sm:px-20 ">
                    {!! nl2br(e($campaignUpdate->body), false) !!}
                </div>
            </div>
        </div>

    </div>
</div>
<livewire:footer.footer-app/>

