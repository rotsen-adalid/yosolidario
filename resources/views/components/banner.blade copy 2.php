@props(['on', 'style'])

<div x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000);  })"
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>
    {{ $slot->isEmpty() ? 'Saved.' : $slot }}

    <div class="max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg">
                    <span class="material-icons-outlined text-white ">check_circle</span>
                </span>

                <p class="ml-3 font-medium text-base text-white truncate" ></p>
            </div>

            <div class="flex-shrink-0 sm:ml-3">
                <button
                    type="button"
                    class="-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition ease-in-out duration-150"
                    >
                    <span class="material-icons-outlined text-white">clear</span>
                </button>
            </div>
        </div>
    </div>
</div>
