<x-slot name="title">
    {{__('Collaborations')}} : YoSolidario
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
        <div class="lg:hidden px-4 ">
            <div class="border-b border-gray-200 py-5">
                <a  href="{{ route('campaign/manage', $campaign) }}" class="cursor-pointer my-4  py-1 px-2 flex space-x-1 w-24">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                </a>
                <div class="flex items-center justify-center text-2xl font-bold -mt-12">{{__('Collaborations')}}</div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
        @livewire('campaigns.manage.collaborations.show-collaborations', ['campaign' => $campaign])
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>