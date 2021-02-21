@props(['submit'])

<div>
    <form wire:submit.prevent="{{ $submit }}">
        <div class="">
            {{ $form }}
        </div>
        @if (isset($actions))
            <div class="fflex items-center justify-end px-4 pt-3 text-right sm:px-6 space-x-2">
                {{ $actions }}
            </div>
        @endif
    </form>
</div>
