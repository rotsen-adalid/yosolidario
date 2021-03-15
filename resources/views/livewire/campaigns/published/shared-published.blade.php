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
        <x-section-border />
        <table class="w-full my-3 sm:my-0">
            <tr>
                <td>
                    <a  href="javascript:windowFacebook('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                           @include('livewire.campaigns.published.svg.facebook')
                        </div>
                        <div class="mt-1 flex justify-center">Facebook</div>
                    </a>
                    
                </td>
                <td>
                    <a  href="javascript:windowTwitter('{{$campaign->title}}', '{{$campaign->slug}}')">
                        <div class="flex justify-center">
                            @include('livewire.campaigns.published.svg.twitter')
                        </div>
                        <div class="mt-1 flex justify-center">Twitter</div>
                    </a>
                    
                </td>
                <td>
                    <a  href="mailto:?subject={{$campaign->title}}  :  yosolidario.com&amp;body=https://www.yosolidario.com/{{$campaign->slug}}" class="keyboard-focusable">
                        <div class="flex justify-center">
                            @include('livewire.campaigns.published.svg.email')
                        </div>
                        <div class="mt-1 flex justify-center">Email</div>
                    </a>
                </td>
                <td>
                    <a  href="javascript:windowWhatsApp('{{$campaign->title}}', '{{$campaign->slug}}')">
                       <div class="flex justify-center">
                            @include('livewire.campaigns.published.svg.whatsapp')
                       </div>
                       <div class="mt-1 flex justify-center">WhatsApp</div>
                    </a>
                </td>
            </tr>
            <tr >
                <td >
                    <a  href="javascript:windowTelegram('{{$campaign->title}}', '{{$campaign->slug}}')">
                       <div class="mt-5 sm:mt-10 flex justify-center">
                            @include('livewire.campaigns.published.svg.telegram')
                       </div>
                       <div class="mt-1 flex justify-center">Telegram</div>
                    </a>
                </td>
                <td>
                    <div wire:click="emberHTML(1)" class="mt-5 sm:mt-10 cursor-pointer">
                        <div class="flex justify-center">
                            @include('livewire.campaigns.published.svg.embed')
                        </div>
                        <div class="mt-1 flex justify-center text-center">{{__('Embed HTML')}}</div>
                    </div>
                    
                </td>
                <td>
                    <div class="mt-5 sm:mt-10 cursor-pointer">
                        <div class="flex justify-center">
                            @include('livewire.campaigns.published.svg.print')
                        </div>
                        <div class="mt-1 flex justify-center text-center">{{__('Print Poster')}}</div>
                    </div>
                </td>
            </tr>
        </table>

        <x-section-border />
        <x-action-message class="mr-3" on="message">
            <div class="flex space-x-1 items-center">
                <svg class="h-4" viewBox="0 -21 512.00533 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m306.582031 317.25c-12.074219 12.097656-28.160156 18.753906-45.25 18.753906-17.085937 0-33.171875-6.65625-45.246093-18.753906l-90.667969-90.664062c-12.09375-12.078126-18.75-28.160157-18.75-45.25 0-17.089844 6.65625-33.171876 18.75-45.246094 12.074219-12.097656 28.160156-18.753906 45.25-18.753906 17.085937 0 33.171875 6.65625 45.246093 18.753906l45.417969 45.394531 125.378907-125.375c-40.960938-34.921875-93.996094-56.10546875-152.042969-56.10546875-129.601563 0-234.667969 105.06640575-234.667969 234.66406275 0 129.601562 105.066406 234.667969 234.667969 234.667969 129.597656 0 234.664062-105.066407 234.664062-234.667969 0-24.253907-3.6875-47.636719-10.515625-69.652344zm0 0" fill="#4caf50"/>
                    <path d="m261.332031 293.335938c-5.460937 0-10.921875-2.089844-15.082031-6.25l-90.664062-90.667969c-8.34375-8.339844-8.34375-21.824219 0-30.164063 8.339843-8.34375 21.820312-8.34375 30.164062 0l75.582031 75.582032 214.253907-214.25c8.339843-8.339844 21.820312-8.339844 30.164062 0 8.339844 8.34375 8.339844 21.824218 0 30.167968l-229.335938 229.332032c-4.15625 4.160156-9.621093 6.25-15.082031 6.25zm0 0" fill="#2196f3"/>
                </svg>
                <span class="text-ys1">
                    {{ __($message) }}
                </span>
            </div>
        </x-action-message>

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
                    <span class="ml-1">{{__('Medium')}}</span>
                </div>
                <div class="mt-4">
                    <input wire:model="widget" name="widget" type="radio" value="small" />
                    <span class="ml-1">{{__('Small')}}</span>
                </div>
                <x-section-border />
                <div class="w-full mt-3 sm:mt-0">
                    <x-label for="copyLarge" value="{{ __('Copy and paste the following embed code') }}" />
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
                <div class="text-center font-bold my-2 uppercase">{{__("Preview")}}</div>
                @if($widget == 'large')
                    <iframe src="{{ $host}}/{{$campaign->slug}}/widget/large/?iframe=true" height="420"></iframe>
                @elseif($widget == 'medium')
                    <iframe src="{{ $host}}/{{$campaign->slug}}/widget/medium/?iframe=true" height="245"></iframe>
                @elseif($widget == 'small')
                    <iframe src="{{ $host}}/{{$campaign->slug}}/widget/small/?iframe=true" height="60"></iframe>
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
    