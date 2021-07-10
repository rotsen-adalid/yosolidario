<x-slot name="title">
    {{$campaign->title}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel-user/>
</x-slot>
      
<div class="mt-16 sm:mt-20 bg-white">
<x-section-content>
    <x-slot name="header">
       
        <div class="hidden lg:flex lg:items-center">
            <livewire:campaigns.manage.menu.menu-header :campaign="$campaign"/>
        </div>
        <!-- Responsive -->
        <div class="lg:hidden">
            @livewire('campaigns.manage.menu.shared-manage', ['campaign' => $campaign]) 
            <div class="bg-gray-100 m-auto h-64 mt-5" style="background-image:url('{{ URL::to('/').$campaign->image->url}}?auto=compress&cs=tinysrgb&h=350'); background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="flex flex-row items-end h-full w-full">
                  <div class="flex flex-col w-full pb-3 pt-16 px-3 bg-gradient-to-t from-black text-gray-100">
                    <h3 class="text-2xl font-bold leading-5 uppercase space-y-2">{{$campaign->title}}</h3>
                    <div class="inline-flex items-center">
                      <span class="capitalize font-base text-sm my-2 mr-1 underline">{{__('View')}}</span>
                    </div>
                    <!-- -->
                    <div class="h-1 relative  rounded-full  mt-2">
                        <div class="w-full h-full bg-green-100  bg-opacity-40"></div>
                        <div class="h-full bg-green-500 -mt-1" style="width:{{$campaign->campaignCollected->amount_percentage_collected}}%"></div>
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
            <div class="p-2 shadow-lg">
                <div class="grid grid-cols-2 gap-2">
                    <x-button class=" flex justify-center" wire:click="$emit('sharedOpen')" wire:loading.attr="disabled">
                        <span class="material-icons-outlined text-white text-opacity-80">file_upload</span>
                        <span class="text-base font-bold">{{ __('Share') }}</span>
                    </x-button>
                    <x-secondary-button class=" justify-center -py-2" wire:click="addUpdates" wire:loading.attr="disabled">
                        <span class="text-base font-bold">{{ __('Post update') }}</span>
                    </x-secondary-button>
                </div>
                
            </div>
            <div class="mt-5 px-4">
                <a href="{{ route('campaign/manage/collaborations', $campaign) }}" class="flex justify-between items-center py-4">
                    <span class="text-base">{{__('Collaborators')}}</span>
                    <span class="material-icons-outlined text-gray-700 ">arrow_forward_ios</span>
                </a>
                <a href="{{ route('campaign/manage/reward-collaborators', $campaign) }}" class="flex justify-between items-center border-t py-4">
                    <span class="text-base">{{__('Rewards')}}</span>
                    <span class="material-icons-outlined text-gray-700">arrow_forward_ios</span>
                </a>
                <a href="{{ route('campaign/manage/communications/show', $campaign) }}" class="flex justify-between items-center border-t py-4">
                    <span class="text-base">{{__('Updates')}}</span>
                    <span class="material-icons-outlined text-gray-700">arrow_forward_ios</span>
                </a>
                <a href="{{ route('campaign/manage/comments', $campaign) }}" class="flex justify-between items-center border-t py-4">
                    <span class="text-base">{{__('Comments')}}</span>
                    <span class="material-icons-outlined text-gray-700">arrow_forward_ios</span>
                </a>
                <div class="flex justify-between items-center border-t py-4">
                    <span class="text-base">{{__('Withdrawals')}}</span>
                    <span class="material-icons-outlined text-gray-700">arrow_forward_ios</span>
                </div>
                <div class="flex justify-between items-center border-t py-4">
                    <span class="text-base">{{__('Setting')}}</span>
                    <span class="material-icons-outlined text-gray-700">arrow_forward_ios</span>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
        <div class="hidden lg:flex">
            @livewire('campaigns.manage.collaborations.show-collaborations', ['campaign' => $campaign])
        </div>
    </x-slot>
</x-section-content>

</div>
<livewire:footer.footer-app/>