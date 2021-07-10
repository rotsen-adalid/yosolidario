<div>
    <x-dialog-modal wire:model="open">
        <x-slot name="title">
        <div class="font-bold text-2xl">
            {{ __('Exhaust this reward?') }}
        </div>
        </x-slot>
        <x-slot name="content">
            <div class="flex items-center space-x-2">
                <span class="material-icons-outlined text-red-500 text-3xl">help_outline</span>
                <span class="text-lg">{{__('You will not receive any more contributions for this reward')}}</span>
            </div>
            <x-slot name="footer">
                <x-secondary-button class="" wire:click="$toggle('open')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-secondary-button>
                <x-danger-button class="ml-2" wire:click="inactive" wire:loading.attr="disabled">
                    {{ __('Exhaust') }}
                </x-danger-button>
            </x-slot>
        </x-slot>
    </x-dialog-modal>
</div>
