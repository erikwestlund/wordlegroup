<div>
    <div class="relative flex items-start">
        <div class="flex items-center h-5">
            <input
                {{ $attributes }}
                id="{{ $name }}"
                aria-describedby="{{ $name }}-checkbox"
                name="{{ $name }}"
                type="checkbox"
                class="focus:ring-green-700 h-4 w-4 text-green-700  @if($errors->has($name)) border-red-600 @else border-gray-300 @endif rounded"
            >
        </div>
        <div class="ml-3 text-sm">
            <label for="{{ $name }}" class="font-semibold text-gray-700">{{ $label }}</label>
            @if($tip)
                <p id="{{ $name }}-description" class="text-gray-500">{{ $tip }}</p>
            @endif
        </div>
    </div>
    @error($name)
    <div class="text-red-600 text-sm mt-1">{!! $message !!}</div>
    @enderror
</div>
