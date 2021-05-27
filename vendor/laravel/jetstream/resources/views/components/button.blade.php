<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-petfy-inverse']) }}>
    {{ $slot }}
</button>
