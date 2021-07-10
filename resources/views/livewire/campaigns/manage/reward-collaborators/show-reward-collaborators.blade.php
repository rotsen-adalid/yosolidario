<x-slot name="title">
    {{__('Rewards')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel-user/>
</x-slot>
<div class="mt-20 bg-white">
    @livewire('campaigns.manage.reward-collaborators.inactive-reward-collaborators')
<x-section-content>
    <x-slot name="header">
        <div class="hidden lg:flex lg:items-center">
            <livewire:campaigns.manage.menu.menu-header :campaign="$campaign"/>
        </div>
        <!-- Responsive -->
        <div class="lg:hidden px-4 ">
            <div class="border-b border-gray-200 py-5">
                <a  href="{{ route('campaign/manage', $campaign) }}" class="cursor-pointer my-4  py-1 px-2 flex space-x-1 w-24">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                </a>
                <div class="flex items-center justify-center text-2xl font-bold">{{__('Gestiona tus recompensas')}}</div>
            </div>
           
        </div>
    </x-slot>
    <x-slot  name="content">

        <div class="font-bold text-lg hidden sm:flex">
            {{__('Gestiona tus recompensas')}}
        </div>
        @if ($collection->count() > 0)
            
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-6 mt-7">
            @foreach ($collection as $item)
            <div class="px-0 sm:px-0 @if($collection->count() == 1) sm:col-start-2 @endif">
            
                @if($item->image_url)
                    <div class="cursor-pointer bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" 
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
                
                <div class=" w-full bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
                
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
                                <span> {{$item->collaborators}} / {{$item->quantity}}</span>
                                {{__('Collaborators')}} 
                            @elseif ($item->limiter == 'NO')
                                {{$item->collaborators}} {{__('Collaborators')}} 
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
                    <div class="flex justify-center items-center space-x-5">
                        <x-secondary-button  wire:click="edit({{$item->id}})" wire:loading.attr="disabled" >
                            <span>{{__('Collaborators')}}</span>
                        </x-secondary-button>
                        @if ($item->status == 'ACTIVE')
                            <x-danger-button
                                wire:click="$emit('inactiveDialog', {{ $item->id }})"
                                wire:loading.attr="disabled"  
                             >
                                {{__('Exhaust')}}
                            </x-danger-button>
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
                    {{ __('Campaign without reward') }}
                </h2>
            </div>
        
            </div>
        </div>
        @endif

    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>