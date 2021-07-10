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
    <livewire:menu.navigation-published :campaign="$campaign"/>
</x-slot>
<div class="bg-white">

<x-section-content>
    <x-slot name="header">
         @livewire('campaigns.published.shared-published')   
    </x-slot>
    <x-slot  name="content">
        <div class="pb-2 sm:p-2 sm:px-20 bg-white">
        
            <div class="mt-4 text-2xl text-2xl sm:text-4xl font-bold text-black text-center">
                {!! nl2br(e($this->campaign->title), false) !!}
            </div>
            
            @if ($this->campaign->type_campaign == 'PERSONAL' or $this->campaign->type_campaign == 'PERSONAL_ORGANIZATION')
            <div class=" mt-4 text-gray-500 text-sm sm:text-base mb-0 sm:mb-0">
                <span class="text-ys1 font-bold capitalize">
                    {!! nl2br(e($this->campaign->locality), false) !!} - 
                </span>
                <span class="text-black text-black">
                    {!! nl2br(e($this->campaign->extract), false) !!}
                </span>
            </div>
            @endif
        </div>
        
        <!----- show published--- -->
        <div class="hidden lg:flex lg:items-center">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-8 rounded-lg sm:pt-2">
                <div class="lg:col-span-2">
                    <div>
                        <livewire:campaigns.published.cover-page-published :campaign="$campaign"/>
                    </div>
                    <!-- --> 
                    <div class="">
                            <!-- -->
                            <div class="text-base text-black"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
                                <div 
                                    x-data="{
                                    openTab: window.location.hash ? window.location.hash.substring(1) : 'about',
                                    activeClasses: 'bg-white shadow border-b-4 border-ys1 text-ys1 ',
                                    inactiveClasses: 'hover:text-green-500'
                                    }" 
                                    class="pb-0 mt-3 "
                                >
                                <ul class="flex justify-start border-b border-ys1 shadow-l-none shadow-r-none overflow-x-auto overflow-y-hidden" >
                                    <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="-mb-px mr-1">
                                        <a :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                        {{__('Campaign')}}
                                    </a>
                                    </li>
                                    @if($this->campaign->campaignReward->count() > 0)
                                    <li @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="mr-1">
                                        <a :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            {{__('Rewards')}}
                                        </a>
                                    </li>
                                    @endif
                                    <li  @click.prevent="openTab = 'updates'; window.location.hash = 'updates'" :class="{ '-mb-px': openTab === 'updates' }" class="mr-1">
                                        <a wire:click="$emit('comunication', {{$campaign->id}})" :class="openTab === 'updates' ? activeClasses : inactiveClasses" 
                                        class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                            <span>{{__('Updates')}}</span>
                                             <!--
                                            wire:click="$emit('comunication', {{$campaign->id}})"  
                                            if ($countUpdates->count() > 0)
                                                <span class="rounded-full bg-red-500 px-2 py-1 text-white text-xs">
                                                    {$countUpdates->count()}}
                                                </span>
                                            endif
                                            -->
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
                            
                                <div class="w-full mt-8 mb-8">
                                    <div x-show="openTab === 'about'">
                                        <livewire:campaigns.published.about-published :campaign="$campaign"/>
                                    </div>
                                    @if($this->campaign->campaignReward->count() > 0)
                                    <div x-show="openTab === 'rewards'">
                                        <livewire:campaigns.published.rewards-published :campaign="$campaign"/>
                                    </div>
                                    @endif
                                    <div x-show="openTab === 'updates'">
                                        @livewire('campaigns.published.updates-published')
                                    </div>
                                    <div x-show="openTab === 'collaborators'">
                                        <livewire:campaigns.published.collaborators-published :campaign="$campaign" />
                                    </div>
                                    <div x-show="openTab === 'comments'">
                                        <livewire:campaigns.published.comments-published :campaign="$campaign"/>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- -->
                            @include('livewire.campaigns.published.footer-published')
                    </div>

                </div>
    
                <div class="">
                    <!-- organizer -->
                    @if ($this->campaign->type_campaign == 'PERSONAL' or $this->campaign->type_campaign == 'PERSONAL_ORGANIZATION')
                        <livewire:campaigns.published.organizer-published :campaign="$campaign"/>
                        <div class="o-campaign-sidebar shadow-lg border border-gray-100 p-5 rounded mt-5 mb-10">
                            <livewire:campaigns.published.counters-published :campaign="$campaign"/>
                            <livewire:campaigns.published.important-collaborations-published :campaign="$campaign"/>
                        </div>
                    @elseif ($this->campaign->type_campaign == 'ORGANIZATION')
                        <div class="o-campaign-sidebar shadow-lg border border-gray-100 p-5 rounded mt-0 mb-10">
                            <livewire:campaigns.published.counters-published :campaign="$campaign"/>
                            <livewire:campaigns.published.organizer-published :campaign="$campaign"/>
                            <livewire:campaigns.published.important-collaborations-published :campaign="$campaign"/>
                        </div>
                    @endif
                </div>
    
            </div>
        </div>
       
        <!-- Responsive -->
        <div class="lg:hidden">
            <div class="w-full">
                <livewire:campaigns.published.cover-page-published :campaign="$campaign"/>
            </div>
            <div>
                <livewire:campaigns.published.counters-published :campaign="$campaign"/>
            </div>
            <div class="mt-0">
                <livewire:campaigns.published.organizer-published :campaign="$campaign"/>
            </div>
            @if ($this->campaign->type_campaign == 'PERSONAL' or $this->campaign->type_campaign == 'PERSONAL_ORGANIZATION'  or $this->campaign->type_campaign == 'ORGANIZATION')
            <div class="lg:hidden px-4 sm:px-0 text-sm sm:text-sm sm:flex pt-5 justify-center item-center text-black">
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
            @endif
            <div class="">
                <!-- -->
                <div class="text-base text-black"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
                    <div 
                        x-data="{
                        openTab: window.location.hash ? window.location.hash.substring(1) : 'about',
                        activeClasses: 'bg-white shadow border-b-4 border-ys1 text-ys1 ',
                        inactiveClasses: 'hover:text-green-500'
                        }" 
                        class="py-6 "
                    >
                    <ul class="flex border-b border-ys1 shadow-l-none shadow-r-none overflow-x-auto overflow-y-hidden" >
                        <li @click.prevent="openTab = 'about'; window.location.hash = 'about'" :class="{ '-mb-px': openTab === 'about' }" class="-mb-px mr-1">
                            <a :class="openTab === 'about' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                            {{__('About')}}
                        </a>
                        </li>
                        @if($this->campaign->campaignReward->count() > 0)
                        <li @click.prevent="openTab = 'rewards'; window.location.hash = 'rewards'" :class="{ '-mb-px': openTab === 'rewards' }" class="mr-1">
                            <a :class="openTab === 'rewards' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold" href="#">
                                {{__('Rewards')}}
                            </a>
                        </li>
                        @endif
                        <li @click.prevent="openTab = 'updates'; window.location.hash = 'updates'" :class="{ '-mb-px': openTab === 'updates' }" class="mr-1">
                            <a  wire:click="$emit('comunication', {{$campaign->id}})" :class="openTab === 'updates' ? activeClasses : inactiveClasses" 
                            class="bg-white inline-block py-3 px-5 font-semibold flex space-x-1" href="#">
                                <span>{{__('Updates')}}</span>
                               <!-- 
                                 if ($countUpdates->count() > 0)
                                    <span class="rounded-full bg-red-500 px-2 py-1 text-white text-xs">
                                        {$countUpdates->count()}}
                                    </span>
                                endif
                                -->
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
                        <livewire:campaigns.published.about-published :campaign="$campaign"/>
                        </div>
                        @if($this->campaign->campaignReward->count() > 0)
                        <div x-show="openTab === 'rewards'">
                            <livewire:campaigns.published.rewards-published :campaign="$campaign"/>
                        </div>
                        @endif
                        <div x-show="openTab === 'updates'">
                            @livewire('campaigns.published.updates-published')
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
            <!-- -->
            @include('livewire.campaigns.published.footer-published')
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 sm:gap-10 rounded-lg mt-10 sm:mt-0">
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.published.svg.trofeo') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('Fundraising platform')}}</div>
                    <div>{{__('More people start fundraisers on YoSolidario than on any other platform.')}}</div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.published.svg.manos') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('YoSolidario Guarantee')}}</div>
                    <div>{{__('In the rare case something isn’t right, we will work with you to determine if misuse occurred.')}}</div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    @include('livewire.campaigns.published.svg.tiempo') 
                </div>
                <div>
                    <div class="text-base uppercase font-bold">{{__('Expert advice, 24/7')}}</div>
                    <div>{{__('Contact us with your questions and we’ll answer, day or night.')}}</div>
                </div>
            </div>
        </div>
        
    </x-slot>

</x-section-content>
    @if ($this->campaign->agency->country->code == $this->country_code)
        <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
            <div class="hidden">
                <a href="tel:{{$campaign->phone_prefix}}{{$campaign->phone}}" title="{{$campaign->user->name}}" 
                class=" bg-ys1 justify-center flex items-center block w-10 h-10 rounded-full transition-all shadow-lg hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                    <span class="material-icons-outlined w-full h-full rounded-full text-white text-3xl ml-1 mt-1">call</span>
                </a>
            </div>
        </div>
    @endif
</div>
<livewire:footer.footer-app/>

<style>
    .o-campaign-sidebar{position:-webkit-sticky;position:sticky;top:1rem}}
</style>