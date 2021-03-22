@props(['disabled' => false])

<select  {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 focus:border-green-500 focus:ring focus:ring-green-50 focus:ring-opacity-50 rounded-md shadow-sm text-gray-900']) !!}>
    {{$option}}
</select>