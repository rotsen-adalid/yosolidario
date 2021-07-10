@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        @if (isset($title))
            <div class="text-lg font-bold">
                {{ $title }}
            </div>
        @endif
        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    @if (isset($footer))
        <div class="px-6 py-3 bg-white text-right space-y-1 ">
            {{ $footer }}
        </div>
    @endif

</x-modal>
