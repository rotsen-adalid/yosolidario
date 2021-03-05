<div x-data="videoFullWidth()">
    <!-- 
      @@click.away="
        isPlaying = false;
        $nextTick(() => { $refs.iframeElement.setAttribute('src', '') });"
    -->
    <div class="flex items-center justify-center u-ratio u-ratio--16by9" :class="{ 'hidden': isPlaying }">
      <img src="{{ URL::to('/').$this->campaign->image->url}}" alt="placeholder image" class="object-cover u-ratio__item">
      <div class="u-ratio__item">
        <div class="h-full flex justify-center items-center">
          <button class="flex items-center justify-center absolute hover:scale-125 
                          transition-transform transform duration-300 
                          focus:outline-none focus:shadow-outline
                          text-5xl" 
                          @click="
                        isPlaying = !isPlaying;
                        $nextTick(() => { $refs.iframeElement.setAttribute('src', iframe_url()) });">
            <i class="text-white text-7xl uil uil-play-circle"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="u-ratio u-ratio--16by9 bg-transparent"  :class="{ 'bg-black' : isPlaying }" x-show.transition.in.opacity.duration.500ms="isPlaying" x-cloak>
      <iframe x-ref="iframeElement" src="" class="object-cover u-ratio__item" frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
      </iframe>
    </div>
    <div class="px-4 sm:px-0 text-sm sm:text-base flex pt-5 justify-center item-center  text-black">
      <span>{{__('Created')}}
        {{ \Carbon\Carbon::parse($this->campaign->created_at)->diffForHumans() }}
      </span>
      <span class="mx-2">|</span>
      <span>{{__($this->campaign->categoryCampaign->name)}}</span>
    </div>
  </div>
  
  <script>
    function videoFullWidth() {
      return {
        isPlaying: false,
        embed_url: "https://www.youtube.com/embed/{{$video_url}}",
        iframe_param: "?controls=1&autoplay=1&mute=0",
        iframe_url() {
          return this.embed_url + this.iframe_param;
        }
      };
    }
  </script>
  