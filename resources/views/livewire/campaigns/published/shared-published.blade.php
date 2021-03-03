<div class="flex mt-2 space-x-2">
    <button class="w-full text-center px-4 py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-base text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-bookmark"></i>
        {{__('Remind me')}}
    </button>
    <button  wire:click="shared" class="w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-base text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-share-alt"></i>
        {{__('Share')}}
    </button>
</div>


<div class="inline-block mr4">
    <a href="mailto:?subject=Coral%20Island%20%E2%80%94%20reimagining%20the%20farm%20sim%20game%20en%20Kickstarter&amp;body=http://kck.st/2L6P7hq" class="keyboard-focusable">
        <span class="hide">Correo</span>
    </a>
</div>
<a href="javascript:windowFacebook(1)">facebook</a>
<a href="javascript:windowTwitter(1)">twitter</a>
<script> 
    function windowTwitter (URL){ 
       window.open("https://twitter.com/intent/tweet?text={{$campaign->title}} https://www.yosolidario.com/{{$campaign->slug}}",
       "ventana1","width=720,height=500,scrollbars=NO") 
    } 
</script>
<script> 
    function windowFacebook(URL){ 
       window.open("https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fyosolidario.com%2F{{$campaign->slug}}%2F&src=sdkpreparse",
       "ventana1","width=720,height=500,scrollbars=NO") 
    } 
</script>
<x-dialog-modal wire:model="shared">
    <x-slot name="title">
        <div class="font-semibold text-2xl">
            {{ __('Help by sharing') }}
        </div>
        <div class="mt-2 text-sm sm:text-base">
            {{__('Fundraisers shared on social networks raise up to 5x more')}}
        </div>
    </x-slot>
    <x-slot name="content">
        <!-- twitter -->
        <script>window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        
            t._e = [];
            t.ready = function(f) {
            t._e.push(f);
            };
        
            return t;
        }(document, "script", "twitter-wjs"));</script>

            <a class="twitter-share-button"
            href="https://twitter.com/intent/tweet?text=Hello%20world"
            data-size="large">
            Tweet</a>
    </x-slot>
    <x-slot name="footer">
        
    </x-slot>
</x-dialog-modal>