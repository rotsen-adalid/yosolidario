<div class="bg-white shadow mb-10 w-full">
    @livewire('campaigns.manage.menu.shared-manage', ['campaign' => $campaign]) 
    <div class="flex flex-row justify-between sm:items-center max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 space-y-2 sm:space-y-0">
        <div class="text-gray-900">
            
            <a  href="{{ route('your/campaigns') }}" class="cursor-pointer my-4 border border-gray-300 py-1 px-2 flex space-x-1 w-20">
                <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                <span class="font-bold">{{__('Back')}}</span>
            </a>

            <div class="flex space-x-4 items-center">
                <div>
                    <img src="{{ URL::to('/').$campaign->image->url}}" alt="{{$campaign->title}}" class="h-24">
                </div>
                <div>
                    <a href="{{ route('campaign/published', $campaign->id) }}" class="font-bold text-2xl cursor-pointer">
                        {{$campaign->title}}
                    </a>
                    <div class="flex space-x-3 items-center py-2">
                        <!-- 
                        <div class="flex space-x-1 items-center cursor-pointer">
                            <span class="material-icons-outlined text-base">edit</span>
                            <span class="underline text-base">{{__('Setting')}}</span>
                        </div>
                        -->
                        <a href="{{ route('campaign/published', $campaign->slug) }}" class="flex space-x-1 items-center cursor-pointer">
                            <span class="material-icons-outlined text-base">visibility</span>
                            <span class="underline text-base">{{__('View fundraiser')}}</span>
                        </a>
                    </div>
                    <!-- -->
                    <div class="h-1  rounded-full  mt-2 w-72">
                        <div class="w-full h-full bg-green-100 rounded-full"></div>
                        <div class="h-full w-auto bg-green-500 -mt-1 rounded-full" style="width:{{$campaign->campaignCollected->amount_percentage_collected}}%"></div>
                    </div>
                    <!-- -->
                    <div class=" space-x-2 mt-1 campaigns-start">
                        <span class="text-lg font-bold">
                            {{ number_format($campaign->campaignCollected->amount_collected, 2 ) }}
                            {{$campaign->agency->agencySetting->money->currency_symbol}}
                        </span>
                        <span>{{__('Raised from the goal of')}} </span>
                        <span class="font-bold">
                            {{ number_format($campaign->campaignCollected->amount_target, 2 ) }}
                            {{$campaign->agency->agencySetting->money->currency_symbol}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex space-x-8 pt-5">
           
            <div wire:click="$emit('sharedOpen')" class="cursor-pointer">
                <div class="flex justify-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center bg-ys1">
                        <span class="material-icons-outlined text-white text-3xl">file_upload</span>
                    </div>
                </div>
                <div class="mt-1 flex justify-center font-bold underline">{{__('Share')}}</div>
            </div>
            <div class="cursor-pointer" wire:click="registerUpdate" wire:loading.attr="disabled">
                <div class="flex justify-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center border border-ys1">
                        <span class="material-icons-outlined text-ys1 text-3xl">add_box</span>
                    </div>
                </div>
                <div  class="mt-1 flex justify-center font-bold underline">{{__('Add update')}}</div>
            </div>
            <div>
                <div class="flex justify-center">
                    <div class="rounded-full h-12 w-12 flex items-center justify-center border border-ys1">
                        <span class="material-icons-outlined text-ys1 text-3xl">account_balance</span>
                    </div>
                </div>
                <div class="mt-1 flex justify-center font-bold underline">{{__('Withdrawals')}}</div>
            </div>
        </div>
    </div>
    <div class="flex justify-between max-w-6xl mx-auto px-4 sm:px-4 lg:px-4  h-10 mt-5">
        <div class="flex">
            @if (Route::currentRouteName() === 'campaign/manage/collaborations')
                <div class="space-x-0 -my-px sm:ml-0 flex">
                    <x-nav-link href="{{ route('campaign/manage/collaborations', $campaign) }}" :active="request()->routeIs('campaign/manage/collaborations')">
                        {{ __('Collaborators') }}
                    </x-nav-link>
                </div>

            @elseif (Route::currentRouteName() == 'campaign/manage')

            <div class="space-x-0 -my-px sm:ml-0 flex">
                <x-nav-link href="{{ route('campaign/manage/collaborations', $campaign) }}" :active="request()->routeIs('campaign/manage')">
                    {{ __('Collaborators') }}
                </x-nav-link>
            </div>

            @else 
                <div class="space-x-0 -my-px sm:ml-0 flex">
                    <x-nav-link href="{{ route('campaign/manage/collaborations', $campaign) }}" :active="request()->routeIs('campaign/manage/collaborations')">
                        {{ __('Collaborators') }}
                    </x-nav-link>
                </div>

            @endif
            <div class="space-x-8 -my-px ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/reward-collaborators', $campaign) }}" :active="request()->routeIs('campaign/manage/reward-collaborators')">
                    {{ __('Rewards') }}
                </x-nav-link>
            </div>

            <div class="space-x-8 -my-px ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/communications/show', $campaign) }}" :active="request()->routeIs('campaign/manage/communications/show')">
                    {{ __('Updates') }}
                </x-nav-link>
            </div>
    
            <div class="space-x-8 -my-px  ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/comments', $campaign) }}" :active="request()->routeIs('campaign/manage/comments')">
                    {{ __('Comments') }}
                </x-nav-link>
            </div>
    
           <!-- 
             <div class="space-x-8 -my-px  ml-2 sm:ml-10 flex">
                <x-nav-link href="{ route('campaign/manage/teams', $campaign) }}" :active="request()->routeIs('campaign/manage/teams')">
                    { __('Teams') }}
                </x-nav-link>
            </div>
            -->
        </div>
    </div>
</div>
