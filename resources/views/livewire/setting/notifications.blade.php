<x-slot name="title">
    {{__('Notifications')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>
<x-slot  name="menu">
    @livewire('navigation')
</x-slot>
<x-section-content>
    <x-slot name="header">
        <header class="bg-white shadow pt-2 mb-10"> 
            <div class="justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="flex items-center font-semibold text-xl text-gray-800 leading-tight pt-6">
                    {{ __('Setting') }}
                </h2>
                
                <x-menu-setting/>
            </div>
        </header>
    </x-slot>
    <x-slot  name="content">

    </x-slot>
</x-section-content>
<livewire:footer/>