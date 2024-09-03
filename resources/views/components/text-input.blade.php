@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'px-2 py-2 text-sm border border-gray-900 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm']) !!}>