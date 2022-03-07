<div>
    @if($label)
        <label for="about" class="block text-sm font-semibold text-gray-700 sm:mt-px sm:pt-2">{{ $label }}</label>
    @endif
    <div class="mt-1 sm:mt-1 sm:col-span-2">
        <textarea
            {{ $attributes->merge([
                'name' => $name,
                 'id' => $name,
                 'placeholder' => $placeholder,
                 'class' => 'max-w-xl shadow-sm block w-full focus:ring-green-500 focus:border-green-500 sm:text-sm border placeholder-gray-400 rounded-md ' . ($errors->has($name) ? 'border-red-600' : 'border-gray-300')
               ]) }}
            id="about"
            name="about"
            rows="{{ $rows }}"
        ></textarea>
        @if($tip)
            <p class="mt-2 text-sm text-gray-500">{{ $tip }}</p>
        @endif
    </div>
    @error($name)
    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
