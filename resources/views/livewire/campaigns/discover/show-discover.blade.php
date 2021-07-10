<x-slot name="title">
    {{__('Discover campaigns')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
  
</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
  
<div class="mt-20">
    <div class="bg-white border border-gray-100"> 
        <div class="max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 space-y-2 sm:space-y-0 py-10">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                <a href="{{ route('home') }}" class="flex items-center text-sm text-gray-800 py-2 px-2" style="background-color:#fbf8f6">
                    <span class="material-icons-outlined text-base">arrow_back_ios</span>
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
    <div> <!--  style="background-color:#fbf8f6" -->
        <div class="max-w-6xl mx-auto px-4 sm:px-4 lg:px-4 space-y-2 sm:space-y-0 py-20">
            <livewire:campaigns.discover.top-fundraising-discover/>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 sm:space-y-0 py-6">
            @include('livewire.campaigns.discover.categories-discover')
        </div>
    </div>
</div>
<livewire:footer.footer-app/>
