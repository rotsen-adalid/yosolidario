<x-slot name="title">
    {{__('My campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@3.0.6/css/line.css">
</x-slot>
<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="sm:flex justify-between items-start max-w-7xl mx-auto px-4 sm:px-0 lg:px-0 pb-6 space-y-2">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-4">
                    {{ __('My campaigns') }}
                </h2>
    
            </div>
        </header>
    </x-slot>
    <x-slot  name="content">
    @if ($collection->count() > 0)

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7 ">
    @foreach ($collection as $item)
    <div class="px-4 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
        <div wire:click="preview({{$item->id}})" wire:loading.attr="disabled" class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
            style="background-image: url({{ URL::to('/').$item->image->url}})">
        </div>

        <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
    
        <p x-data="{length: 30}"
            x-init="originalContent = $el.firstElementChild.textContent.trim()">
            <span class="title-post font-semibold text-xl mb-2" x-text="originalContent.slice(0, length)">{{$item->title}}</span>
            <button x-show="length">...</button>
            <!-- <button x-cloak @click="length = undefined" x-show="length">...</button> -->
        </p>

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
            @elseif ($item->status == 'IN_REVIEW')
                <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-green-100">
                    <div class="h-2 w-2 rounded-full m-1 bg-green-500 " ></div>
                </div>
                <div>{{__('Published')}}</div>
            @endif
       </div>
        <!-- percentage -->
        <div class="flex justify-between items-start pt-3">
            <div class=" m-2 flex justify-between items-center text-sm">
                <i class="uil uil-stopwatch"></i>
                <div class="justify-between items-center">
                    {{$item->period}} {{__('days')}}
                </div>
            </div>
            <div class=" m-2 flex justify-between items-center text-sm">
                <div class="justify-between items-center">
                    {{$item->amount_percentage_collected}} %
                </div>
            </div>
        </div>
      <!-- -->
      <div class="h-1 relative max-w-xl rounded-full overflow-hidden">
        <div class="w-full h-full bg-gray-200 absolute"></div>
        <div class="h-full bg-green-500 absolute" style="width:{{$item->amount_percentage_collected}}%"></div>
      </div>
      <!-- -->
      <div class="flex mt-2 justify-between items-start">
          <div class=" m-2  text-sm">
              <div class="text-center">{{$item->amount_collected}} {{$item->country->currency_symbol}}</div>
              <div>{{__('collected')}}</div>
          </div>
          <div class=" m-2 text-sm">
              <div class="text-center">{{$item->collaborators}}</div>
              <div>{{__('collaborators')}}</div>
          </div>
      </div>
      <!-- -->
      <hr class="mt-2 mb-5">
      <div class="flex justify-between items-start mt-5 sm:mt-0">
        @if ($item->status == 'DRAFT')
            <x-button wire:click="editCampaign({{$item->id}})" wire:loading.attr="disabled">
                {{ __('Edit') }}
            </x-button>
            <x-secondary-button wire:click="preview({{$item->id}})" wire:loading.attr="disabled">
                {{ __('preview') }}
            </x-secondary-button>
        @elseif ($item->status == 'IN_REVIEW')
            <x-button wire:click="preview({{$item->id}})" wire:loading.attr="disabled">
                {{ __('preview') }}
            </x-button>
        @elseif ($item->status == 'PUBLISHED')
            <x-secondary-button wire:click="manage({{$item->id}})" wire:loading.attr="disabled">
                {{ __('Manage') }}
            </x-secondary-button>
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
<livewire:footer/>