<div>
    @if($label)
    <label for="about" class="block text-sm font-semibold text-gray-700 sm:mt-px sm:pt-2">{{ $label }}</label>
    @endif
    <div class="mt-1 sm:mt-1 sm:col-span-2">
        <textarea
            {{ $attributes->merge(['name' => $name, 'id' => $name, 'placeholder' => $placeholder]) }}
            id="about"
            name="about"
            rows="{{ $rows }}"
            class="max-w-lg shadow-sm block w-full focus:ring-green-500 focus:border-green-500 sm:text-sm border @if($errors->has($name)) border-red-600 @else border-gray-300 @endif placeholder-gray-400 rounded-md"
        ></textarea>
        @if($tip)
        <p class="mt-2 text-sm text-gray-500">{{ $tip }}</p>
        @endif
    </div>
    @error($name)
    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
