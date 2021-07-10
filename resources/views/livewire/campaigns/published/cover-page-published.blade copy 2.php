<div 
class="max-w-4xl mx-auto relative"
x-data="{ activeSlide: 1, slides: [1, 2, 3, 4, 5] }"
>
<!-- Slides -->
<template x-for="slide in slides" :key="slide">
  <div
     x-show="activeSlide === slide"
     class="p-24 font-bold text-5xl h-64 flex items-center bg-red-500 text-white rounded-lg">
    <span class="w-12 text-center" x-text="slide"></span>
    <span class="text-red-300">/</span>
    <span class="w-12 text-center" x-text="slides.length"></span>
  </div>
</template>

<!-- Prev/Next Arrows -->
<div class="absolute inset-0 flex">
  <div class="flex items-center justify-start w-1/2">
    <button 
      class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow-lg rounded-full w-12 h-12 -ml-6"
      x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
      &#8592;
     </button>
  </div>
  <div class="flex items-center justify-end w-1/2">
    <button 
      class="bg-red-100 text-red-500 hover:text-orange-500 font-bold hover:shadow rounded-full w-12 h-12 -mr-6"
      x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
      &#8594;
    </button>
  </div>        
</div>

<!-- Buttons -->
<div class="absolute w-full flex items-center justify-center px-4">
  <template x-for="slide in slides" :key="slide">
    <button
      class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded-full overflow-hidden transition-colors duration-200 ease-out hover:bg-red-600 hover:shadow-lg"
      :class="{ 
          'bg-orange-600': activeSlide === slide,
          'bg-red-300': activeSlide !== slide 
      }" 
      x-on:click="activeSlide = slide"
    ></button>
  </template>
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
