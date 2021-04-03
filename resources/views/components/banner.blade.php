@props(['on', 'style'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 3000);  })"
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    class="@if($style == 'success') bg-green-500 @elseif ($style == 'danger') bg-red-700 @endif fixed w-full top-20 bg-opacity-100"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>

    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg @if($style == 'success') bg-green-600 @elseif ($style == 'danger') bg-red-600 @endif">
                    <span class="material-icons-outlined text-white ">check_circle</span>
                </span>
                <p class="ml-3 font-medium text-base text-white truncate" >
                    {{ $slot->isEmpty() ? 'Saved.' : $slot }}
                </p>
            </div>

            <div class="flex-shrink-0 sm:ml-3">
                <button
                    type="button"
                    x-on:click="shown = false"
                    class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition ease-in-out duration-150
                    @if($style == 'success') hover:bg-green-600 focus:bg-green-600 
                    @elseif ($style == 'danger') hover:bg-red-600 focus:bg-red-600 @endif">
                    <span class="material-icons-outlined text-white">clear</span>
                </button>
            </div>
        </div>
    </div>
</div>
