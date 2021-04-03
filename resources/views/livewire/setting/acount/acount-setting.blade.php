<x-slot name="title">
    {{__('Account')}} : YoSolidario
</x-slot>
<x-slot  name="seo">
    
</x-slot>

<x-slot  name="menu">
    <livewire:menu.navigation-panel/>
</x-slot>
<div class="mt-20 bg-white">
    <header class="bg-white shadow pt-2 mb-5 sm:mb-5"> 
        <div class="justify-between items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="flex items-center font-bold text-2xl text-gray-800 leading-tight pt-6">
                {{ __('Setting') }}
            </h2>
            <livewire:setting.menu.menu-setting/>
        </div>
    </header>
    
   <div class="space-y-10 pt-0 sm:pt-4 sm:pb-8">
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

        @endif

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</div>
<livewire:footer.footer-app/>
