<div {{ $attributes }}>
    <div class="@if($wide) text-center @else text-center @endif">
        <h1 class="text-3xl font-bold {{ $textColor ?? 'text-gray-600' }}">{{ $slot }}</h1>
    </div>
</div>
