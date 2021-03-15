<x-slot name="title">
    {{$campaign->title}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
        <!-- facebook -->
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
        <meta property="og:url"        content="http://yosolidario.com/{{$campaign->slug}}" />
        <meta property="og:type"       content="article" />
        <meta property="og:title"      content="{{$campaign->title}}" />
        <meta property="og:description"  content="{{$campaign->extract}}" />
        <meta property="og:image"      content="https://yosolidario.com{{$campaign->image->url}}" />
        <meta property="fb:app_id" content="738141669970459" />

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@yosolidariocom">
        <meta name="twitter:title" content="{{$campaign->title}}">
        <meta name="twitter:description" content="{{$campaign->extract}}">
        <meta name="twitter:image" content="https://yosolidario.com{{$campaign->image->url}}">

</x-slot>
<x-slot  name="menu">
    <livewire:navigation/>
</x-slot>
<div class="bg-white">
<x-section-content>
    <x-slot name="header">
            
    </x-slot>
    <x-slot  name="content">
        <div class="pb-1 sm:p-6 sm:px-20 bg-white">
        
            <div class="mt-4 text-2xl text-2xl sm:text-4xl font-bold text-black text-center">
                {!! nl2br(e($this->campaign->title), false) !!}
            </div>
        
            <div class="mt-4 text-gray-500 text-sm sm:text-base mb-2 sm:mb-0">
                <span class="text-ys1 font-bold capitalize">
                    {!! nl2br(e($this->campaign->locality), false) !!} - 
                </span>
                <span class="text-black text-black">
                    {!! nl2br(e($this->campaign->extract), false) !!}
                </span>
            </div>
        </div>

        <!----- show preview--- -->

        <div class="hidden lg:flex lg:items-center">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-10 rounded-lg sm:pt-2">
                <div class="lg:col-span-2">
                    <livewire:campaigns.preview.cover-page-preview :campaign="$campaign"/>
                    <!-- --> 
                    <div class="">
                            <!-- -->
                            <div class="text-base text-black"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
                                <div 
                                    x-data="{
                                    openTab: window.location.hash ? window.location.hash.substring(1) : 'about',
                                    activeClasses: 'bg-white shadow border-b border-ys1 text-ys1 ',
                                    inactiveClasses: 'hover:text-green-500'
                                    }" 
                                    class="py-6 "
                                >
                                <ul class="flex border-b shadow overflow-x-auto overflow-y-hidden" >
                                    <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="-mb-px mr-1">
                                        <a :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                        {{__('About')}}
                                    </a>
                                    </li>
                                    <li class="md:hidden" @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="mr-1">
                                        <a :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            {{__('Rewards')}}
                                        </a>
                                    </li>
                                    <li @click.prevent="openTab = 'updates'; window.location.hash = 'updates'" :class="{ '-mb-px': openTab === 'updates' }" class="mr-1">
                                        <a :class="openTab === 'updates' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            {{__('Updates')}}
                                        </a>
                                    </li>
                                    <li @click.prevent="openTab = 'collaborators'; window.location.hash = 'collaborators'" :class="{ '-mb-px': openTab === 'collaborators' }" class="mr-1">
                                        <a :class="openTab === 'collaborators' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            {{__('Collaborators')}}
                                        </a>
                                    </li>
                                    <li @click.prevent="openTab = 'comments'; window.location.hash = 'comments'" :class="{ '-mb-px': openTab === 'comments' }" class="mr-1">
                                        <a :class="openTab === 'comments' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            {{__('Comments')}}
                                        </a>
                                    </li>
                                </ul>
                            
                                <div class="w-full pt-4">
                                    <div x-show="openTab === 'about'">
                                    <livewire:campaigns.preview.about-preview :campaign="$campaign"/>
                                    </div>
                                    <div x-show="openTab === 'updates'">
                                    <livewire:campaigns.preview.updates-preview :campaign="$campaign"/>
                                    </div>
                                    <div x-show="openTab === 'collaborators'">
                                    <livewire:campaigns.preview.collaborators-preview :campaign="$campaign"/>
                                    </div>
                                    <div x-show="openTab === 'comments'">
                                    <livewire:campaigns.preview.comments-preview :campaign="$campaign"/>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- -->
                            @include('livewire.campaigns.preview.footer-preview')
                    </div>

                </div>
    
                <div class="">
                    <!-- organizer -->
                    <livewire:campaigns.preview.organizer-preview :campaign="$campaign"/>
                    <livewire:campaigns.preview.counters-preview :campaign="$campaign"/>
                    <livewire:campaigns.preview.important-collaborations-preview :campaign="$campaign"/>
                    <div class="mt-10">
                        <!-- rewards -->
                        <div class="hidden md:block">
                            <livewire:campaigns.preview.rewards-preview :campaign="$campaign"/>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        
        <!-- Responsive -->
        <div class="lg:hidden">
            <div class="w-full">
                <livewire:campaigns.preview.cover-page-preview :campaign="$campaign"/>
            </div>
            <div>
                <livewire:campaigns.preview.counters-preview :campaign="$campaign"/>
            </div>
            <div class="mt-5">
                <livewire:campaigns.preview.organizer-preview :campaign="$campaign"/>
            </div>
            <div class="">
                <!-- -->
                <div class="text-base text-black"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
                    <div 
                        x-data="{
                        openTab: window.location.hash ? window.location.hash.substring(1) : 'about',
                        activeClasses: 'bg-white shadow border-b border-ys1 text-ys1 ',
                        inactiveClasses: 'hover:text-green-500'
                        }" 
                        class="py-6 "
                    >
                    <ul class="flex border-b shadow overflow-x-auto overflow-y-hidden" >
                        <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="-mb-px mr-1">
                            <a :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                            {{__('About')}}
                        </a>
                        </li>
                        <li @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="mr-1">
                            <a :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('Rewards')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'updates'; window.location.hash = 'updates'" :class="{ '-mb-px': openTab === 'updates' }" class="mr-1">
                            <a :class="openTab === 'updates' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('Updates')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'collaborators'; window.location.hash = 'collaborators'" :class="{ '-mb-px': openTab === 'collaborators' }" class="mr-1">
                            <a :class="openTab === 'collaborators' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('Collaborators')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'comments'; window.location.hash = 'comments'" :class="{ '-mb-px': openTab === 'comments' }" class="mr-1">
                            <a :class="openTab === 'comments' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('Comments')}}
                            </a>
                        </li>
                    </ul>
                
                    <div class="w-full pt-4">
                        <div x-show="openTab === 'about'">
                        <livewire:campaigns.preview.about-preview :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'rewards'">
                            <livewire:campaigns.preview.rewards-preview :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'updates'">
                        <livewire:campaigns.preview.updates-preview :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'collaborators'">
                        <livewire:campaigns.preview.collaborators-preview :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'comments'">
                        <livewire:campaigns.preview.comments-preview :campaign="$campaign"/>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- -->
            </div>
            <!-- -->
            @include('livewire.campaigns.preview.footer-preview')
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-10 rounded-lg mt-10 sm:mt-0">
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.preview.svg.trofeo') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('Fundraising platform')}}</div>
                    <div>{{__('More people start fundraisers on YoSolidario than on any other platform.')}}</div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.preview.svg.manos') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('YoSolidario Guarantee')}}</div>
                    <div>{{__('In the rare case something isn’t right, we will work with you to determine if misuse occurred.')}}</div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.preview.svg.tiempo') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('Expert advice, 24/7')}}</div>
                    <div>{{__('Contact us with your questions and we’ll answer, day or night.')}}</div>
                </div>
            </div>
        </div>
        
    </x-slot>

</x-section-content>
</div>
<livewire:footer/>
