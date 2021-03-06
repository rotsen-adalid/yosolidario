<x-slot name="title">
    {{$this->organization->name}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    @if($this->organization->organizationProfile)
        <!-- facebook -->
        <meta property="og:url"        content="https://www.yosolidario.com/org/{{$this->organization->slug}}" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="{{$this->organization->name}}" />
        <meta property="og:description"  content="{{$this->organization->organizationProfile->about}}" />
        <meta property="og:image"      content="https://yosolidario.com{{$this->organization->logo_path}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$this->organization->name}}">
        <meta name="twitter:creator" content="{{'@'.$this->organization->organizationProfile->twitter}}">
        <meta name="twitter:description" content="{{$this->organization->organizationProfile->about}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$this->organization->logo_path}}">
    @endif
</x-slot>
<x-slot name="header">
    
</x-slot>
<x-slot  name="menu">
    @livewire('menu.navigation-organization', ['organization' => $this->organization])
</x-slot>
      
<div class="mt-20 py-10 sm:py-12 " style="background-color:#ffffff">
    @livewire('organization.profile.shared-profile-organization')
    <div class="max-w-5xl mx-auto px-4 sm:px-2 mt-0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-10 rounded-lg sm:pt-2">
            <div class="lg:col-span-2"> <!-- sm:w-64 sm:h-64 -->
                @if($this->organization->logo_path)
                    <img class="h-48 w-48 sm:w-64 sm:h-64  mx-auto rounded-full object-cover object-center" 
                    src="{{$host}}{{ $this->organization->logo_path }}" alt="Workflow">
                @endif
            </div>
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 text-center">
                    {{$this->organization->name}}
                </h2>
                <p class="mt-0 text-xs font-bold text-gray-900 uppercase text-center">
                    @if ($this->organization->type == "FOUNDATION")
                        <span>{{__('Foundation')}}</span>
                    @elseif ($this->organization->type == "COMPANY")
                        <span>{{__('Company')}}</span>
                    @elseif ($this->organization->type == "ONG")
                        <span>{{__('ONG')}}</span>
                    @elseif ($this->organization->type == "SOCIAL_ORGANIZATION")
                        <span>{{__('Social organization')}}</span>
                    @endif
                </p>
                @if($this->organization->organizationProfile)
    
                    <div class="mt-5 sm:mt-8 w-full">
                        <button 
                            wire:click="donate({{$this->organization->id}})" wire:loading.attr="disabled" 
                            class="flex-1 shadow-md w-full px-4 py-4 sm:py-4 text-center bg-yellow-400 border border-yellow-500 rounded-md font-bold text-base text-black uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-500 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            <span>{{__('Donate now')}}</span>
                        </button>
                    </div>
                    <div class="mt-6">
                        <button  wire:click="$emit('sharedOpen', {{$this->organization->id}})" wire:loading.attr="disabled"
                            class="flex justify-center items-center w-full text-center px-4  py-1 sm:py-3 bg-white border border-gray-300 rounded-md font-bold text-sm text-black uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            <span class="material-icons-outlined">share</span>
                            <span class="ml-1">{{__('Share')}}</span>
                        </button>
                    </div>
                    <div class="flex items-center justify-center space-x-5 sm:space-x-5 mt-3">
                        @if($this->organization->organizationProfile->facebook)
                        <a href="https://www.facebook.com/{{$this->organization->organizationProfile->facebook}}" target="_blank">
                            <svg class="h-7 sm:h-7" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196;" xml:space="preserve">
                                <g>
                                <circle style="fill:#3B5998;" cx="56.098" cy="56.098" r="56.098"/>
                                <path style="fill:#FFFFFF;" d="M70.201,58.294h-6.01v36.672H45.025V58.294h-7.213V45.406h7.213v-8.34
                                    c0-5.964,2.833-15.303,15.301-15.303L71.56,21.81v12.51h-20.151c-1.337,0-3.217,0.668-3.217,3.513v7.585h11.334L70.201,58.294z"/>
                                </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>
                        </a>
                        @endif
                        @if($this->organization->organizationProfile->twitter)
                        <a href="https://www.twitter.com/{{$this->organization->organizationProfile->twitter}}" target="_blank">
                            <svg class="h-7 sm:h-7" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                        @endif
                        @if($this->organization->organizationProfile->instagram)
                        <a href="https://www.instagram.com/{{$this->organization->organizationProfile->instagram}}" target="_blank">
                            <svg class="h-7 sm:h-7"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <linearGradient id="SVGID_1_" gradientTransform="matrix(0 -1.982 -1.844 0 -132.522 -51.077)" gradientUnits="organizationSpaceOnUse" x1="-37.106" x2="-26.555" y1="-72.705" y2="-84.047">
                                    <stop offset="0" stop-color="#fd5"/><stop offset=".5" stop-color="#ff543e"/><stop offset="1" stop-color="#c837ab"/></linearGradient>
                                    <path d="m1.5 1.633c-1.886 1.959-1.5 4.04-1.5 10.362 0 5.25-.916 10.513 3.878 11.752 1.497.385 14.761.385 16.256-.002 1.996-.515 3.62-2.134 3.842-4.957.031-.394.031-13.185-.001-13.587-.236-3.007-2.087-4.74-4.526-5.091-.559-.081-.671-.105-3.539-.11-10.173.005-12.403-.448-14.41 1.633z" fill="url(#SVGID_1_)"/>
                                    <path d="m11.998 3.139c-3.631 0-7.079-.323-8.396 3.057-.544 1.396-.465 3.209-.465 5.805 0 2.278-.073 4.419.465 5.804 1.314 3.382 4.79 3.058 8.394 3.058 3.477 0 7.062.362 8.395-3.058.545-1.41.465-3.196.465-5.804 0-3.462.191-5.697-1.488-7.375-1.7-1.7-3.999-1.487-7.374-1.487zm-.794 1.597c7.574-.012 8.538-.854 8.006 10.843-.189 4.137-3.339 3.683-7.211 3.683-7.06 0-7.263-.202-7.263-7.265 0-7.145.56-7.257 6.468-7.263zm5.524 1.471c-.587 0-1.063.476-1.063 1.063s.476 1.063 1.063 1.063 1.063-.476 1.063-1.063-.476-1.063-1.063-1.063zm-4.73 1.243c-2.513 0-4.55 2.038-4.55 4.551s2.037 4.55 4.55 4.55 4.549-2.037 4.549-4.55-2.036-4.551-4.549-4.551zm0 1.597c3.905 0 3.91 5.908 0 5.908-3.904 0-3.91-5.908 0-5.908z" fill="#fff"/>
                            </svg>
                        </a>
                        @endif
                        @if($this->organization->organizationProfile->whatsapp)
                        <a href="https://api.whatsapp.com/send?phone={{$this->organization->organizationProfile->whatsapp_prefix}}{{$this->organization->organizationProfile->whatsapp}}" target="_blank">
                            <svg  class="h-7 sm:h-7" viewBox="-1 0 512 512"  xmlns="http://www.w3.org/2000/svg"><path d="m10.894531 512c-2.875 0-5.671875-1.136719-7.746093-3.234375-2.734376-2.765625-3.789063-6.78125-2.761719-10.535156l33.285156-121.546875c-20.722656-37.472656-31.648437-79.863282-31.632813-122.894532.058594-139.941406 113.941407-253.789062 253.871094-253.789062 67.871094.0273438 131.644532 26.464844 179.578125 74.433594 47.925781 47.972656 74.308594 111.742187 74.289063 179.558594-.0625 139.945312-113.945313 253.800781-253.867188 253.800781 0 0-.105468 0-.109375 0-40.871093-.015625-81.390625-9.976563-117.46875-28.84375l-124.675781 32.695312c-.914062.238281-1.84375.355469-2.761719.355469zm0 0" fill="#e5e5e5"/>
                                <path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0" fill="#fff"/>
                                <path d="m19.34375 492.625 33.277344-121.519531c-20.53125-35.5625-31.324219-75.910157-31.3125-117.234375.050781-129.296875 105.273437-234.488282 234.558594-234.488282 62.75.027344 121.644531 24.449219 165.921874 68.773438 44.289063 44.324219 68.664063 103.242188 68.640626 165.898438-.054688 129.300781-105.28125 234.503906-234.550782 234.503906-.011718 0 .003906 0 0 0h-.105468c-39.253907-.015625-77.828126-9.867188-112.085938-28.539063zm0 0" fill="#64b161"/><g fill="#fff">
                                    <path d="m10.894531 501.105469 34.46875-125.871094c-21.261719-36.839844-32.445312-78.628906-32.429687-121.441406.054687-133.933594 109.046875-242.898438 242.976562-242.898438 64.992188.027344 125.996094 25.324219 171.871094 71.238281 45.871094 45.914063 71.125 106.945313 71.101562 171.855469-.058593 133.929688-109.066406 242.910157-242.972656 242.910157-.007812 0 .003906 0 0 0h-.105468c-40.664063-.015626-80.617188-10.214844-116.105469-29.570313zm134.769531-77.75 7.378907 4.371093c31 18.398438 66.542969 28.128907 102.789062 28.148438h.078125c111.304688 0 201.898438-90.578125 201.945313-201.902344.019531-53.949218-20.964844-104.679687-59.09375-142.839844-38.132813-38.160156-88.832031-59.1875-142.777344-59.210937-111.394531 0-201.984375 90.566406-202.027344 201.886719-.015625 38.148437 10.65625 75.296875 30.875 107.445312l4.804688 7.640625-20.40625 74.5zm0 0"/><path d="m195.183594 152.246094c-4.546875-10.109375-9.335938-10.3125-13.664063-10.488282-3.539062-.152343-7.589843-.144531-11.632812-.144531-4.046875 0-10.625 1.523438-16.1875 7.597657-5.566407 6.074218-21.253907 20.761718-21.253907 50.632812 0 29.875 21.757813 58.738281 24.792969 62.792969 3.035157 4.050781 42 67.308593 103.707031 91.644531 51.285157 20.226562 61.71875 16.203125 72.851563 15.191406 11.132813-1.011718 35.917969-14.6875 40.976563-28.863281 5.0625-14.175781 5.0625-26.324219 3.542968-28.867187-1.519531-2.527344-5.566406-4.046876-11.636718-7.082032-6.070313-3.035156-35.917969-17.726562-41.484376-19.75-5.566406-2.027344-9.613281-3.035156-13.660156 3.042969-4.050781 6.070313-15.675781 19.742187-19.21875 23.789063-3.542968 4.058593-7.085937 4.566406-13.15625 1.527343-6.070312-3.042969-25.625-9.449219-48.820312-30.132812-18.046875-16.089844-30.234375-35.964844-33.777344-42.042969-3.539062-6.070312-.058594-9.070312 2.667969-12.386719 4.910156-5.972656 13.148437-16.710937 15.171875-20.757812 2.023437-4.054688 1.011718-7.597657-.503906-10.636719-1.519532-3.035156-13.320313-33.058594-18.714844-45.066406zm0 0" fill-rule="evenodd"/></g>
                            </svg>
                        </a>
                        @endif
                        @if($this->organization->organizationProfile->telegram)
                        <a href="https://telegram.me/{{$this->organization->organizationProfile->telegram}}" target="_blank">
                            <svg class="h-7 sm:h-7" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" fill="#039be5" r="12"/><path d="m5.491 11.74 11.57-4.461c.537-.194 1.006.131.832.943l.001-.001-1.97 9.281c-.146.658-.537.818-1.084.508l-3-2.211-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.121l-6.871 4.326-2.962-.924c-.643-.204-.657-.643.136-.953z" fill="#fff"/>
                            </svg>
                        </a>
                        @endif
                        @if($this->organization->organizationProfile->website)
                        <a href="{{$this->organization->organizationProfile->website}}" target="_blank">
                            <svg class="h-7 sm:h-7" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path style="fill:#65B1FC;" d="M481.901,339.399C420.099,468.999,325,497,256,497c-77.701,0-150.901-38.8-195.901-102.1
                                    c-45.298-63.9-56.1-144.9-30-222.301L34.9,162.7C71.499,75.399,160.3,15,256,15c77.701,0,150.901,38.8,195.901,102.1
                                    C497.199,181,508.001,262,481.901,339.399z"/>
                                <path style="fill:#1689FC;" d="M481.901,339.399C420.099,468.999,325,497,256,497V15c77.701,0,150.901,38.8,195.901,102.1
                                    C497.199,181,508.001,262,481.901,339.399z"/>
                                <path style="fill:#96EBE6;" d="M464.2,108.399C416.201,41.199,338.5,0,256,0C153.1,0,58.9,64.6,20.2,159.699L15.099,170.2
                                    C-12.446,254.076-1.721,333.523,47.8,403.599C95.799,470.799,173.5,512,256,512c101.7,0,194.7-63.1,234.6-156.101l4.499-9
                                    C525.085,261.58,514.581,179.618,464.2,108.399z M72.4,386.199c-42.599-60-52.5-135.899-27.9-208.799l3.9-8.101
                                    C72.7,111.099,121,66,178.599,44.399c-36.299,47.401-58.2,139.6-55.499,169.6c-0.3,0.901-0.601,1.8-0.601,3.001
                                    c-7.8,100.499,15,197.5,57.9,251.8C137.5,453.199,99.401,424.3,72.4,386.199z M241,479.299c-10.499-3.6-21-11.499-30.901-22
                                    C168.1,412,145,316.3,152.5,219.399V216.7c0-0.901,0.3-2.1,0.3-3.001c8.699-93.3,45.3-166.899,88.2-181V479.299z M271,478.999
                                    v-446.3c46.199,15.3,84.901,100.3,89.399,201.7c4.2,93.6-19.199,181.5-59.7,224.101C291.099,468.399,281.201,475.699,271,478.999z
                                    M467.5,334.6c-33.6,70.8-81,114.399-135.899,133.9c40.199-50.7,62.999-141.1,58.798-235.3c-3.6-79.801-26.1-148.599-58.799-190
                                    c42.9,15.599,80.999,44.5,107.999,82.599C482.199,185.799,492.1,261.7,467.5,334.6z"/>
                                <path style="fill:#00C8C8;" d="M464.2,108.399C416.201,41.199,338.5,0,256,0v512c101.7,0,194.7-63.1,234.6-156.101l4.499-9
                                    C525.085,261.58,514.581,179.618,464.2,108.399z M271,478.999v-446.3c46.199,15.3,84.901,100.3,89.399,201.7
                                    c4.2,93.6-19.199,181.5-59.7,224.101C291.099,468.399,281.201,475.699,271,478.999z M467.5,334.6
                                    c-33.6,70.8-81,114.399-135.899,133.9c40.199-50.7,62.999-141.1,58.798-235.3c-3.6-79.801-26.1-148.599-58.799-190
                                    c42.9,15.599,80.999,44.5,107.999,82.599C482.199,185.799,492.1,261.7,467.5,334.6z"/>
                                <path style="fill:#0053BF;" d="M466,151H46c-24.901,0-46,20.099-46,45v120c0,24.899,21.099,45,46,45h420c24.901,0,46-20.101,46-45
                                    V196C512,171.099,490.901,151,466,151z"/>
                                <path style="fill:#05377F;" d="M512,196v120c0,24.899-21.099,45-46,45H256V151h210C490.901,151,512,171.099,512,196z"/>
                                <path style="fill:#E1F1FA;" d="M329.5,232.599l-30,60C296.8,297.7,291.7,301,286,301s-10.8-3.3-13.5-8.401L256,259.6l-16.5,32.999
                                    c-5.099,10.201-21.901,10.201-27.001,0l-30-60c-3.6-7.2-0.599-16.199,6.901-20.099c7.2-3.6,16.199-0.601,20.099,6.899L226,252.4
                                    l16.5-33.001c2.701-5.099,8.101-7.8,13.5-7.8c5.399,0,10.8,2.701,13.5,7.8L286,252.4l16.5-33.001c3.9-7.5,12.9-10.499,20.099-6.899
                                    C330.099,216.4,333.1,225.399,329.5,232.599z"/>
                                <path style="fill:#BFE1FF;" d="M436,301c-5.684,0-10.869-3.208-13.418-8.291L406,259.545l-16.582,33.164
                                    c-5.098,10.166-21.738,10.166-26.836,0l-28.74-57.495c-1.86-2.285-3.062-5.112-3.267-8.218c-0.527-8.262,5.288-15.366,13.549-15.908
                                    c6.27-0.146,12.598,2.813,15.293,8.203L376,252.455l16.582-33.164c5.098-10.166,21.738-10.166,26.836,0L436,252.455l16.582-33.164
                                    c3.721-7.427,12.729-10.371,20.127-6.709c7.412,3.706,10.415,12.715,6.709,20.127l-30,60C446.869,297.792,441.684,301,436,301z"/>
                                <path style="fill:#E1F1FA;" d="M166.967,211.029c-5.903-0.059-11.689,2.871-14.385,8.262L136,252.455l-16.582-33.164
                                    c-5.403-10.769-21.492-10.688-26.836,0L76,252.455l-16.582-33.164c-3.721-7.427-12.744-10.371-20.127-6.709
                                    c-7.412,3.706-10.415,12.715-6.709,20.127l30,60C65.131,297.792,70.316,301,76,301s10.869-3.208,13.418-8.291L106,259.545
                                    l16.582,33.164C125.131,297.792,130.316,301,136,301s10.869-3.208,13.418-8.291l28.257-56.514c2.139-2.432,3.516-5.64,3.75-9.199
                                    C181.952,218.734,175.229,211.571,166.967,211.029z"/>
                                <path style="fill:#BFE1FF;" d="M329.5,232.599l-30,60C296.8,297.7,291.7,301,286,301s-10.8-3.3-13.5-8.401L256,259.6v-48.001
                                    c5.4,0,10.8,2.701,13.5,7.8L286,252.4l16.5-33.001c3.9-7.5,12.9-10.499,20.099-6.899C330.099,216.4,333.1,225.399,329.5,232.599z"/>
                                <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-0 sm:px-4 mt-10 bg-white rounded-md shadow border border-gray-100">
        <div class="text-base text-black px-4 sm:px-0"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
            <div 
                x-data="{
                openTab: window.location.hash ? window.location.hash.substring(1) : 'activities',
                activeClasses: 'bg-white shadow border-t border-ys1 text-ys1  capitalize',
                inactiveClasses: 'hover:text-green-500 capitalize'
                }" 
                class="py-0 "
            >
            <ul class="flex border-t border-gray-100 overflow-x-auto overflow-y-hidden justify-center items-center" >
                <li @click.prevent="openTab = 'activities'; window.location.hash = 'activities'" :class="{ '-mb-px': openTab === 'activities' }" class="-mb-px mr-1">
                    <a :class="openTab === 'activities' ? activeClasses : inactiveClasses" 
                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                        {{__('Activities')}}
                    </a>
                </li>
                <li @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="-mb-px mr-1">
                    <a wire:click="$emit('rewards', {{$this->organization->id}})" :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                        {{__('Rewards')}}
                    </a>
                </li>
                <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="mr-1">
                    <a wire:click="$emit('about', {{$this->organization->id}})" :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                    class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                        {{__('About')}}
                    </a>
                </li>
            </ul>
        
            <div class="w-full mt-5">
                <div x-show="openTab === 'activities'">
                    @livewire('organization.profile.activities-profile-organization', ['organization' => $this->organization])
                </div>
                <div x-show="openTab === 'rewards'">
                    @livewire('organization.profile.rewards-organization' , ['organization' => $this->organization])
                </div>
                <div x-show="openTab === 'about'">
                    @livewire('organization.profile.about-profile-organization' , ['organization' => $this->organization])
                </div>
            </div>
            </div>
        </div>
    </div>

    

</div>
<livewire:footer.footer-app/>