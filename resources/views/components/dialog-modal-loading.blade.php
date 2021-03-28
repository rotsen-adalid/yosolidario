@props(['id' => null, 'maxWidth' => null])

<x-modal-loading :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    {{ $content }}
</x-modal-loading>
