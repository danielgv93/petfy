<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-petfy']) }}>
    {{ $slot }}
</button>
