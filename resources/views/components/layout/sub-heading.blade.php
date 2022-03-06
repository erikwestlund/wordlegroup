<h2 {{ $attributes->merge(['class' => 'font-bold text-xl ' . ($textColor ?: 'text-gray-600')]) }}>
    {{ $slot }}
</h2>
