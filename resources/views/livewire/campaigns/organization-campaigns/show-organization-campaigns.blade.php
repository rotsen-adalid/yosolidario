<x-slot name="title">
    {{__('Your campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
   
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel-organization/>
</x-slot>
      
<div class="mt-20 bg-gray-50">
    
<x-section-content>
    <x-slot name="header">
        <div class="bg-white shadow-md mb-10"> 
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 space-y-2 sm:space-y-0 py-6">
                <div class="bg-green-50 py-1 px-2 rounded-full font-semibold text-base sm:text-base text-ys2">
                    {{ __('Campaigns') }}
                </div>
                <div>
                    <x-button-link href="{{ route('campaign/create') }}">
                        <span class="material-icons-outlined mr-1">add</span>
                        <span>{{__('Start a campaign')}}</span>
                    </x-button-link>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
    @if ($collection->count() > 0)

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7 ">
    @foreach ($collection as $item)
    <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif border border-gray-100 rounded">
        <div wire:click="view({{$item->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-36 w-full rounded shadow bg-cover bg-center " 
            style="background-image: url({{ URL::to('/').$item->image->url}})">
            
            <div class="flex items-center space-x-1 p-2">
                @if($item->user->profile_photo_path)
                    <div wire:click="viewOrganization({{$item->organization->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-10 h-10 cursor-pointer">
                        <img class="w-full h-full rounded-full object-cover"
                            src="{{URL::to('/').$item->user->profile_photo_path}}"
                            alt="{{$item->user->name}}" />
                    </div>
                @else
                    <div wire:click="viewOrganization({{$item->organization->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-10 h-10 cursor-pointer">
                        <img class="w-full h-full rounded-full object-cover"
                            src="{{URL::to('/').$item->user->profile_photo_url}}"
                            alt="{{$item->user->name}}" />
                    </div>
                @endif
                <div class="bg-white rounded-full p-2 text-gray-700 text-sm cursor-pointer truncate-single-line">
                    {{$item->user->name}}
                </div>
            </div>
            
        </div>

        <div class=" w-full bg-white -mt-10 shadow rounded overflow-hidden p-5">
            <div class="text-xl font-bold truncate-single-line">
                {{$item->title}}
            </div>

            <!-- status -->
            <div class="flex header-content inline-flex mt-2">
                @if ($item->status == 'DRAFT')
                <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-red-100">
                    <div class="h-2 w-2 rounded-full m-1 bg-red-500 " ></div>
                </div>
                <div>{{__('Draf')}}</div>
                @elseif ($item->status == 'IN_REVIEW')
                    <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-yellow-100">
                        <div class="h-2 w-2 rounded-full m-1 bg-yellow-500" ></div>
                    </div>
                    <div>{{__('In review')}}</div>
                @elseif ($item->status == 'PUBLISHED')
                    <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-green-100">
                        <div class="h-2 w-2 rounded-full m-1 bg-green-500 " ></div>
                    </div>
                    @if ($item->campaignCollected->status_collected == 'IN_COLLECTION')
                        <div>{{__('In campaign')}}</div>
                    @elseif ($item->campaignCollected->status_collected == 'COLLECTION_CLOSING')
                        <div>{{__('Campaing closed')}}</div>
                    @elseif ($item->campaignCollected->status_collected == 'COLLECTION_FINALIZED')
                        <div>{{__('Campaing finalized')}}</div>
                    @endif
                @elseif ($item->status == 'INACTIVE')
                    @if ($item->campaignOpeningRequest)
                        @if ($item->campaignOpeningRequest->status == 'REJECTED')
                            <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-red-100">
                                <div class="h-2 w-2 rounded-full m-1 bg-red-500 " ></div>
                            </div>
                            <div>{{__('Rejected')}}</div>
                        @elseif($item->campaignCollected->status_collected == 'COLLECTION_SUSPENDED')
                            <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-red-100">
                                <div class="h-2 w-2 rounded-full m-1 bg-red-500 " ></div>
                            </div>
                            <div>{{__('Campaign suspended')}}</div>
                        @endif
                    @endif
                   
                @endif
            </div>
            <div class="space-x-1">
                <span>{{__('Created')}}</span>
                <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
            </div>
        <!-- percentage 
        <div class="flex justify-between items-start pt-3">
            <div class=" m-2 flex justify-between items-center text-sm">
                <i class="uil uil-stopwatch"></i>
                <div class="justify-between items-center">
                    {$item->period}} {__('days')}}
                </div>
            </div>
            <div class=" m-2 flex justify-between items-center text-sm">
                <div class="justify-between items-center">
                    {$item->campaignCollected->amount_percentage_collected}} %
                </div>
            </div>
        </div>
      -->
      <!-- -->
        <div class="hidden justify-between items-start">
            <div class=" m-2  text-sm">
                
            </div>
            <div class=" m-2 text-sm">
                <div class="text-center">{{$item->campaignCollected->collaborators}}</div>
                <div class="lowercase">{{__('Collaborators')}}</div>
            </div>
        </div>
        <!-- -->
        <div class="h-1   rounded-full  mt-5">
            <div class="w-full h-full bg-green-100  bg-opacity-40"></div>
            <div class="h-full bg-green-500 -mt-1" style="width:{{$item->campaignCollected->amount_percentage_collected}}%"></div>
        </div>
        <!-- -->
        <div class="truncate-single-line space-x-0 mt-3 campaigns-start">
            <span class="text-xl font-bold">
                {{ number_format($item->campaignCollected->amount_collected, 2 ) }}
                {{$item->agency->agencySetting->money->currency_symbol}}
            </span>
            <span class="lowercase">{{__('Raised from the goal of')}} </span>
            <span class="font-bold">
                {{ number_format($item->campaignCollected->amount_target, 2 ) }}
                {{$item->agency->agencySetting->money->currency_symbol}}
            </span>
        </div>
      
      <!-- -->
      <hr class="mt-5 mb-5">
      <div class="flex justify-between mt-5 sm:mt-3 h-9 items-center">
        @if ($item->status == 'DRAFT')
            <span wire:click="editCampaign({{$item->id}})" wire:loading.attr="disabled" 
                class="material-icons-outlined text-xl font-bold cursor-pointer border border-gray-100 shadow-lg px-2 py-1 rounded-lg">edit</span>
            <span wire:click="view({{$item->id}})" wire:loading.attr="disabled"
                class="material-icons-outlined text-xl font-bold cursor-pointer border border-gray-100 shadow-lg px-2 py-1 rounded-lg">remove_red_eye</span>
        @elseif ($item->status == 'IN_REVIEW')
            <x-secondary-button class="w-full justify-center" wire:click="view({{$item->id}})" wire:loading.attr="disabled">
                <span class="material-icons-outlined pr-1">remove_red_eye</span>
                <span class="text-base capitalize">{{ __('See publication') }}</span>
            </x-secondary-button>
        @elseif ($item->status == 'PUBLISHED')
            @if ($item->type_campaign == 'PERSONAL_ORGANIZATION')
                <x-secondary-button class="w-full justify-center" wire:click="view({{$item->id}})" wire:loading.attr="disabled">
                    <span class="material-icons-outlined pr-1">remove_red_eye</span>
                    <span class="text-base capitalize">{{ __('See publication') }}</span>
                </x-secondary-button>
            @elseif($item->type_campaign == 'ORGANIZATION')
                <x-secondary-button class="w-full justify-center" wire:click="manage({{$item->id}})" wire:loading.attr="disabled">
                    <span class="text-base capitalize text-ys1">{{ __('Manage') }}</span>
                </x-secondary-button>
            @endif
        @endif
      </div>

      </div>
    </div>
    
    @endforeach
    </div>

    @else
    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
          <div> 
            <h2 class="mt-6 text-center text-xl font-light">
                {{ __('You have no campaigns') }}
            </h2>
            <p class="mt-3 mb-16 text-center">
                <x-button wire:click="createCampaign" wire:loading.attr="disabled">
                    <span class="material-icons-outlined pr-1">add</span>
                    <span class="text-base">{{ __('Start a campaign') }}</span>
                </x-button>
            </p>
          </div>
        </div>
    </div>
    @endif
  </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>