<div>
    <div
        class="relative border @if($errors->has($name)) border-red-600 @else border-gray-300 @endif rounded-md px-3 py-2 shadow-sm focus-within:ring-1 focus-within:ring-green-600 focus-within:border-green-600"
    >
        @if($label)
            <label
                for="name"
                class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-sm font-semibold text-gray-600"
            >{{ $label }}</label>
        @endif
            <textarea
                {{ $attributes->merge([
                    'name' => $name,
                     'id' => $name,
                     'placeholder' => $placeholder,
                     'class' => 'max-w-xl block w-full border-0 px-1 pt-2.5 pb-1.5 text-gray-900 placeholder-gray-400 focus:ring-0 sm:text-sm'
                   ]) }}
                rows="{{ $rows }}"
            ></textarea>
{{--        <input--}}
{{--            {{ $attributes->merge([--}}
{{--                'class' => 'block w-full border-0 px-1 pt-2.5 pb-1.5 text-gray-900 placeholder-gray-400 focus:ring-0 sm:text-sm',--}}
{{--                'type' => $attributes->get('type') ?? 'text' ,--}}
{{--                'name' => $name,--}}
{{--                'id' => $name,--}}
{{--                'placeholder' => $placeholder--}}
{{--            ]) }}--}}
{{--        >--}}
    </div>
    @error($name)
    <div class="text-red-600 text-sm mt-1">{!! $message !!}</div>
    @enderror
</div>


{{--<div>--}}
{{--    @if($label)--}}
{{--        <label for="about" class="block text-sm font-semibold text-gray-700 sm:mt-px sm:pt-2">{{ $label }}</label>--}}
{{--    @endif--}}
{{--    <div class="mt-1 sm:mt-1 sm:col-span-2">--}}
{{--        <textarea--}}
{{--            {{ $attributes->merge([--}}
{{--                'name' => $name,--}}
{{--                 'id' => $name,--}}
{{--                 'placeholder' => $placeholder,--}}
{{--                 'class' => 'max-w-xl shadow-sm block w-full focus:ring-green-600 focus:border-green-500 sm:text-sm border placeholder-gray-400 rounded-md ' . ($errors->has($name) ? 'border-red-600' : 'border-gray-300')--}}
{{--               ]) }}--}}
{{--            id="about"--}}
{{--            name="about"--}}
{{--            rows="{{ $rows }}"--}}
{{--        ></textarea>--}}
{{--        @if($tip)--}}
{{--            <p class="mt-2 text-sm text-gray-500">{{ $tip }}</p>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    @error($name)--}}
{{--    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>--}}
{{--    @enderror--}}
{{--</div>--}}
