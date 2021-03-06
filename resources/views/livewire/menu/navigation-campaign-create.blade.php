<div>
    <nav x-data="{ open: false }" class=" bg-white border-b border-gray-100 shadow header w-full  fixed top-0">
        <!-- Primary Navigation Menu -->
        <div class="max-w-5xl mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    <!-- Logo -->
                    <div class=" flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-mark />
                        </a>
                    </div>
    
                    <!-- Navigation Links -->
    
                </div>
    
                <div class="hidden lg:flex sm:items-center sm:ml-6">
    
                    @auth
    
                        @if ($this->status_register == 'COMPLETE')
                            <div class="flex items-center leading-tight space-x-0">
                                <x-basic-button wire:click="$emit('sendReviewDialog', {{ $this->campaign->id }})" wire:loading.attr="disabled">
                                    <span class="material-icons-outlined pr-1">open_in_new</span>
                                    <span class="">{{ __('Publish campaign') }}</span>
                                </x-basic-button>
                                <x-basic-button wire:click="preview({{ $this->campaign_id }})" wire:loading.attr="disabled">
                                    <span class="material-icons-outlined pr-1">remove_red_eye</span>
                                    <span class="">{{ __('Preview') }}</span>
                                </x-basic-button>
                            </div>
                        @else
                            <span class="ml-0">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                        @endif
    
                        <!-- Teams Dropdown -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="ml-3 relative">
                                <x-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->currentTeam->name }}
    
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>
    
                                    <x-slot name="content">
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>
    
                                            <!-- Team Settings -->
                                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-dropdown-link>
    
                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-dropdown-link>
                                            @endcan
    
                                            <div class="border-t border-gray-100"></div>
    
                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>
    
                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif
    
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            @if (Auth::user()->profile_photo_path)
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_path }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Auth::user()->profile_photo_url }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            @endif
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}
    
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>
    
                                <x-slot name="content">
                                    @livewire('menu.navigation-menu', ['option' => 2])
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
    
                            <a class="font-bold text-sm text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('login') }}">
                                <span
                                    class="border border-ys1 py-2 px-3 rounded-lg text-ys1 font-bold ">{{ __('Login') }}</span>
                            </a>
                        </div>
                    @endauth
                </div>
    
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center lg:hidden">
    
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 focus:text-gray-800 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Responsive Navigation Menu -->
    
        <div :class="{'block': open, 'hidden': ! open}" x-on:click.away="open = false" class="hidden lg:hidden shadow-lg">
    
            @if ($this->status_register == 'COMPLETE')
                <div class="flex flex-col leading-tight px-4 space-y-4 pb-2">
                    <livewire:campaigns.create.send-review :campaign="$campaign"/>
                    <x-secondary-button wire:click="preview({{ $this->campaign_id }})" wire:loading.attr="disabled">
                        <span class="material-icons-outlined pr-1">remove_red_eye</span>
                        <span class="">{{ __('Preview') }}</span>
                    </x-secondary-button>
                </div>
            @endif
            @livewire('menu.navigation-menu', ['option' => 3])
        </div>
        <!-- Send to review Modal -->
       
    </nav>
    
</div>
