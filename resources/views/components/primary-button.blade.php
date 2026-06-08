<button {{ $attributes->merge(['type' => 'submit', 'class' => 'qb-primary']) }}>
    {{ $slot }}
</button>
