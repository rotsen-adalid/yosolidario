<!-- delete -->
<x-dialog-modal wire:model="deleteConfirm">
    <x-slot name="title">
      <div class="font-bold">
            {{ __('Do you want to delete?') }}
      </div>
    </x-slot>
    <x-slot name="content">
        <x-slot name="footer">
            <x-secondary-button class="uppercase" wire:click="$toggle('deleteConfirm')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-button class="ml-2 uppercase" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-slot>
</x-dialog-modal>