<x-slot name="title">
    {{__('Comments')}} : YoSolidario
</x-slot>
<x-slot  name="seo">

</x-slot>
<x-slot  name="menu">
    <livewire:menu.navigation-app/>
</x-slot>
<div class="mt-20 bg-white">
<x-section-content>
    <x-slot name="header">
        <livewire:campaigns.manage.menu.menu-header :campaign="$campaign"/>
    </x-slot>
    <x-slot  name="content">
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
              <div> 
                <h2 class="mt-4 text-center text-xl font-light">
                    {{ __('No comments') }}
                </h2>
              </div>
            </div>
        </div>
    </x-slot>
</x-section-content>
</div>
<livewire:footer.footer-app/>