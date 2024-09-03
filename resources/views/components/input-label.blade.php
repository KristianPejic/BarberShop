@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-base text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>