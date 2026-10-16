@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xs text-slate-300 mb-1 tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
