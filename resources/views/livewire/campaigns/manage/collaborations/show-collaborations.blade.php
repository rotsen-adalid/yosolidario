<x-slot name="title">
    {{__('Collaborations')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-panel/>
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
                <a  href="{{ route('your/campaigns') }}" class="cursor-pointer my-4  py-1 px-2 flex space-x-1 w-24">
                    <span class="material-icons-outlined text-sm">arrow_back_ios</span>
                </a>
                <div class="flex items-center justify-center text-2xl font-bold -mt-12">{{__('Collaborations')}}</div>
            </div>
        </div>
    </x-slot>
    <x-slot  name="content">
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl w-full space-y-8">
              <div> 
                <h2 class="mt-4 text-center text-lg font-bold">
                    {{ __('Your fundraiser has no collaborations yet.') }}
                </h2>
                <h2 class="mt-2 text-center font-light">
                    {{ __('Collaborations will show up here. Start by sharing your fundraiser with friends and family.') }}
                </h2>
                @livewire('campaigns.manage.menu.shared-manage', ['campaign' => $campaign, 'buttonShared' => 2])
              </div>
            </div>
        </div>
    </x-slot>
</x-section-content>

</div>
<livewire:footer.footer-app/>