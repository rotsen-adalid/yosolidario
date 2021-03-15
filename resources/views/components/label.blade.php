@props(['value', 'required'])

<div class="flex space-x-2">
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
        {{ $value ?? $slot }}
    </label>
    
    @if (isset($required))
        <span class="text-red-500 font-bold">*</span>
    @endif
</div>