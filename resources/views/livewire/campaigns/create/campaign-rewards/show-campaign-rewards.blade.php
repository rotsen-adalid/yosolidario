<x-slot name="title">
    {{__('Rewards')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-campaign-create :campaign="$campaign"/>
    <livewire:campaigns.create.send-review :campaign="$campaign"/>
</x-slot>
      
<div class="pt-20 bg-gray-50">
    @livewire('campaigns.create.campaign-rewards.delete-campaign-reward')
    <div class="max-w-6xl mx-auto px-4 sm:px-4 py-5 sm:py-10">
        <x-section-title>
            <x-slot name="title">
                <x-secondary-button wire:click="register" wire:loading.attr="disabled">
                    <span class="material-icons-outlined pr-1">add</span>
                    <span class=""> 
                        {{ __('Reward') }}
                    </span>
                </x-secondary-button>
            </x-slot>
            <x-slot name="description">
                <span class="text-sm sm:text-base">
                    {{__('Rewards are amounts that you suggest to your community of contributors and that will help them measure the impact of their contribution. Get inspired by the default collaborations and feel free to edit them according to your needs and if you need to add more.')}}
                </span>
            </x-slot>
        </x-section-title>

        @if ($collection->count() > 0)
            
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-7">
            @foreach ($collection as $item)
            <div class="px-4 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
            
                @if($item->image_url)
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow bg-cover bg-center" 
                        style="background-image: url({{ URL::to('/').$item->image_url}})">
                    </div>
                @else
                    <!-- 
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
                        style="background-image: url({asset('images/photo_upload.png')}})">
                    </div>
                    -->
                    <div class="flex justify-center items-center px-6 pt-5 pb-6  bg-gray-200  rounded-md w-full h-56">
                        <div class="space-y-1 text-center">
                        <span class="material-icons-outlined text-5xl text-gray-500">photo</span>
                        <p class="text-xs text-gray-500">
                            {{__('PNG, JPG up to 2MB')}}
                        </p>
                        </div>
                    </div>
                @endif
                
                <div class=" w-full bg-white -mt-10 shadow rounded-lg overflow-hidden p-5">
                
                    <div class="title-post font-semibold text-xl">{{$item->amount}} 
                        {{$item->campaign->agency->agencySetting->money->currency_symbol}}</div>
              
                    <!-- description -->
                    <div class="summary-post text-base text-justify mt-4">
                        {{$item->description}}
                    </div>
                    <!-- collaboratos -->
                    <div class="header-content inline-flex mt-4">
                        <div class="category-title flex-1 text-sm">
                            @if ($item->limiter == 'YES')
                                <span> 0 / {{$item->quantity}}</span>
                                {{__('Collaborators')}} 
                            @elseif ($item->limiter == 'NO')
                                0 {{__('Collaborators')}} 
                            @endif
                        </div>
                    </div>
                    <!-- delivery_date -->
                    @if ($item->delivery_date)
                        <div class="text-sm text-justify mt-1">
                            {{__('Estimated delivery date')}}
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::parse($item->delivery_date)->toFormattedDateString() }}
                            </span>
                        </div>
                    @endif
                    <!-- options -->
                    <hr class="mt-2 mb-3">
                    <div class="flex justify-between items-center">
                        <span wire:click="edit({{$item->id}})" wire:loading.attr="disabled" 
                            class="material-icons-outlined text-xl font-bold cursor-pointer border border-gray-100 shadow-lg px-2 py-1 rounded-lg">
                            edit
                        </span>
                        <span wire:click="$emit('deleteDialog', {{ $item->id }})" wire:loading.attr="disabled" 
                            class="material-icons-outlined text-xl font-bold cursor-pointer text-red-500 border border-gray-100 shadow-lg px-2 py-1 rounded-lg">
                            delete
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
            <div> 
                <h2 class="mt-6 text-center text-xl font-bold">
                    {{ __('Campaign without reward') }}
                </h2>
            </div>
        
            </div>
        </div>
        @endif

    </div>
</div>
<livewire:footer.footer-collaborate/>