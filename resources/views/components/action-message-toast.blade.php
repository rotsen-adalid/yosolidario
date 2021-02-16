@props(['on'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })"
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    {{ $attributes->merge(['class' => 'p-2 fiexed absolute bottom-1 right-1 rounded-md bg-gray-800 text-white ']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
</div>

