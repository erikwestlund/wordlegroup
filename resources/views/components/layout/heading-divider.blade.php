<div {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
        <div class="w-full border-t border-transparent"></div>
    </div>
    <div class="relative flex justify-center">
        <span class="px-3 bg-white text-xl font-bold text-gray-600"> {{ $slot }} </span>
    </div>
</div>
