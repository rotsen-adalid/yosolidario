<div>
    
<nav x-data="{ open: false }" class=" bg-white border-b border-gray-100  header w-full ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-6xl mx-auto px-4 sm:px-4 lg:px-4">
      <div class="flex justify-between h-20">
          <div class="flex">
              <!-- Logo -->
              <div class=" flex items-center">
                  <a href="{{ route('home') }}">
                      <x-application-mark/>
                  </a>
              </div>

            <!-- Navigation Links -->

            <!-- 
            <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
                <x-nav-link href="{{ route('campaigns/discover') }}" :active="request()->routeIs('campaigns/discover')">
                    {{ __('Campaigns') }}
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
                <x-nav-link href="{{ url('about/how-it-works') }}" :active="request()->routeIs('about/how-it-works')">
                    {{ __('How it works?') }}
                </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
              <x-nav-link href="{{ url('about/about-us') }}" :active="request()->routeIs('about/about-us')">
                  {{ __('About us') }}
              </x-nav-link>
            </div>
            -->

          </div>

          <div class="hidden sm:flex sm:items-center sm:ml-6">

            <!-- 
            <div class="relative text-gray-600 ">
                <input type="text" name="serch" placeholder="{{__('Search Campaigns')}}" 
                class="border border-gray-200 bg-white h-11 px-5 pr-10 rounded-full text-sm w-72 focus:border-green-500 focus:ring focus:ring-green-50 focus:ring-opacity-50 rounded-md shadow-sm">
                <button type="submit" class="absolute right-0 mt-3 mr-2">
                    <span class="material-icons-outlined cursor-pointer">
                        search
                    </span>
                </button>
            </div>
            -->

              @auth

              <span class="ml-0">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
              <!-- Teams Dropdown -->
              @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                  <div class="ml-3 relative">
                      <x-dropdown align="right" width="60">
                          <x-slot name="trigger">
                              <span class="inline-flex rounded-md">
                                  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                      {{ Auth::user()->currentTeam->name }}

                                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                        @livewire('menu.navigation-menu', ['option' => 0])
                      </x-slot>

                      <x-slot name="content">
                        @livewire('menu.navigation-menu', ['option' => 1])
                      </x-slot>
                  </x-dropdown>
              </div>
              <div class="ml-3">
                @if (Auth::user()->id == $this->campaign->user->id )
                    <x-basic-button wire:click="$emit('sendReviewDialog', {{ $this->campaign->id }})" wire:loading.attr="disabled">
                        <span class="material-icons-outlined pr-1">open_in_new</span>
                        <span class="">{{ __('Publish campaign') }}</span>
                    </x-basic-button>
                @endif
              </div>
              @else
              <div class="hidden space-x-3 sm:-my-px sm:ml-5 sm:flex items-center">
                  <a class="font-bold text-sm text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                      <span class="py-2 px-3 rounded-lg text-gray-700 font-bold ">{{ __('Login') }}</span>
                  </a>
              </div>
              @endauth
          </div>
         
          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
                @auth
                    @if (Auth::user()->id == $this->campaign->user->id )
                    <button wire:click="$emit('sendReviewDialog', {{ $this->campaign->id }})" wire:loading.attr="disabled" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <span class="material-icons-outlined ">
                            publish</span>
                    </button>
                    @endif
                @endauth
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 focus:text-gray-800 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
          </div>
      </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" x-on:click.away="open = false" class="hidden sm:hidden">
        <div class="relative text-gray-600  mx-4 mb-2">
            <input type="text" name="serch" placeholder="{{__('Search Campaigns')}}" 
            class="border border-gray-200 bg-white h-11 px-5 pr-10 rounded-full text-sm w-full focus:border-green-500 focus:ring focus:ring-green-50 focus:ring-opacity-50 rounded-md shadow-sm">
            <button type="submit" class="absolute right-0 mt-3 mr-2">
                <span class="material-icons-outlined cursor-pointer">
                    search
                </span>
            </button>
        </div>

        @auth

        @else
            <div class="space-y-1">
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        <span>{{ __('Login') }}</span>
                </x-responsive-nav-link>
            </div>
        @endauth
        
        
        <div class="space-y-1">
            <x-responsive-nav-link href="{{ route('campaign/create') }}" :active="request()->routeIs('campaign/create')">
                {{ __('Start a campaign') }}
            </x-responsive-nav-link>
        </div>

        <div class="space-y-1">
            <x-responsive-nav-link href="{{ route('campaigns/discover') }}" :active="request()->routeIs('campaigns/discover')">
                {{ __('Campaigns') }}
            </x-responsive-nav-link>
        </div>

        @livewire('menu.navigation-menu', ['option' => 2])
  </div>
    
</nav>
</div>
