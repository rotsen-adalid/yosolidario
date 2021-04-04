<div>
    <span    wire:click="deleteConfirm({{$campaign_update_id}})" wire:loading.attr="disabled"
        class="material-icons-outlined text-lg text-red-500 font-bold cursor-pointer shadow py-1 px-2 rounded-lg border border-gray-100">
        delete
    </span>
    <!-- delete -->
    <x-dialog-modal wire:model="deleterDialog">
        <x-slot name="title">
        <div class="font-bold text-2xl">
                {{ __('Are you sure?') }}
        </div>{{$campaign_update_id}}
        </x-slot>
        <x-slot name="content">
            <div class="flex items-center space-x-2">
                <span class="material-icons-outlined text-red-500 text-3xl">help_outline</span>
                <span class="text-lg">{{__('Are you sure you want to delete this update?')}}</span>
            </div>
            <x-slot name="footer">
                <x-secondary-button class="" wire:click="$toggle('deleterDialog')" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-secondary-button>
                <x-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-button>
            </x-slot>
        </x-slot>
    </x-dialog-modal>
</div>
