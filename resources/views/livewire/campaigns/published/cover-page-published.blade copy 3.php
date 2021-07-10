<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<div class="min-w-screen min-h-screen bg-gray-200 flex items-center justify-center px-5 py-5">
  <div class="w-full max-w-6xl mx-auto rounded-xl bg-white shadow-lg p-5 text-black" x-data="app()" x-init="init($refs.wysiwyg)">
      <div class="border border-gray-200 overflow-hidden rounded-md">
          <div class="w-full flex border-b border-gray-200 text-xl text-gray-600">
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('bold')">
                  <i class="mdi mdi-format-bold"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('italic')">
                  <i class="mdi mdi-format-italic"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('underline')">
                  <i class="mdi mdi-format-underline"></i>
              </button>
              <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','P')">
                  <i class="mdi mdi-format-paragraph"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H1')">
                  <i class="mdi mdi-format-header-1"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H2')">
                  <i class="mdi mdi-format-header-2"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H3')">
                  <i class="mdi mdi-format-header-3"></i>
              </button>
              <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('insertUnorderedList')">
                  <i class="mdi mdi-format-list-bulleted"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('insertOrderedList')">
                  <i class="mdi mdi-format-list-numbered"></i>
              </button>
              <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyLeft')">
                  <i class="mdi mdi-format-align-left"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyCenter')">
                  <i class="mdi mdi-format-align-center"></i>
              </button>
              <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyRight')">
                  <i class="mdi mdi-format-align-right"></i>
              </button>
          </div>
          <div class="w-full">
              <iframe x-ref="wysiwyg" class="w-full h-96 overflow-y-auto"></iframe>
          </div>
      </div>
  </div>
</div>

<script>

function app() {
    return {
        wysiwyg: null,
        init: function(el) {
            // Get el
            this.wysiwyg = el;
            // Add CSS
            this.wysiwyg.contentDocument.querySelector('head').innerHTML += `<style>
            *, ::after, ::before {box-sizing: border-box;}
            :root {tab-size: 4;}
            html {line-height: 1.15;text-size-adjust: 100%;}
            body {margin: 0px; padding: 1rem 0.5rem;}
            body {font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";}
            </style>`;
            this.wysiwyg.contentDocument.body.innerHTML += `
            <h1>Hello World!</h1>
            <p>Welcome to the pure AlpineJS and Tailwind WYSIWYG.</p>
            `;
            // Make editable
            this.wysiwyg.contentDocument.designMode = "on";
        },
        format: function(cmd, param) {
            this.wysiwyg.contentDocument.execCommand(cmd, !1, param||null)
        }
    }
}
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
.active\:bg-gray-50:active {
  --tw-bg-opacity: 1;
  background-color: rgba(249, 250, 251, var(--tw-bg-opacity));
}
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
