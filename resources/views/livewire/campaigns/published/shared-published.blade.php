<div class="flex mt-2 space-x-2">
    <button class="w-full text-center px-4 py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-bookmark"></i>
        {{__('Remind me')}}
    </button>
    <button  wire:click="shared" class="w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
        <i class="text-black uil uil-share-alt"></i>
        {{__('Share')}}
    </button>
</div>

<x-dialog-modal wire:model="shared">
    <x-slot name="title">
        @if(!$embed)
            <div class="font-bold text-2xl">
                {{ __('Help by sharing') }}
            </div>
        @else
            <div class="flex items-center space-x-2">
                <div wire:click="emberHTML(0)" class="flex spacex-1 px-2 py-1 bg-red-50 items-center w-20 cursor-pointer rounded-sm">
                    <svg class="h-4" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 443.52 443.52" style="enable-background:new 0 0 443.52 443.52;" xml:space="preserve">
                        <g><g>
                        <path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8
                            c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712
                            L143.492,221.863z"/>
                        </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                    </svg>
                    <span>{{__('back')}}</span>
                </div>
                <div class="font-bold text-2xl">{{__('Ember HTML')}}</div>
            </div>
        @endif
    </x-slot>
    <x-slot name="content">
        @if(!$embed)
        <div class="mt-2 text-sm sm:text-base">
            {{__('Fundraisers shared on social networks raise up to 5x more')}}
        </div>
        <x-jet-section-border />
        <table class="w-full my-3 sm:my-0">
            <tr>
                <td>
                    <a  href="javascript:windowFacebook('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            <svg class="h-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
                            <g>
                            <circle style="fill:#3B5998;" cx="56.098" cy="56.098" r="56.098"/>
                            <path style="fill:#FFFFFF;" d="M70.201,58.294h-10.01v36.672H45.025V58.294h-7.213V45.406h7.213v-8.34
                                c0-5.964,2.833-15.303,15.301-15.303L71.56,21.81v12.51h-8.151c-1.337,0-3.217,0.668-3.217,3.513v7.585h11.334L70.201,58.294z"/>
                            </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                        </div>
                        <div class="mt-1 flex justify-center">Facebook</div>
                    </a>
                    
                </td>
                <td>
                    <a  href="javascript:windowTwitter('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
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
                        </div>
                        <div class="mt-1 flex justify-center">Twitter</div>
                    </a>
                    
                </td>
                <td>
                    <a  href="mailto:?subject={{$campaign->title}}  :  yosolidario.com&amp;body=https://www.yosolidario.com/{{$campaign->slug}}" class="keyboard-focusable">
                        <div class="flex justify-center">
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
                        </div>
                        <div class="mt-1 flex justify-center">Email</div>
                    </a>
                </td>
                <td>
                    <a  href="javascript:windowWhatsApp('{{$campaign->title}}', '{{$campaign->slug}}')">
                       <div class="flex justify-center">
                            <svg  class="h-10" viewBox="-1 0 512 512"  xmlns="http://www.w3.org/2000/svg"><path d="m10.894531 512c-2.875 0-5.671875-1.136719-7.746093-3.234375-2.734376-2.765625-3.789063-6.78125-2.761719-10.535156l33.285156-121.546875c-20.722656-37.472656-31.648437-79.863282-31.632813-122.894532.058594-139.941406 113.941407-253.789062 253.871094-253.789062 67.871094.0273438 131.644532 26.464844 179.578125 74.433594 47.925781 47.972656 74.308594 111.742187 74.289063 179.558594-.0625 139.945312-113.945313 253.800781-253.867188 253.800781 0 0-.105468 0-.109375 0-40.871093-.015625-81.390625-9.976563-117.46875-28.84375l-124.675781 32.695312c-.914062.238281-1.84375.355469-2.761719.355469zm0 0" fill="#e5e5e5"/>
                                <path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0" fill="#fff"/>
                                <path d="m19.34375 492.625 33.277344-121.519531c-20.53125-35.5625-31.324219-75.910157-31.3125-117.234375.050781-129.296875 105.273437-234.488282 234.558594-234.488282 62.75.027344 121.644531 24.449219 165.921874 68.773438 44.289063 44.324219 68.664063 103.242188 68.640626 165.898438-.054688 129.300781-105.28125 234.503906-234.550782 234.503906-.011718 0 .003906 0 0 0h-.105468c-39.253907-.015625-77.828126-9.867188-112.085938-28.539063zm0 0" fill="#64b161"/><g fill="#fff">
                                <path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0"/><path d="m195.183594 152.246094c-4.546875-10.109375-9.335938-10.3125-13.664063-10.488282-3.539062-.152343-7.589843-.144531-11.632812-.144531-4.046875 0-10.625 1.523438-16.1875 7.597657-5.566407 6.074218-21.253907 20.761718-21.253907 50.632812 0 29.875 21.757813 58.738281 24.792969 62.792969 3.035157 4.050781 42 67.308593 103.707031 91.644531 51.285157 20.226562 61.71875 16.203125 72.851563 15.191406 11.132813-1.011718 35.917969-14.6875 40.976563-28.863281 5.0625-14.175781 5.0625-26.324219 3.542968-28.867187-1.519531-2.527344-5.566406-4.046876-11.636718-7.082032-6.070313-3.035156-35.917969-17.726562-41.484376-19.75-5.566406-2.027344-9.613281-3.035156-13.660156 3.042969-4.050781 6.070313-15.675781 19.742187-19.21875 23.789063-3.542968 4.058593-7.085937 4.566406-13.15625 1.527343-6.070312-3.042969-25.625-9.449219-48.820312-30.132812-18.046875-16.089844-30.234375-35.964844-33.777344-42.042969-3.539062-6.070312-.058594-9.070312 2.667969-12.386719 4.910156-5.972656 13.148437-16.710937 15.171875-20.757812 2.023437-4.054688 1.011718-7.597657-.503906-10.636719-1.519532-3.035156-13.320313-33.058594-18.714844-45.066406zm0 0" fill-rule="evenodd"/></g>
                            </svg>
                       </div>
                       <div class="mt-1 flex justify-center">WhatsApp</div>
                    </a>
                </td>
            </tr>
            <tr >
                <td >
                    <a  href="javascript:windowTelegram('{{$campaign->title}}', '{{$campaign->slug}}')">
                       <div class="mt-5 sm:mt-10 flex justify-center">
                            <svg class="h-10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" fill="#039be5" r="12"/><path d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z" fill="#fff"/>
                            </svg>
                       </div>
                       <div class="mt-1 flex justify-center">Telegram</div>
                    </a>
                </td>
                <td>
                    <div wire:click="emberHTML(1)" class="mt-5 sm:mt-10 cursor-pointer">
                        <div class="flex justify-center">
                            <svg  class="h-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 550.801 550.801" style="enable-background:new 0 0 550.801 550.801;"
                            xml:space="preserve">
                            <g><g>
                           <path d="M475.095,131.986c-0.032-2.525-0.844-5.015-2.568-6.992L366.324,3.684c-0.021-0.029-0.053-0.045-0.084-0.071
                               c-0.633-0.712-1.36-1.289-2.141-1.803c-0.232-0.15-0.465-0.29-0.707-0.422c-0.686-0.372-1.393-0.669-2.131-0.891
                               c-0.2-0.058-0.379-0.145-0.59-0.188C359.87,0.114,359.037,0,358.203,0H97.2C85.292,0,75.6,9.688,75.6,21.601v507.6
                               c0,11.907,9.692,21.601,21.6,21.601H453.6c11.908,0,21.601-9.693,21.601-21.601V133.197
                               C475.2,132.791,475.137,132.393,475.095,131.986z M97.2,21.601h250.203v110.51c0,5.962,4.831,10.8,10.8,10.8H453.6l0.011,223.837
                               H97.2V21.601z M180.457,499.311h-21.642v-41.26h-35.744v41.26h-21.769v-98.613h21.769v37.895h35.744v-37.895h21.642V499.311z
                                M265.874,419.429h-26.188v79.882h-21.779v-79.882h-25.763v-18.731h73.73V419.429z M359.416,499.311l-1.424-37.747
                               c-0.422-11.85-0.854-26.188-0.854-40.532h-0.422c-2.996,12.583-6.982,26.631-10.685,38.19l-11.665,38.476H317.43l-10.252-38.18
                               c-3.133-11.56-6.412-25.608-8.69-38.486h-0.285c-0.564,13.321-1.002,28.535-1.692,40.827l-1.72,37.457h-20.07l6.117-98.613h28.903
                               l9.397,32.917c2.995,11.412,5.975,23.704,8.121,35.264h0.422c2.711-11.417,5.975-24.427,9.112-35.406l10.252-32.774h28.329
                               l5.263,98.613h-21.221V499.311z M457.238,499.311h-59.938v-98.613h21.779v79.882h38.153v18.731H457.238z"/>
                            <polygon points="154.132,249.086 236.872,287.523 236.872,269.254 174.295,241.851 174.295,241.505 236.872,214.094 
                                236.872,195.827 154.132,234.262 		"/>
                            <polygon points="249.642,294.416 267.047,294.416 303.93,169.452 286.527,169.452 		"/>
                            <polygon points="313.938,214.094 377.895,241.505 377.895,241.851 313.938,269.254 313.938,287.523 396.668,249.605 
                                396.668,233.745 313.938,195.827 		"/>
                                </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>
                        </div>
                        <div class="mt-1 flex justify-center text-center">{{__('Embed HTML')}}</div>
                    </div>
                    
                </td>
                <td>
                    <div class="mt-5 sm:mt-10 cursor-pointer">
                        <div class="flex justify-center">
                            <svg class="h-10" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m437 129h-14v-54c0-41.355-33.645-75-75-75h-184c-41.355 0-75 33.645-75 75v54h-14c-41.355 0-75 33.645-75 75v120c0 41.355 33.645 75 75 75h14v68c0 24.813 20.187 45 45 45h244c24.813 0 45-20.187 45-45v-68h14c41.355 0 75-33.645 75-75v-120c0-41.355-33.645-75-75-75zm-318-54c0-24.813 20.187-45 45-45h184c24.813 0 45 20.187 45 45v54h-274zm274 392c0 8.271-6.729 15-15 15h-244c-8.271 0-15-6.729-15-15v-148h274zm89-143c0 24.813-20.187 45-45 45h-14v-50h9c8.284 0 15-6.716 15-15s-6.716-15-15-15h-352c-8.284 0-15 6.716-15 15s6.716 15 15 15h9v50h-14c-24.813 0-45-20.187-45-45v-120c0-24.813 20.187-45 45-45h362c24.813 0 45 20.187 45 45z"/><path d="m296 353h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m296 417h-80c-8.284 0-15 6.716-15 15s6.716 15 15 15h80c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/><path d="m128 193h-48c-8.284 0-15 6.716-15 15s6.716 15 15 15h48c8.284 0 15-6.716 15-15s-6.716-15-15-15z"/></g></svg>
                        </div>
                        <div class="mt-1 flex justify-center text-center">{{__('Print Poster')}}</div>
                    </div>
                </td>
            </tr>
        </table>

        <x-jet-section-border />
        <x-jet-action-message class="mr-3" on="message">
            <div class="flex space-x-1 items-center">
                <svg class="h-4" viewBox="0 -21 512.00533 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m306.582031 317.25c-12.074219 12.097656-28.160156 18.753906-45.25 18.753906-17.085937 0-33.171875-6.65625-45.246093-18.753906l-90.667969-90.664062c-12.09375-12.078126-18.75-28.160157-18.75-45.25 0-17.089844 6.65625-33.171876 18.75-45.246094 12.074219-12.097656 28.160156-18.753906 45.25-18.753906 17.085937 0 33.171875 6.65625 45.246093 18.753906l45.417969 45.394531 125.378907-125.375c-40.960938-34.921875-93.996094-56.10546875-152.042969-56.10546875-129.601563 0-234.667969 105.06640575-234.667969 234.66406275 0 129.601562 105.066406 234.667969 234.667969 234.667969 129.597656 0 234.664062-105.066407 234.664062-234.667969 0-24.253907-3.6875-47.636719-10.515625-69.652344zm0 0" fill="#4caf50"/>
                    <path d="m261.332031 293.335938c-5.460937 0-10.921875-2.089844-15.082031-6.25l-90.664062-90.667969c-8.34375-8.339844-8.34375-21.824219 0-30.164063 8.339843-8.34375 21.820312-8.34375 30.164062 0l75.582031 75.582032 214.253907-214.25c8.339843-8.339844 21.820312-8.339844 30.164062 0 8.339844 8.34375 8.339844 21.824218 0 30.167968l-229.335938 229.332032c-4.15625 4.160156-9.621093 6.25-15.082031 6.25zm0 0" fill="#2196f3"/>
                </svg>
                <span class="text-ys1">
                    {{ __($message) }}
                </span>
            </div>
        </x-jet-action-message>

        <p id="p1" class="border p-2">https://yosolidario.com/{{$campaign->slug}}</p>
        <button wire:click="messageCopy" class="mt-2 px-4 py-2 text-center border bg-ys1 rounded-md font-bold text-base  
        text-white tracking-widest hover:text-white hover:bg-ys2 focus:border-bg-ys2 active:bg-ys2 
        focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition 
        ease-in-out duration-150" onclick="copyToClipboard('p1')">
            {{__('Copy link')}}
        </button>
           
        <div wire:click="messageCopy" class="mt-3 bg-red-50 p-3 cursor-pointer rounded-sm" onclick="copyToClipboard('p1')">
            <div class="flex justify-center space-x-1">
                <span class="font-bold">{{__('Tip')}} </span>
                <span>{{__('Paste this fundraiser link anywhere')}}</span>
            </div>
            <div class="flex justify-center items-center mt-1 space-x-2">
                <svg class="h-8"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <linearGradient id="SVGID_1_" gradientTransform="matrix(0 -1.982 -1.844 0 -132.522 -51.077)" gradientUnits="userSpaceOnUse" x1="-37.106" x2="-26.555" y1="-72.705" y2="-84.047">
                        <stop offset="0" stop-color="#fd5"/><stop offset=".5" stop-color="#ff543e"/><stop offset="1" stop-color="#c837ab"/></linearGradient>
                        <path d="m1.5 1.633c-1.886 1.959-1.5 4.04-1.5 10.362 0 5.25-.916 10.513 3.878 11.752 1.497.385 14.761.385 16.256-.002 1.996-.515 3.62-2.134 3.842-4.957.031-.394.031-13.185-.001-13.587-.236-3.007-2.087-4.74-4.526-5.091-.559-.081-.671-.105-3.539-.11-10.173.005-12.403-.448-14.41 1.633z" fill="url(#SVGID_1_)"/>
                        <path d="m11.998 3.139c-3.631 0-7.079-.323-8.396 3.057-.544 1.396-.465 3.209-.465 5.805 0 2.278-.073 4.419.465 5.804 1.314 3.382 4.79 3.058 8.394 3.058 3.477 0 7.062.362 8.395-3.058.545-1.41.465-3.196.465-5.804 0-3.462.191-5.697-1.488-7.375-1.7-1.7-3.999-1.487-7.374-1.487zm-.794 1.597c7.574-.012 8.538-.854 8.006 10.843-.189 4.137-3.339 3.683-7.211 3.683-7.06 0-7.263-.202-7.263-7.265 0-7.145.56-7.257 6.468-7.263zm5.524 1.471c-.587 0-1.063.476-1.063 1.063s.476 1.063 1.063 1.063 1.063-.476 1.063-1.063-.476-1.063-1.063-1.063zm-4.73 1.243c-2.513 0-4.55 2.038-4.55 4.551s2.037 4.55 4.55 4.55 4.549-2.037 4.549-4.55-2.036-4.551-4.549-4.551zm0 1.597c3.905 0 3.91 5.908 0 5.908-3.904 0-3.91-5.908 0-5.908z" fill="#fff"/>
                </svg>
                <svg class="h-9" viewBox="0 -77 512.00213 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m501.453125 56.09375c-5.902344-21.933594-23.195313-39.222656-45.125-45.128906-40.066406-10.964844-200.332031-10.964844-200.332031-10.964844s-160.261719 0-200.328125 10.546875c-21.507813 5.902344-39.222657 23.617187-45.125 45.546875-10.542969 40.0625-10.542969 123.148438-10.542969 123.148438s0 83.503906 10.542969 123.148437c5.90625 21.929687 23.195312 39.222656 45.128906 45.128906 40.484375 10.964844 200.328125 10.964844 200.328125 10.964844s160.261719 0 200.328125-10.546875c21.933594-5.902344 39.222656-23.195312 45.128906-45.125 10.542969-40.066406 10.542969-123.148438 10.542969-123.148438s.421875-83.507812-10.546875-123.570312zm0 0" fill="#f00"/>
                    <path d="m204.96875 256 133.269531-76.757812-133.269531-76.757813zm0 0" fill="#fff"/>
                </svg>
                <svg class="h-8" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g fill="#f00044">
                    <path d="m182.1 265.4c-40.6 0-73.4 32.8-72.8 73 .4 25.8 14.6 48.2 35.5 60.7-7.1-10.9-11.3-23.8-11.5-37.7-.6-40.2 32.2-73 72.8-73 8 0 15.7 1.3 22.9 3.6v-80.5c-7.5-1.1-15.2-1.7-22.9-1.7-.4 0-.7 0-1.1 0v59.2c-7.2-2.3-14.9-3.6-22.9-3.6z"/><path d="m357.6 24h-.6-20.8c6 30.1 22.9 56.3 46.5 74.1-15.5-20.5-24.9-46.1-25.1-74.1z"/>
                    <path d="m480 146.5c-7.9 0-15.5-.8-23-2.2v57.7c-27.2 0-53.6-5.3-78.4-15.9-16-6.8-30.9-15.5-44.6-26l.4 177.9c-.2 40-16 77.5-44.6 105.8-23.3 23-52.8 37.7-84.8 42.4-7.5 1.1-15.2 1.7-22.9 1.7-34.2 0-66.8-11.1-93.3-31.6 3 3.6 6.2 7.1 9.7 10.5 28.8 28.4 67 44.1 107.7 44.1 7.7 0 15.4-.6 22.9-1.7 32-4.7 61.5-19.4 84.8-42.4 28.6-28.3 44.4-65.8 44.6-105.8l-1.5-177.9c13.6 10.5 28.5 19.3 44.6 26 24.9 10.5 51.3 15.9 78.4 15.9"/></g><path d="m98.2 254.1c28.5-28.3 66.4-44 106.8-44.3v-21.3c-7.5-1.1-15.2-1.7-22.9-1.7-40.8 0-79.1 15.7-107.9 44.3-28.3 28.1-44.5 66.5-44.4 106.4 0 40.2 15.9 77.9 44.6 106.4 4.6 4.5 9.3 8.7 14.3 12.5-22.6-26.9-34.9-60.5-35-95.9.1-39.9 16.2-78.3 44.5-106.4z" fill="#08fff9"/>
                    <path d="m457 144.3v-21.4h-.2c-27.8 0-53.4-9.2-74-24.8 17.9 23.6 44.1 40.4 74.2 46.2z" fill="#08fff9"/><path d="m202 432.2c9.5.5 18.6-.8 27-3.5 29-9.5 49.9-36.5 49.9-68.3l.1-119v-217.4h57.2c-1.5-7.5-2.3-15.1-2.4-23h-78.8v217.3l-.1 119c0 31.8-20.9 58.8-49.9 68.3-8.4 2.8-17.5 4.1-27 3.5-12.1-.7-23.4-4.3-33.2-10.1 12.3 19 33.3 31.9 57.2 33.2z" fill="#08fff9"/><path d="m205 486.2c32-4.7 61.5-19.4 84.8-42.4 28.6-28.3 44.4-65.8 44.6-105.8l-.4-177.9c13.6 10.5 28.5 19.3 44.6 26 24.9 10.5 51.3 15.9 78.4 15.9v-57.7c-30.1-5.8-56.3-22.6-74.2-46.2-23.6-17.8-40.6-44-46.5-74.1h-57.3v217.3l-.1 119c0 31.8-20.9 58.8-49.9 68.3-8.4 2.8-17.5 4.1-27 3.5-24-1.3-44.9-14.2-57.2-33.1-20.9-12.4-35.1-34.9-35.5-60.7-.6-40.2 32.2-73 72.8-73 8 0 15.7 1.3 22.9 3.6v-59.2c-40.4.3-78.3 16-106.8 44.3-28.3 28.1-44.5 66.5-44.4 106.3 0 35.4 12.3 69 35 95.9 26.6 20.5 59.1 31.6 93.3 31.6 7.7.1 15.4-.5 22.9-1.6z"/></g>
                </svg>
                <svg class="h-8" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 382 382" style="enable-background:new 0 0 382 382;" xml:space="preserve">
                    <path style="fill:#0077B7;" d="M347.445,0H34.555C15.471,0,0,15.471,0,34.555v312.889C0,366.529,15.471,382,34.555,382h312.889
                        C366.529,382,382,366.529,382,347.444V34.555C382,15.471,366.529,0,347.445,0z M118.207,329.844c0,5.554-4.502,10.056-10.056,10.056
                        H65.345c-5.554,0-10.056-4.502-10.056-10.056V150.403c0-5.554,4.502-10.056,10.056-10.056h42.806
                        c5.554,0,10.056,4.502,10.056,10.056V329.844z M86.748,123.432c-22.459,0-40.666-18.207-40.666-40.666S64.289,42.1,86.748,42.1
                        s40.666,18.207,40.666,40.666S109.208,123.432,86.748,123.432z M341.91,330.654c0,5.106-4.14,9.246-9.246,9.246H286.73
                        c-5.106,0-9.246-4.14-9.246-9.246v-84.168c0-12.556,3.683-55.021-32.813-55.021c-28.309,0-34.051,29.066-35.204,42.11v97.079
                        c0,5.106-4.139,9.246-9.246,9.246h-44.426c-5.106,0-9.246-4.14-9.246-9.246V149.593c0-5.106,4.14-9.246,9.246-9.246h44.426
                        c5.106,0,9.246,4.14,9.246,9.246v15.655c10.497-15.753,26.097-27.912,59.312-27.912c73.552,0,73.131,68.716,73.131,106.472
                        L341.91,330.654L341.91,330.654z"/>
                    <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
                <svg class="h-8" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667;" xml:space="preserve">
                    <g><g><circle cx="42.667" cy="213.333" r="42.667"/></g></g><g><g><circle cx="213.333" cy="213.333" r="42.667"/></g></g><g><g><circle cx="384" cy="213.333" r="42.667"/></g>
                    </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
            </div>
        </div>

        <!-- embed html -->
        @else 
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-3">
            <div class="py-3 w-full">
                <div>
                    <input wire:model="widget" name="widget" type="radio" value="large" />
                    <span class="ml-1"> {{__('Large')}}</span>
                </div>
                <div class="mt-4">
                    <input wire:model="widget" name="widget" type="radio" value="medium" />
                    <span class="ml-1">{{__('medium')}}</span>
                </div>
                <div class="mt-4">
                    <input wire:model="widget" name="widget" type="radio" value="small" />
                    <span class="ml-1">{{__('small')}}</span>
                </div>
                <x-jet-section-border />
                <div class="w-full mt-3 sm:mt-0">
                    <x-jet-label for="copyLarge" value="{{ __('Copy and paste the following embed code') }}" />
                    @if($widget == 'large')
                        <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copyLarge"/>
                    @elseif($widget == 'medium')
                        <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copyMedium"/>
                    @elseif($widget == 'small')
                        <x-textarea class="mt-1 block w-full"  rows="5" wire:model.defer="copySmall"/>
                    @endif
                </div>
            </div>
            <div class="">
                <div class="text-center font-bold my-2">{{__("PREVIEW")}}</div>
                @if($widget == 'large')
                    <iframe src="{{ $host}}{{$campaign->slug}}/widget/large/?iframe=true" height="420"></iframe>
                @elseif($widget == 'medium')
                    <iframe src="{{ $host}}{{$campaign->slug}}/widget/medium/?iframe=true" height="245"></iframe>
                @elseif($widget == 'small')
                    <iframe src="{{ $host}}{{$campaign->slug}}/widget/small/?iframe=true" height="60"></iframe>
                @endif
            </div>
        </div>
        @endif
        <script> 
            var myWidth = 1050;
            var myHeight = 550;
            var left = (screen.width - myWidth) / 2;
            var top = (screen.height - myHeight) / 4;

            function windowTwitter (title, slug){ 
                var myURL = "https://twitter.com/intent/tweet?text="+title+" https://www.yosolidario.com/"+slug+"";
                windowOpen(myURL, title);
            }
            function windowFacebook(title, slug){ 
                var myURL = "https://www.facebook.com/sharer/sharer.php?u=https://www.yosolidario.com/"+slug+"&src=sdkpreparse";
                windowOpen(myURL, title);
            } 
            function windowWhatsApp(title, slug){ 
                var myURL = "https://wa.me/?text=https://www.yosolidario.com/"+slug+"";
                windowOpen(myURL, title);
            }
            function windowTelegram(title, slug){ 
                var myURL = "https://t.me/share/url?url=https://www.yosolidario.com/"+slug+"&text="+title+"";
                windowOpen(myURL, title);
            }
            function windowOpen(myURL, title) {
                var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
            } 
            function copyToClipboard(id_element) {
                var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById(id_element).innerHTML);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");
                document.body.removeChild(aux);
            }
        </script>
    </x-slot>
    <x-slot name="footer">
        
    </x-slot>
</x-dialog-modal>
    