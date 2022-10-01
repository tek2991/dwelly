
@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-2 border-secondary rounded-sm p-2 focus:ring-0 focus:border-piss-yellow']) !!}>
    {{ $slot }}
</select>