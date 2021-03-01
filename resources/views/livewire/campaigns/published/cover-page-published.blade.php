
<div class="px-4 sm:px-0">
    <h1 class="text-2xl sm:text-4xl font-bold text-black">
      {!! nl2br(e($this->campaign->title), false) !!}
    </h1>
    <div class="my-2 mb-4 space-y-2 text-base sm:text-lg text-justify">
        <span class="text-ys1 font-bold ">
          {!! nl2br(e($this->campaign->locality), false) !!} - 
        </span>
        <span class="text-black text-black">
          {!! nl2br(e($this->campaign->extract), false) !!}
        </span>
    </div>
</div>
<section  class="px-0 sm:px-0">
    <div x-data="videoFullWidth()">
        <!-- @click.away="
          isPlaying = false;
          $nextTick(() => { $refs.iframeElement.setAttribute('src', '') });"
        -->
      <div class="flex items-center justify-center u-ratio u-ratio--16by9" :class="{ 'hidden': isPlaying }">
        <img src="{{ URL::to('/').$this->campaign->image->url}}" alt="placeholder image" class="object-cover u-ratio__item">
        <div class="u-ratio__item">
          <div class="h-full flex justify-center items-center">
            <button class="flex items-center justify-center absolute hover:scale-125 transition-transform transform duration-300" @click="
                          isPlaying = !isPlaying;
                          $nextTick(() => { $refs.iframeElement.setAttribute('src', iframe_url()) });">
                <i class="text-white text-7xl uil uil-play-circle"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="u-ratio u-ratio--16by9 bg-black" x-show.transition.in.opacity.duration.500ms="isPlaying" x-cloak>
        <iframe x-ref="iframeElement" src="" class="object-cover u-ratio__item" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
</section>
<div class="px-4 sm:px-0 text-sm sm:text-base flex pt-5 justify-center item-center  text-black">
    <span>{{__('Created')}} {{$this->campaign->created_at->diffForHumans()}}</span>
    <span class="mx-2">|</span>
    <span>{{__($this->campaign->categoryCampaign->name)}}</span>
</div>

<script>
function videoFullWidth() {
return {
    isPlaying: false,
    embed_url: "https://www.youtube.com/embed/{{$video_url}}",
    iframe_param: "?autoplay=1&mute=1",
    iframe_url() {
    return this.embed_url + this.iframe_param;
    }
};
}
</script>
<style>
    
    .u-ratio {
        position: relative;
        width: 100%;
        padding: 0;
    }
    .u-ratio::before {
        display: block;
        content: "";
    }
    .u-ratio__item {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
    }
    .u-ratio--1by1::before {
        padding-top: 100%;
    }
    .u-ratio--4by3::before {
        padding-top: calc((3 / 4) * 100%);
    }
    .u-ratio--16by9::before {
        padding-top: calc((9 / 16) * 100%);
    }
    
</style>