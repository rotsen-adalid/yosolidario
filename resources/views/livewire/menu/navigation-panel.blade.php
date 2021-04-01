<nav x-data="{ open: false, open0:false }" class=" bg-white border-b border-gray-100  header w-full  fixed top-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <div class="flex justify-between h-20">
          <div class="flex">
              <!-- Logo -->
              <div class=" flex items-center">
                  <a href="{{ route('home') }}">
                      <x-application-mark/>
                  </a>
              </div>

              <!-- Navigation Links -->

              <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
                  <x-nav-link href="{{ route('campaign/create') }}" :active="request()->routeIs('campaign/create')" class="font-bold text-base ">
                      {{ __('Start a campaign') }}
                  </x-nav-link>
              </div>

              <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
                  <x-nav-link href="{{ route('campaigns/discover') }}" :active="request()->routeIs('campaigns/discover')">
                      {{ __('Campaigns') }}
                  </x-nav-link>
              </div>

          </div>

          <div class="hidden lg:flex">

                <div class="hidden space-x-8 sm:-my-px sm:ml-6 lg:flex">
                    <x-nav-link href="{{ route('your/campaigns') }}" :active="request()->routeIs('your/campaigns')">
                        {{ __('Your campaigns') }}
                    </x-nav-link>
                </div>

                @auth

                <!-- notification -->
                @if (count($notificationsCollection))

                <div class="ml-3 mt-1 flex items-center">
                  <x-dropdown-notifications align="right">
                      <x-slot name="trigger">
                        <button  wire:click="readNotifications" wire:loading.attr="disabled"  class="pt-2 px-1 relative border-2 border-transparent text-gray-800 rounded-full hover:text-gray-400 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                            <span class="material-icons-outlined text-3xl">notifications</span>
                            @if (count($notificationsUnreadCollection))
                                @if (count($notificationsUnreadCollection) >= 0 and count($notificationsUnreadCollection) <= 9)
                                <span class="absolute inset-0 object-right-top -mr-6">
                                    <div class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                        {{count($notificationsUnreadCollection)}}
                                    </div>
                                </span>
                                @elseif(count($notificationsUnreadCollection) >= 10)
                                <span class="absolute inset-0 object-right-top -mr-6">
                                    <div class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                        9+
                                    </div>
                                </span>
                                @endif
                            @endif
                        </button>
                      </x-slot>

                      <x-slot name="content">
                            @if (count($notificationsCollection))
                                <!-- notifications show -->
                                <div class="block px-4 py-2 text-lg text-gray-800 font-bold">
                                    {{ __('Notifications') }}
                                </div>
                                @foreach ($notificationsCollection as $item)
                                    <a href="{{route('campaign/published', $item->data['slug'])}}" class="flex items-center px-4 py-2">
                                        <div class="mr-2">
                                            <img class="w-10 h-6 rounded-sm" src="{{ URL::to('/').$item->data['image_path']}}"/>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{$item->data['title']}}</div>
                                            @if ($item->data['action'] == 'HELP_ME_SHARE')
                                                <div>{{__('Help me share')}}</div>
                                            @endif
                                            <div class="text-xs text-blue-500">{{$item->created_at->diffForHumans()}}</div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                      </x-slot>
                    </x-dropdown-notifications>
                </div>
                @else 
                    <div class="ml-3 mt-1 flex items-center">
                        <span class="material-icons-outlined text-3xl">notifications</span>
                    </div>
                @endif
              <!-- Settings Dropdown -->
              <div class="ml-3 mt-2 flex items-center">
                  <x-dropdown align="right" width="48">
                      <x-slot name="trigger">
                          @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                              <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                  @if (Auth::user()->profile_photo_path)
                                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                                  @else 
                                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                  @endif
                              </button>
                          @else
                              <span class="inline-flex rounded-md">
                                  <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                      {{ Auth::user()->name }}

                                      <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                      </svg>
                                  </button>
                              </span>
                          @endif
                      </x-slot>

                      <x-slot name="content">
                          
                            <!-- Management Panel -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Management panel') }}
                            </div>

                            <!-- My campaigns -->
                            <x-dropdown-link href="{{ route('your/campaigns') }}">
                                {{ __('Your campaigns') }}
                            </x-dropdown-link>

                            <!-- My collaborations -->
                            <x-dropdown-link href="{{ route('your/collaborations') }}">
                                {{ __('Your collaborations') }}
                            </x-dropdown-link>
                            
                            <!-- Saved campaigns -->
                            <x-dropdown-link href="{{ route('campaign/saves/show') }}">
                                {{ __('Saved campaigns') }}
                            </x-dropdown-link>
                          
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage account') }}
                            </div>

                            @if(Auth::user()->slug)
                                <x-dropdown-link href="{{ route('user', Auth::user()) }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link href="{{ route('setting/account') }}">
                                {{ __('Account setting') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                      </x-slot>
                  </x-dropdown>
              </div>
              @else
              <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">

                  <a class="font-bold text-sm text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                      <span class="border border-ys1 py-2 px-3 rounded-lg text-ys1 font-bold ">{{ __('Login') }}</span>
                  </a>
              </div>
              @endauth
          </div>
         
          <!-- Hamburger -->
          <div class="-mr-2 flex items-center lg:hidden">

            <button @click="open0 = ! open0" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <span class="material-icons-outlined text-3xl">notifications</span>
            </button>
            
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
    <div :class="{'block': open0, 'hidden': ! open0}" x-on:click.away="open0 = false" class="hidden lg:hidden shadow-lg">
        @auth
        @if (count($notificationsCollection))
            <!-- notifications show -->
            <div class="block px-4 py-2 text-lg text-gray-800 font-bold">
                {{ __('Notifications') }}
            </div>
            @foreach ($notificationsCollection as $item)
                <a href="{{route('campaign/published', $item->data['slug'])}}" class="flex items-center px-4 py-2">
                    <div class="mr-2">
                        <img class="w-10 h-6 rounded-sm" src="{{ URL::to('/').$item->data['image_path']}}"/>
                    </div>
                    <div>
                        <div class="font-bold">{{$item->data['title']}}</div>
                        @if ($item->data['action'] == 'HELP_ME_SHARE')
                            <div>{{__('Help me share')}}</div>
                        @endif
                        <div class="text-xs text-blue-500">{{$item->created_at->diffForHumans()}}</div>
                    </div>
                </a>
            @endforeach
        @endif
        @endauth
    </div>

    <div :class="{'block': open, 'hidden': ! open}" x-on:click.away="open = false" class="hidden lg:hidden shadow-lg">

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

       <!-- 
        <div class="space-y-1">
            <x-responsive-nav-link href="{ route('about/how-it-works') }}" :active="request()->routeIs('about/how-it-works')">
              { __('How it works?') }}
            </x-responsive-nav-link>
        </div>

        <div class="space-y-1">
            <x-responsive-nav-link href="{ route('about/about-us') }}" :active="request()->routeIs('about/about-us')">
            { __('About us') }}
            </x-responsive-nav-link>
        </div>
        -->

      @auth
      <!-- Responsive Settings Options -->
      <div class="mt-2 pt-4 pb-2 border-t border-gray-200 ">
          <a  href="{{ route('user', Auth::user()->slug)}}">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        @if (Auth::user()->profile_photo_path)
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                        @else 
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
          </a>
          <div class="mt-3">
              <!-- Management Panel -->
              <div class="block pt-2 pb-1 px-4 text-xs text-gray-400">
                {{ __('Management panel') }}
              </div>
              <x-responsive-nav-link href="{{ route('your/campaigns') }}" :active="request()->routeIs('your/campaigns')">
                {{ __('Your campaigns') }}
              </x-responsive-nav-link>

              <x-responsive-nav-link href="{{ route('your/collaborations') }}" :active="request()->routeIs('your/collaborations')">
                {{ __('Your collaborations') }}
              </x-responsive-nav-link>
              <!-- Account Management -->
              <div class="block pt-2 pb-1 px-4 text-xs text-gray-400">
                {{ __('Manage account') }}
              </div>

              @if(Auth::user()->slug)
                <x-responsive-nav-link href="{{ route('user', Auth::user()->slug) }}" :active="request()->routeIs('user')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
              @endif

              <x-responsive-nav-link href="{{ route('setting/account') }}" :active="request()->routeIs('setting/account')">
                  {{ __('Account setting') }}
              </x-responsive-nav-link>

              <div class="border-t mt-2 mb-1 border-gray-200"></div>

              @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                  <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                      {{ __('API Tokens') }}
                  </x-responsive-nav-link>
              @endif

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                  @csrf

                  <x-responsive-nav-link href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                  this.closest('form').submit();">
                      {{ __('Logout') }}
                  </x-responsive-nav-link>
              </form>

              <!-- Team Management -->
              @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                  <div class="border-t border-gray-200"></div>

                  <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Manage Team') }}
                  </div>

                  <!-- Team Settings -->
                  <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                      {{ __('Team Settings') }}
                  </x-responsive-nav-link>

                  @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                      <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                          {{ __('Create New Team') }}
                      </x-responsive-nav-link>
                  @endcan

                  <div class="border-t border-gray-200"></div>

                  <!-- Team Switcher -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Switch Teams') }}
                  </div>

                  @foreach (Auth::user()->allTeams() as $team)
                      <x-switchable-team :team="$team" component="responsive-nav-link" />
                  @endforeach
              @endif
          </div>
      </div>
      @else
          <div class="border-t border-gray-200"></div>
          <div class="pt-3 pb-3 space-y-1">
              <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    <span class="border border-ys1 py-2 px-3 rounded-lg text-ys1 font-bold ">{{ __('Login') }}</span>
              </x-responsive-nav-link>
          </div>
      @endauth
    </div>
</nav>
