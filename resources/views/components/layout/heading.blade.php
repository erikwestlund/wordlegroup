<div {{ $attributes }}>
    <div class="@if($wide) text-center @else text-center @endif">
        <h1 class="@if($headingClass) {{ $headingClass }} @else font-bold text-3xl @endif {{ $textColor ?? 'text-gray-600' }}">{{ $slot }}</h1>
    </div>
</div>
