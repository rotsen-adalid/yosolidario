@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-green-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out font-bold'
            : 'inline-flex items-center px-4 py-2 bg-ys1 border border-transparent rounded-md font-bold text-sm text-white shadow-md tracking-widest hover:bg-ys2 active:bg-gray-900 focus:outline-none focus:border-green-600 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
