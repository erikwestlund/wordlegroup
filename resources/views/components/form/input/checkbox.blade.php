<div class="relative flex items-start">
    <div class="flex items-center h-5">
        <input
            {{ $attributes }}
            id="{{ $name }}"
            aria-describedby="{{ $name }}-checkbox"
            name="{{ $name }}"
            type="checkbox"
            class="focus:ring-green-600 h-4 w-4 text-green-600 border-gray-300 rounded"
        >
    </div>
    <div class="ml-3 text-sm">
        <label for="{{ $name }}" class="font-semibold text-gray-700">{{ $label }}</label>
        @if($tip)
        <p id="{{ $name }}-description" class="text-gray-500">{{ $tip }}</p>
        @endif
    </div>
</div>
