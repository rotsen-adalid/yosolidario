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
        <x-jet-section-border />
        <div class="flex space-x-5 justify-center items-center">
        <a href="javascript:windowFacebook(1)">
            <svg class="h-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
                <g>
                <circle style="fill:#3B5998;" cx="56.098" cy="56.098" r="56.098"/>
                <path style="fill:#FFFFFF;" d="M70.201,58.294h-10.01v36.672H45.025V58.294h-7.213V45.406h7.213v-8.34
                    c0-5.964,2.833-15.303,15.301-15.303L71.56,21.81v12.51h-8.151c-1.337,0-3.217,0.668-3.217,3.513v7.585h11.334L70.201,58.294z"/>
                </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
        </a>
        <a href="javascript:windowTwitter(1)">
            <svg class="h-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <path style="fill:#03A9F4;" d="M512,97.248c-19.04,8.352-39.328,13.888-60.48,16.576c21.76-12.992,38.368-33.408,46.176-58.016
                    c-20.288,12.096-42.688,20.64-66.56,25.408C411.872,60.704,384.416,48,354.464,48c-58.112,0-104.896,47.168-104.896,104.992
                    c0,8.32,0.704,16.32,2.432,23.936c-87.264-4.256-164.48-46.08-216.352-109.792c-9.056,15.712-14.368,33.696-14.368,53.056
                    c0,36.352,18.72,68.576,46.624,87.232c-16.864-0.32-33.408-5.216-47.424-12.928c0,0.32,0,0.736,0,1.152
                    c0,51.008,36.384,93.376,84.096,103.136c-8.544,2.336-17.856,3.456-27.52,3.456c-6.72,0-13.504-0.384-19.872-1.792
                    c13.6,41.568,52.192,72.128,98.08,73.12c-35.712,27.936-81.056,44.768-130.144,44.768c-8.608,0-16.864-0.384-25.12-1.44
                    C46.496,446.88,101.6,464,161.024,464c193.152,0,298.752-160,298.752-298.688c0-4.64-0.16-9.12-0.384-13.568
                    C480.224,136.96,497.728,118.496,512,97.248z"/>
                <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
        </a>
        <a href="mailto:?subject={{$campaign->title}}  :  yosolidario.com&amp;body=https://www.yosolidario.com/{{$campaign->slug}}" class="keyboard-focusable">
            <svg class="h-10" id="Capa_1" enable-background="new 0 0 497 497" viewBox="0 0 497 497" xmlns="http://www.w3.org/2000/svg"><g>
                <path d="m223.453 86.813-195.826 157.27 224.453 217.44 217.294-217.44-195.827-157.27c-14.631-11.751-35.463-11.751-50.094 0z" fill="#e9edf1"/>
                <path d="m400 425h-303c-11.598 0-12.351-16.402-12.351-28l-.766-365.33c0-11.598 1.519-31.67 13.117-31.67h303c11.598 0 21 9.402 21 21v226.27l-39.574 128.315c0 11.598 30.172 49.415 18.574 49.415z" fill="#f7e365"/>
                <path d="m310.619 340.765c-2.238 1.896-5.519 1.895-7.757-.001l-16.232-13.754c-10.64-9.01-24.18-13.98-38.13-13.98s-27.49 4.97-38.13 13.98l-16.232 13.754c-2.238 1.896-5.519 1.897-7.757.001l-89.259-75.604c-1.346-1.14-2.122-2.815-2.122-4.578v-239.583c0-11.6 9.4-21 21-21h-19c-11.598 0-21 9.402-21 21v226.27 156.73c0 11.598 9.402 21 21 21h19 284c11.598 0 21-9.402 21-21v-156.73z" fill="#f4d242"/>
                <path d="m469.373 244.083c-9.823 0-19.328 3.484-26.824 9.833l-120.332 101.921-32.547 47.578c-17.074 14.461-61.82 11.142-78.894-3.319l-35.994-44.259-120.332-101.921c-7.496-6.349-6.25-8.415-16.074-8.415l-4.376-.577-2.713 236.354c0 6.32 5.124 11.444 11.444 11.444l411.364-.456c6.32 0 15.278-.39 15.278-6.71z" fill="#f7f9fa"/>
                <path d="m469.37 480.48v5.08c0 6.32-5.12 11.44-11.44 11.44h-418.86c-6.32 0-11.44-5.12-11.44-11.44v-5.08l147.15-124.64 44.13 37.38c17.08 14.46 42.1 14.46 59.18 0l44.13-37.38z" fill="#e9edf1"/>
                <path d="m222.647 341.512-183.576 155.488 193.408-10 225.451 10-183.577-155.488c-14.919-12.637-36.787-12.637-51.706 0z" fill="#f7f9fa"/><path d="m457.93 497-23.61-20" fill="#e9edf1"/><g><g><path d="m309.269 68.5h-121.538c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h121.537c4.143 0 7.5 3.357 7.5 7.5s-3.357 7.5-7.499 7.5z" fill="#f4d242"/></g><g>
                <path d="m373.926 131.394h-234.676c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h234.676c4.143 0 7.5 3.357 7.5 7.5s-3.358 7.5-7.5 7.5z" fill="#f4d242"/></g><g><path d="m373.926 161.394h-250.852c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h250.852c4.143 0 7.5 3.357 7.5 7.5s-3.358 7.5-7.5 7.5z" fill="#f4d242"/></g><g><path d="m357.75 191.394h-234.676c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h234.676c4.143 0 7.5 3.357 7.5 7.5s-3.357 7.5-7.5 7.5z" fill="#f4d242"/></g><g>
                <path d="m373.926 221.394h-179.235c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h179.234c4.143 0 7.5 3.357 7.5 7.5s-3.357 7.5-7.499 7.5z" fill="#f4d242"/></g><g><path d="m164.691 221.394h-41.617c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h41.617c4.143 0 7.5 3.357 7.5 7.5s-3.357 7.5-7.5 7.5z" fill="#f4d242"/></g><g><path d="m373.926 269.511h-64.657c-4.143 0-7.5-3.357-7.5-7.5s3.357-7.5 7.5-7.5h64.657c4.143 0 7.5 3.357 7.5 7.5s-3.358 7.5-7.5 7.5z" fill="#f4d242"/></g></g>
                <path d="m469.37 477v8.56c0 6.32-5.12 11.44-11.44 11.44h-418.86c-6.32 0-11.44-5.12-11.44-11.44v-241.48c7.04 0 13.91 1.79 20 5.15v227.77z" fill="#e9edf1"/></g>
            </svg>
        </a>
        </div>
        <x-jet-section-border />
        <script> 
            function windowTwitter (URL){ 
               window.open("https://twitter.com/intent/tweet?text={{$campaign->title}} https://www.yosolidario.com/{{$campaign->slug}}",
               "ventana1","width=720,height=500,scrollbars=NO") 
            } 
        </script>
        <script> 
            function windowFacebook(URL){ 
               window.open("https://www.facebook.com/sharer/sharer.php?u=https://www.yosolidario.com/{{$campaign->slug}}&src=sdkpreparse",
               "ventana2","width=720,height=500,scrollbars=NO") 
            } 
        </script>
    </x-slot>
    <x-slot name="footer">
        
    </x-slot>
</x-dialog-modal>