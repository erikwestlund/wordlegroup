<div wire:ignore>
    <div
        class="relative border @if($errors->has($name)) border-red-600 @else border-gray-300 @endif rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600"
    >
        @if($label)
            <label
                for="name"
                class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-sm font-semibold text-gray-600"
            >{{ $label }}</label>
        @endif
        <select
            {{ $attributes }}
            id="{{ $name }}"
            name="{{ $name }}"
            class="block w-full border-0 px-1 pt-2.5 pb-1.5 text-gray-900 placeholder-gray-400 focus:ring-0 sm:text-sm"
        >
            @foreach($options as $option)
                <option
                    value="{{ $option['value'] }}"
                    @if($selectedValue === $option['value']) selected @endif
                >{{ $option['label'] }}</option>
            @endforeach
        </select>
    </div>
    @error($name)
    <div class="text-red-600 text-sm mt-1">{!! $message !!}</div>
    @enderror
</div>
