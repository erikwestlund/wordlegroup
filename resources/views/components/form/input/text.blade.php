<div>
    <div class="relative border @if($errors->has($name)) border-red-600 @else border-gray-300 @endif rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-indigo-600 focus-within:border-indigo-600">
        @if($label)
        <label for="name" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-sm font-semibold text-gray-600">{{ $label }}</label>
        @endif
        <input
            {{ $attributes->merge(['type' => 'text', 'name' => $name, 'id' => $name, 'placeholder' => $placeholder]) }}
            class="block w-full border-0 px-1 py-2 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
        >
    </div>
    @error($name)
    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
