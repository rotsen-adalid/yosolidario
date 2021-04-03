<div>
    <x-banner on="saved" style="success">
        {{ __('Updated successfully.') }}
    </x-banner>
    <div class="max-w-2xl mx-auto px-0 sm:px-2 py-0 sm:py-0">
        <div class="border border-gray-100 my-5 py-5 px-4 sm:px-10 rounded shadow bg-white">
       
            <div class="text-center font-bold text-2xl">
                {{ __('Update Password') }}
            </div>
            <form wire:submit.prevent="updatePassword">
                <div class="mt-6">
                    <x-label for="current_password" class="font-semibold" value="{{ __('Current Password') }}" />
                    <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
                    <x-input-error for="current_password" class="mt-2" />
                </div>
            
                <div class="mt-6">
                    <x-label for="password" class="font-semibold" value="{{ __('New Password') }}" />
                    <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
                    <x-input-error for="password" class="mt-2" />
                </div>
            
                <div class="mt-6">
                    <x-label for="password_confirmation" class="font-semibold" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                    <x-input-error for="password_confirmation" class="mt-2" />
                </div>
                <div class="mt-4 flex">
                    <x-button class="text-sm">
                        {{ __('Save') }}
                    </x-button>
                    <x-action-message class="ml-3" on="saved">
                        {{ __('Updated successfully.') }}
                    </x-action-message>
                </div>
            </form>    
        </div>
    </div>    
</div>