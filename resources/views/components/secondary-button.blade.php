<button {{ $attributes->merge(['type' => 'button', 'class' => 'qb-secondary disabled:opacity-40']) }}>
    {{ $slot }}
</button>
