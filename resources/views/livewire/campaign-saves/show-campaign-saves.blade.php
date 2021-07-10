<x-slot name="title">
    {{__('Saved campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
   
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
      
<div class="mt-20 bg-gray-50">
<x-section-content>
    <x-slot name="header">
        <div class="bg-white shadow mb-10"> 
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 space-y-2 sm:space-y-0 py-6">
                <div class=" font-semibold text-xl text-gray-800">
                    {{ __('Saved campaigns') }}
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
    @include('livewire.campaign-saves.modal-campaign-saves')
    @if ($collection->count() > 0)

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7 ">
    @foreach ($collection as $item)
    <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
        <div wire:click="view({{$item->campaign->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
            style="background-image: url({{ URL::to('/').$item->campaign->image->url}})">
        </div>

        <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
            <div class="text-xl font-bold h-16">
                {{$item->campaign->title}}
            </div>

            <div class="space-x-1">
                <span>{{__('Campaign created')}}</span>
                <span>{{ \Carbon\Carbon::parse($item->campaign->created_at)->diffForHumans() }}</span>
            </div>
        <!-- percentage 
        <div class="flex justify-between items-start pt-3">
            <div class=" m-2 flex justify-between items-center text-sm">
                <i class="uil uil-stopwatch"></i>
                <div class="justify-between items-center">
                    {$item->campaign->period}} {__('days')}}
                </div>
            </div>
            <div class=" m-2 flex justify-between items-center text-sm">
                <div class="justify-between items-center">
                    {$item->campaign->campaignCollected->amount_percentage_collected}} %
                </div>
            </div>
        </div>
      -->
        <!-- -->
        <div class="flex justify-end my-3">
            <div class="flex items-center ">
                @if($item->campaign->user->profile_photo_path)
                <div wire:click="viewUser({{$item->campaign->user->id}})" wire:loading.attr="disabled" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full object-cover"
                        src="{{ URL::to('/') }}{{$item->campaign->user->profile_photo_path}}"
                        alt="" />
                </div>
                @else 
                <div wire:click="viewUser({{$item->campaign->user->id}})" class="flex-shrink-0 w-12 h-12 cursor-pointer">
                    <img class="w-full h-full rounded-full"
                        src="{{ $item->campaign->user->profile_photo_url }}" alt="{{ $item->campaign->user->name }}" />
                </div>
                @endif
                <div class="ml-3 space-y-2">
                    <div wire:click="viewUser({{$item->campaign->user->id}})" class="text-gray-700 text-sm sm:text-base cursor-pointer"> 
                        <span class="font-bold">{{__('Organizator')}}: </span>
                        {{$item->campaign->user->name}}
                    </div>
                </div>
            </div>
        </div>
        <!-- -->
        <div class="h-1 relative max-w-xl rounded-full overflow-hidden mt-2">
            <div class="w-full h-full bg-gray-200 absolute"></div>
            <div class="h-full bg-green-500 absolute" style="width:{{$item->campaign->campaignCollected->amount_percentage_collected}}%"></div>
        </div>
        <!-- -->
        <div class=" space-x-0 mt-3 campaigns-start">
            <span class="text-xl font-bold">
                {{ number_format($item->campaign->campaignCollected->amount_collected, 2 ) }}
                {{$item->campaign->agency->agencySetting->money->currency_symbol}}
            </span>
            <span class="lowercase">{{__('Raised from the goal of')}} </span>
            <span class="font-bold">
                {{ number_format($item->campaign->campaignCollected->amount_target, 2 ) }}
                {{$item->campaign->agency->agencySetting->money->currency_symbol}}
            </span>
        </div>
      
      <!-- -->
      <hr class="mt-5 mb-5">
      <div class=" mt-5 sm:mt-3">
        <x-secondary-button wire:click="deleteSave({{$item->id}})" wire:loading.attr="disabled" class="w-full justify-center">
            <span class="material-icons-outlined text-red-500">delete</span>
            {{__('Delete from saved')}}
        </x-secondary-button>
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
                {{ __('When you ask us to remind you about one, it’ll show up here.') }}
            </h2>
            <p class="mt-3 mb-16 text-center">
                <x-button wire:click="discoverCampaign" wire:loading.attr="disabled">
                    <span class="material-icons-outlined pr-1">bookmark_add</span>
                    <span class="text-base">{{ __('Discover campaigns') }}</span>
                </x-button>
            </p>
          </div>
    
        </div>
    </div>
    @endif
    </x-slot>
</x-section-content>
<livewire:footer.footer-app/>
