<div x-data="videoFullWidth()">
  <div class="flex items-center justify-center u-ratio1 u-ratio1--16by9">
    
    @if ($this->campaign->video)
    <img src="{{ URL::to('/').$this->campaign->image->url}}" alt="{{$this->campaign->title}}" 
    class="bg-opacity-70 object-cover u-ratio1__item">
    <div class="fb-video u-ratio1__item" data-href="https://www.facebook.com/video.php?v={{$video_url}}" data-allowfullscreen="false" data-autoplay="true" data-show-captions="false" data-lazy="false">
    </div>

    @elseif ($this->campaign->image)
      <img src="{{URL::to('/').$this->campaign->image->url}}" alt="placeholder image" class="object-cover u-ratio1__item">
    @endif
  </div>
  
  <div class="hidden sm:block px-4 sm:px-0 text-sm sm:text-base sm:flex pt-5 justify-center item-center text-black">
    @if ($this->campaign->campaignOpeningRequest)
      <div>{{__('Created')}}
        {{ \Carbon\Carbon::parse($this->campaign->campaignOpeningRequest->date_revised)->diffForHumans() }}
      </div>
      <span class="mr-2 sm:mx-4 text-gray-400">|</span>    
    @endif
    <!-- <span class="material-icons-outlined text-gray-600 text-base">loyalty</span> -->
    <span class="ml-0">
      {{__($this->campaign->categoryCampaign->name)}}
    </span>
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

<style type="text/css">
  .u-ratio1 {
    position: relative;
    width: 100%;
    padding: 0;
  }
  .u-ratio1::before {
      display: block;
      content: "";
  }
  .u-ratio1__item {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
  }
  .u-ratio1__item1 {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
  }
  .u-ratio1--1by1::before {
      padding-top: 100%;
  }
  .u-ratio1--4by3::before {
      padding-top: calc((3 / 4) * 100%);
  }
  .u-ratio1--16by9::before {
      padding-top: calc((9 / 16) * 100%);
  }

</style>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '738141669970459',
      xfbml      : true,
      version    : 'v3.2'
    });
  
    // Get Embedded Video Player API Instance
    var my_video_player;
    FB.Event.subscribe('xfbml.ready', function(msg) {
      if (msg.type === 'video') {
        my_video_player = msg.instance;
      }
    });
  };
</script>
<div id="fb-root"></div>
