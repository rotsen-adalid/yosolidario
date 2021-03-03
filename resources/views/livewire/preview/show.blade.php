<x-slot name="title">
    {{__('My campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
</x-slot>
<div class="bg-white">
<x-section-content>
    <x-slot name="header">
        @auth
        @if($this->campaign->status == 'DRAFT' and Auth::user()->id == $this->campaign->user_id)
        <header class="bg-gray-50 shadow pt-2"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-black leading-tight pt-4 space-x-2">
                    <x-secondary-button wire:click="editCampaign" wire:loading.attr="disabled">
                        {{ __('Edit campaign') }}
                    </x-secondary-button>
                    <!-- 
                    if ($this->campaign->status_register == 'COMPLETE')
                        <x-button wire:click="reviewConfirm({$this->campaign_id}})" wire:loading.attr="disabled">
                            { __('Send to review') }}
                        </x-button>
                    endif
                    -->
                </h2>
            </div>
        </header>
        @endif
        @endauth
    </x-slot>
    <x-slot  name="content">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-10 rounded-lg  pt-4 sm:pt-10">
            <div class="lg:col-span-2">
                <livewire:preview.cover-page :slug="$slug"/>
            </div>
            <div class="px-4 sm:mt-10">
              <!-- organizer -->
                <livewire:preview.organizer :slug="$slug"/>
                <livewire:preview.counters :slug="$slug"/>
            </div>
        </div>
        <!-- --> 
        <div class=" grid grid-cols-1 md:grid-cols-3 md:gap-10 rounded-lg">
            <div class="lg:col-span-2">
                <!-- -->
                <div class="text-base text-black px-4 sm:px-0"> <!--  activeClasses: 'border-l border-t border-r rounded-t text-ys1 font-bold capitalize', -->
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
                        <livewire:preview.about :slug="$slug"/>
                        </div>
                        <div class="md:hidden" x-show="openTab === 'rewards'">
                            <livewire:preview.rewards :slug="$slug"/>
                        </div>
                        <div x-show="openTab === 'updates'">
                        <livewire:preview.updates :slug="$slug"/>
                        </div>
                        <div x-show="openTab === 'collaborators'">
                        <livewire:preview.collaborators :slug="$slug"/>
                        </div>
                        <div x-show="openTab === 'comments'">
                        <livewire:preview.comments :slug="$slug"/>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- -->
            </div>
            <div>
              <!-- organizer -->
              <div class="hidden md:block">
                <livewire:preview.rewards :slug="$slug"/>
              </div>
            </div>
        </div>
        <!-- Send to review Modal -->

    </x-slot>
</x-section-content>
</div>
<livewire:footer/>