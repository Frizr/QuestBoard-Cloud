@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold tracking-wide text-slate-200']) }}>
    {{ $value ?? $slot }}
</label>
