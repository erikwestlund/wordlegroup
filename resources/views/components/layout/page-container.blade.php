<div {{ $attributes }}>
    @if($errorMessage && count($errorMessage) > 0)
        <x-layout.flash-message type="error">{{ $errorMessage[0] }}</x-layout.flash-message>
    @elseif (session()->has('message') && session('message'))
        <x-layout.flash-message>{{ session('message') }}</x-layout.flash-message>
    @elseif(session()->has('errorMessage') && session('errorMessage'))
        <x-layout.flash-message type="error">{{ session('errorMessage') }}</x-layout.flash-message>
    @endif

    <div class="mx-auto w-full py-12 px-6 @if($wide) max-w-6xl @else max-w-xl @endif">

        @if($heading)
            <x-layout.heading :wide="$wide" :text-color="$headingTextColor">{{ $heading }}</x-layout.heading>
        @endif

        <div class="@if($topPadding) mt-8 @endif text-gray-900">
            {{ $slot }}
        </div>

        <x-layout.hr class="mt-16 mb-6"/>

        <x-layout.footer/>
    </div>

    @push('title') {{ $title }} @endpush
</div>
