<div {{ $attributes }}>
    <div @unless($wide) class="text-center" @endunless>
        <h1 class="text-xl font-bold {{ $textColor ?? 'text-gray-600' }}">{{ $slot }}</h1>
    </div>
</div>
