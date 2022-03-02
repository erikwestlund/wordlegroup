<h2 {{ $attributes->merge(['class' => 'font-semibold ' . ($textColor ?: 'text-gray-600')]) }}>
    {{ $slot }}
</h2>
