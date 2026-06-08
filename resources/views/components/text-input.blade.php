@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'qb-field disabled:opacity-50']) }}>
