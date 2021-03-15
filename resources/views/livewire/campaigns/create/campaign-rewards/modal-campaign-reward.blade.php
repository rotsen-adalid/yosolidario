<!-- Delete Confirmation Modal -->
<x-dialog-modal wire:model="confirmingDeletion">
    <x-slot name="title">
        {{ __('Delete Reward?') }}
    </x-slot>
    <x-slot name="content">
        <div class="title-post font-semibold text-xl">{{$amount}} {{$recognition_currency_symbol}}</div>
        <div class="summary-post text-base text-justify mt-4">
            {{$description}}
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button class="uppercase" wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-secondary-button>
        <x-danger-button class="ml-2 uppercase" wire:click="delete({{ $campaign_reward_id }})" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
