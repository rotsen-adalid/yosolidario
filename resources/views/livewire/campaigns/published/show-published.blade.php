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
        
            <div class="mt-4 text-gray-500 text-base">
                <span class="text-ys1 font-bold capitalize">
                    {!! nl2br(e($this->campaign->locality), false) !!} - 
                </span>
                <span class="text-black text-black">
                    {!! nl2br(e($this->campaign->extract), false) !!}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-10 rounded-lg sm:pt-2">
            <div class="lg:col-span-2">
                <livewire:campaigns.published.cover-page-published :campaign="$campaign"/>
            </div>
            <div class="">
                <!-- organizer -->
                <livewire:campaigns.published.organizer-published :campaign="$campaign"/>
                <livewire:campaigns.published.counters-published :campaign="$campaign"/>
                @include('livewire.campaigns.published.shared-published')
            </div>
        </div>
        <!-- --> 
        <div class=" grid grid-cols-1 md:grid-cols-3 md:gap-10 rounded-lg">
            <div class="lg:col-span-2">
                <!-- -->
                <div class="text-base text-black"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
                    <div 
                        x-data="{
                        openTab: window.location.hash ? window.location.hash.substring(1) : 'about',
                        activeClasses: 'bg-white shadow border-b border-ys1 text-ys1  capitalize',
                        inactiveClasses: 'hover:text-green-500 capitalize'
                        }" 
                        class="py-6 "
                    >
                    <ul class="flex border-b shadow overflow-x-auto overflow-y-hidden" >
                        <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="-mb-px mr-1">
                            <a :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                            {{__('about')}}
                        </a>
                        </li>
                        <li class="md:hidden" @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="mr-1">
                            <a :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('rewards')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'updates'; window.location.hash = 'updates'" :class="{ '-mb-px': openTab === 'updates' }" class="mr-1">
                            <a :class="openTab === 'updates' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('updates')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'collaborators'; window.location.hash = 'collaborators'" :class="{ '-mb-px': openTab === 'collaborators' }" class="mr-1">
                            <a :class="openTab === 'collaborators' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('collaborators')}}
                            </a>
                        </li>
                        <li @click.prevent="openTab = 'comments'; window.location.hash = 'comments'" :class="{ '-mb-px': openTab === 'comments' }" class="mr-1">
                            <a :class="openTab === 'comments' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('comments')}}
                            </a>
                        </li>
                    </ul>
                
                    <div class="w-full pt-4">
                        <div x-show="openTab === 'about'">
                        <livewire:campaigns.published.about-published :campaign="$campaign"/>
                        </div>
                        <div class="md:hidden" x-show="openTab === 'rewards'">
                            <livewire:campaigns.published.rewards-published :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'updates'">
                        <livewire:campaigns.published.updates-published :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'collaborators'">
                        <livewire:campaigns.published.collaborators-published :campaign="$campaign"/>
                        </div>
                        <div x-show="openTab === 'comments'">
                        <livewire:campaigns.published.comments-published :campaign="$campaign"/>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- -->
            </div>
            <div>
                <!-- organizer -->
                <div class="hidden md:block">
                <livewire:campaigns.published.rewards-published :campaign="$campaign"/>
                </div>
            </div>
        </div>
        <!-- Send to review Modal -->

    </x-slot>

</x-section-content>
</div>
<livewire:footer/>
