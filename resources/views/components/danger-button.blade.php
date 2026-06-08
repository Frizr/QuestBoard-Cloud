<button {{ $attributes->merge(['type' => 'submit', 'class' => 'qb-danger']) }}>
    {{ $slot }}
</button>
