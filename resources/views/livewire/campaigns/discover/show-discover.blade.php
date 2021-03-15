<x-slot name="title">
    {{__('Discover campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
  
</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<div>
    <div class="bg-white shadow"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-10">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <a href="{{ route('home') }}" class=" text-sm text-gray-800 bg-pink-50 py-2 px-2">
                    <i class="uil uil-angle-left-b"></i>
                    {{ __('Home') }}
                </a>
            </div>
            <div class="font-bold text-3xl py-5">
                {{__('Browse fundraisers')}}
            </div>
            <div class="text-lg">
                {{__('People around the world are raising money for what they are passionate about.')}}
            </div>
        </div>
    </div>
    <div class="bg-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-20">
            <livewire:campaigns.discover.top-fundraising-discover/>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-6">
            @include('livewire.campaigns.discover.categories-discover')
        </div>
    </div>
</div>

<livewire:footer/>
