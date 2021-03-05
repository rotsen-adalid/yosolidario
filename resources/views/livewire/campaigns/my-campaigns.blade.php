<x-slot name="title">
    {{__('My campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div class="bg-gray-50">
<x-section-content>
    <x-slot name="header">
        <div class="bg-white shadow mb-10"> 
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-6">
                <div class=" font-semibold text-xl text-gray-800">
                    {{ __('My campaigns') }}
                </div>
                <div>
                    <a  href="{{ route('campaign/create') }}" class="w-full px-4 py-2 sm:py-3 text-center border bg-ys1 rounded-md font-bold text-base text-white tracking-widest hover:bg-ys2 active:bg-ys2 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="uil uil-plus text-base"></i>
                        <span>{{__('Start campaign')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
    @if ($collection->count() > 0)

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7 ">
    @foreach ($collection as $item)
    <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
        <div wire:click="view({{$item->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
            style="background-image: url({{ URL::to('/').$item->image->url}})">
        </div>

        <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
            <div class="text-xl font-bold">
                {{$item->title}}
            </div>

            <!-- status -->
            <div class="flex header-content inline-flex ">
                @if ($item->status == 'DRAFT')
                <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-yellow-100">
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
                    <div>{{__('Published')}}</div>
                @endif
            </div>
            <div class="space-x-1">
                <span>{{__('Campaign created ')}}</span>
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
        <div class="flex justify-between items-start">
            <div class=" m-2  text-sm">
                
            </div>
            <div class=" m-2 text-sm">
                <div class="text-center">{{$item->campaignCollected->collaborators}}</div>
                <div>{{__('collaborators')}}</div>
            </div>
        </div>
        <!-- -->
        <div class="h-1 relative max-w-xl rounded-full overflow-hidden mt-2">
            <div class="w-full h-full bg-gray-200 absolute"></div>
            <div class="h-full bg-green-500 absolute" style="width:{{$item->campaignCollected->amount_percentage_collected}}%"></div>
        </div>
        <!-- -->
        <div class=" space-x-2 mt-3 campaigns-start">
            <span class="text-xl font-bold">
                {{ number_format($item->campaignCollected->amount_collected, 2 ) }}
                {{$item->agency->country->currency_symbol}}
            </span>
            <span>{{__('raised from the goal of')}} </span>
            <span class="font-bold">
                {{ number_format($item->campaignCollected->amount_target, 2 ) }}
                {{$item->agency->country->currency_symbol}}
            </span>
        </div>
      
      <!-- -->
      <hr class="mt-5 mb-5">
      <div class="flex justify-between items-start mt-5 sm:mt-3">
        @if ($item->status == 'DRAFT')
            <x-button wire:click="editCampaign({{$item->id}})" wire:loading.attr="disabled">
                {{ __('Edit') }}
            </x-button>
            <x-secondary-button wire:click="view({{$item->id}})" wire:loading.attr="disabled">
                {{ __('preview') }}
            </x-secondary-button>
        @elseif ($item->status == 'IN_REVIEW')
            <x-button wire:click="view({{$item->id}})" wire:loading.attr="disabled">
                {{ __('preview') }}
            </x-button>
        @elseif ($item->status == 'PUBLISHED')
            <button wire:click="manage({{$item->id}})" wire:loading.attr="disabled" class="w-full px-4 py-2 text-center border border-ys1 rounded-md font-bold text-base  text-ys1 tracking-widest hover:text-ys2 hover:border-ys2 focus:border-bg-ys2 active:bg-ys2 focus:outline-none focus:border-bg-ys2 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <span>{{__('Manage')}}</span>
            </button>
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
            <p class="mt-2 mb-16 text-center">
                <x-button wire:click="createCampaign" wire:loading.attr="disabled">
                    {{ __('Create campaign') }}
                </x-button>
            </p>
          </div>
    
        </div>
    </div>
    @endif
  </x-slot>
</x-section-content>
</div>
<livewire:footer/>