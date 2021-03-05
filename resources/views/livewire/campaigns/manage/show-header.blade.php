<div class="bg-white shadow mb-10"> 
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-4">
        <div class="text-gray-900">
            <div class="font-bold text-lg ">{{$campaign->title}}</div>
            <!-- -->
            <div class="h-2 relative max-w-xl rounded-full overflow-hidden mt-2">
                <div class="w-full h-full bg-gray-200 absolute"></div>
                <div class="h-full bg-green-500 absolute" style="width:{{$campaign->campaignCollected->amount_percentage_collected}}%"></div>
            </div>
            <!-- -->
            <div class=" space-x-2 mt-3 campaigns-start">
                <span class="text-lg font-bold">
                    {{ number_format($campaign->campaignCollected->amount_collected, 2 ) }}
                    {{$campaign->agency->country->currency_symbol}}
                </span>
                <span>{{__('raised from the goal of')}} </span>
                <span class="font-bold">
                    {{ number_format($campaign->campaignCollected->amount_target, 2 ) }}
                    {{$campaign->agency->country->currency_symbol}}
                </span>
            </div>
        </div>
        <div class="flex space-x-4">
            <div wire:click="shared" class="cursor-pointer">
                <div class="flex justify-center">
                    <svg class="h-10" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g>
                        <path d="m437.02 74.98c-48.353-48.351-112.64-74.98-181.02-74.98s-132.667 26.629-181.02 74.98c-48.351 48.353-74.98 112.64-74.98 181.02s26.629 132.667 74.98 181.02c48.353 48.351 112.64 74.98 181.02 74.98s132.667-26.629 181.02-74.98c48.351-48.353 74.98-112.64 74.98-181.02s-26.629-132.667-74.98-181.02zm-181.02 407.02c-124.617 0-226-101.383-226-226s101.383-226 226-226 226 101.383 226 226-101.383 226-226 226z"/><path d="m336 211c30.327 0 55-24.673 55-55s-24.673-55-55-55-55 24.673-55 55c0 4.329.519 8.537 1.469 12.581l-87.523 48.623c-9.965-10.003-23.744-16.204-38.946-16.204-30.327 0-55 24.673-55 55s24.673 55 55 55c15.202 0 28.981-6.201 38.946-16.204l87.523 48.623c-.95 4.044-1.469 8.252-1.469 12.581 0 30.327 24.673 55 55 55s55-24.673 55-55-24.673-55-55-55c-15.202 0-28.981 6.201-38.946 16.204l-87.523-48.623c.95-4.043 1.469-8.251 1.469-12.581s-.519-8.537-1.469-12.581l87.523-48.623c9.965 10.003 23.744 16.204 38.946 16.204zm0 120c13.785 0 25 11.215 25 25s-11.215 25-25 25-25-11.215-25-25 11.215-25 25-25zm-180-50c-13.785 0-25-11.215-25-25s11.215-25 25-25 25 11.215 25 25-11.215 25-25 25zm180-150c13.785 0 25 11.215 25 25s-11.215 25-25 25-25-11.215-25-25 11.215-25 25-25z"/></g>
                    </svg>
                </div>
                <div class="mt-1 flex justify-center font-semibold">{{__('Share')}}</div>
            </div>
            <div>
                <div class="flex justify-center">
                    <svg class="h-10" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m498 447h-482c-9.284 3-16 9.716-16 18v32c0 8.284 6.716 15 15 15h482c8.284 0 15-6.716 15-15v-32c0-8.284-6.716-15-14-18z"/><path d="m502.749 101.146-241-100c-3.681-1.527-7.817-1.527-11.498 0l-241 100c-5.601 2.323-9.251 7.791-9.251 13.854v30c0 8.284 6.716 15 15 15h482c8.284 0 15-6.716 15-15v-30c0-6.063-3.65-11.531-9.251-13.854zm-156.749 13.854h-180c-8.284 0-15-6.716-15-15s6.716-15 15-15h180c8.284 0 15 6.716 15 15s-6.716 15-15 15z"/><path d="m28.5 390v30h115v-30c0-8.284-6.716-15-15-15h-85c-8.284 0-15 6.716-15 15z"/><path d="m48.5 190h75v155h-75z"/><path d="m388.5 190h75v155h-75z"/><path d="m368.5 390v30h115v-30c0-8.284-6.716-15-15-15h-85c-8.284 0-15 6.716-15 15z"/><path d="m256 350c-8.271 0-15-6.729-15-15 0-8.284-6.716-15-15-15s-15 6.716-15 15c0 19.555 12.541 36.228 30 42.42v7.58c0 8.284 6.716 15 15 15s15-6.716 15-15v-7.58c17.459-6.192 30-22.865 30-42.42 0-24.813-20.187-45-45-45-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15c0 8.284 6.716 15 15 15s15-6.716 15-15c0-19.555-12.541-36.228-30-42.42v-7.58c0-8.284-6.716-15-15-15s-15 6.716-15 15v7.58c-17.459 6.192-30 22.865-30 42.42 0 24.813 20.187 45 45 45 8.271 0 15 6.729 15 15s-6.729 15-15 15z"/>
                    </svg>
                </div>
                <div class="mt-1 flex justify-center font-semibold">{{__('Withdrawals')}}</div>
            </div>
        </div>
    </div>
    <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  h-10">
        <div class="flex">
            <div class="space-x-0 -my-px sm:ml-0 flex">
                <x-nav-link href="{{ route('campaign/manage/collaborations', $campaign) }}" :active="request()->routeIs('campaign/manage/collaborations')">
                    {{ __('Collaborations ') }}
                </x-nav-link>
            </div>
    
            <div class="space-x-8 -my-px ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/updates', $campaign) }}" :active="request()->routeIs('campaign/manage/updates')">
                    {{ __('Updates') }}
                </x-nav-link>
            </div>
    
            <div class="space-x-8 -my-px  ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/comments', $campaign) }}" :active="request()->routeIs('campaign/manage/comments')">
                    {{ __('Comments') }}
                </x-nav-link>
            </div>
    
            <div class="space-x-8 -my-px  ml-2 sm:ml-10 flex">
                <x-nav-link href="{{ route('campaign/manage/teams', $campaign) }}" :active="request()->routeIs('campaign/manage/teams')">
                    {{ __('Teams') }}
                </x-nav-link>
            </div>

        </div>
    </div>
    @include('livewire.campaigns.published.shared-published')
</div>
