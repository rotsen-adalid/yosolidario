@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-green-500 focus:ring focus:ring-green-50 focus:ring-opacity-50 rounded-full shadow-sm']) !!}>
