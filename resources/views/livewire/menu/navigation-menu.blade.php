<div>
    @if($this->option == 0)
        <!-- PERSONAL -->
        @if(!Auth::user()->organizationSession)

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

        <!-- END PERSONAL -->

        @else 
        <!-- ORGANIZATION -->
            @if (Auth::user()->organizationSession->organization)
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                    @if (Auth::user()->organizationSession->organization->logo_path)
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->organizationSession->organization->logo_path }}" alt="{{ Auth::user()->name }}" />
                    @else 
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                </button>
            @else
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        {{ Auth::user()->organizationSession->organization->name }}

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </span>
            @endif
        @endif
        <!-- END ORGANIZATION --> 
    @endif

    @if($this->option == 1)
        <!-- PERSONAL -->
        @if(!Auth::user()->organizationSession)
        <!-- END PERSONAL -->
        <span class="inline-flex rounded-md">
            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <span class="mr-2">{{ Auth::user()->name }}</span>

                  @if (Auth::user()->profile_photo_path)
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                  @else 
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  @endif
            </button>
        </span>
        @else 
        <!-- ORGANIZATION -->
        <span class="inline-flex rounded-md">
            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                  <span class="mr-2">{{ Auth::user()->organizationSession->organization->name }}</span>

                  @if (Auth::user()->organizationSession->organization->logo_path)
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->organizationSession->organization->logo_path }}" alt="{{ Auth::user()->name }}" />
                  @else 
                      <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                  @endif
            </button>
        </span>
        @endif
        <!-- END ORGANIZATION --> 
    @endif

    <!----------------------------------------------- dropdown ------------------------------------------->
    @auth
    
    <!-- PERSONAL -->
    @if(!Auth::user()->organizationSession)

    @if ($this->option == 2)
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
    
        <!-- Account Management 
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('YoSolidario Charity') }}
        </div>

        @if ($sum_organization->count() > 0)
            @foreach ($collection_organization as $item)
            <x-dropdown-link href="{{ route('campaign/saves/show') }}" :active="request()->routeIs('campaign/saves/show')">
                <div class="flex items-center text-xs text-gray-900">
                    @if($item->logo_path)
                    <div class="flex-shrink-0 w-9 h-9 cursor-pointer">
                        <img class="w-full h-full rounded-full"
                            src="{{ $host}}{{$item->logo_path}}"
                            alt="{{$item->name}}" />
                    </div>
                    @endif
                    <div class="ml-3 space-y-2">
                        <div class="cursor-pointer"> 
                            {{$item->name}}
                        </div>
                    </div>
                </div>
            </x-dropdown-link>
            
            @endforeach
        @else
            <x-dropdown-link href="{{ route('campaign/saves/show') }}" :active="request()->routeIs('campaign/saves/show')">
                <span class="material-icons-outlined text-xs">add</span>
                <span>{{__('Bussines')}}</span>
            </x-dropdown-link>
        @endif
        -->

        <!-- Account Management -->
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Manage account') }}
        </div>

        @if(Auth::user()->slug)
            <x-dropdown-link href="{{ route('user', Auth::user()) }}">
                {{ __('Profile') }}
            </x-dropdown-link>
        @endif

        @if ($sum_organization->count() > 0)
            <x-dropdown-link href="{{ route('change-account/view-account') }}" :active="request()->routeIs('change-account/view-account')">
                <span>{{__('Cambiar cuenta')}}</span>
            </x-dropdown-link>
        @else
            <x-dropdown-link href="{{ route('change-account/view-account') }}" :active="request()->routeIs('change-account/view-account')">
                <span>{{__('Account')}}</span>
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
    @endif

    @if ($this->option == 3)
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

                <x-dropdown-link href="{{ route('change-account/view-account') }}" :active="request()->routeIs('change-account/view-account')">
                    <span>{{__('Account')}}</span>
                </x-dropdown-link>

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
                    <span class="py-2 px-3 rounded-lg text-gray-900 font-semibold ">{{ __('Login') }}</span>
                </x-responsive-nav-link>
            </div>
        @endauth
    @endif
    
    <!-- END PERSONAL -->

    @else 
        <!-- ORGANIZATION -->
        @if ($this->option == 2)
        <!-- Management Panel -->
        <div class="block px-4 py-2 text-xs text-gray-400">
            {{ __('Management panel') }}
        </div>

        <!-- My campaigns -->
        <x-dropdown-link href="{{ route('organization/campaigns') }}">
            {{ __('Campaigns') }}
        </x-dropdown-link>
        
        <!-- My collaborations -->
        <x-dropdown-link href="{{ route('your/collaborations') }}">
            {{ __('Collections') }}
        </x-dropdown-link>

        <!-- My collaborations -->
        <x-dropdown-link href="{{ route('your/collaborations') }}">
            {{ __('Withdrawals') }}
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

        @if ($sum_organization->count() > 0)
        <x-dropdown-link href="{{ route('change-account/view-account') }}" :active="request()->routeIs('change-account/view-account')">
            <span>{{__('Cambiar cuenta')}}</span>
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
        @endif
    @endif
    <!-- END ORGANIZATION --> 
    @endauth
</div>
