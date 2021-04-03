<div class="flex justify-between h-16">
    <div class="flex">
        <div class="space-x-0 -my-px sm:ml-0 flex">
            <x-nav-link href="{{ route('setting/account') }}" :active="request()->routeIs('setting/account')">
                {{ __('Account') }}
            </x-nav-link>
        </div>

        <div class="space-x-8 -my-px ml-2 sm:ml-10 flex">
            <x-nav-link href="{{ route('setting/profile') }}" :active="request()->routeIs('setting/profile')">
                {{ __('Edit profile') }}
            </x-nav-link>
        </div>

        <div class="space-x-8 -my-px  ml-2 sm:ml-10 flex">
            <x-nav-link href="{{ url('setting/notifications') }}" :active="request()->routeIs('setting/notifications')">
                {{ __('Notifications') }}
            </x-nav-link>
        </div>

    </div>
</div>
