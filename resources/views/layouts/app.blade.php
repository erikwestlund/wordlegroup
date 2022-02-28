<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Wordle Group' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('js/app.js') }}"></script>


    @livewireStyles
</head>
<body>

<x-layout.navbar />

<main>
    <div x-data="{show: true}" x-show="show">
        @if (session()->has('message') && session('message'))
            <div class="w-full flex items-center justify-center p-2 text-sm bg-green-100 border-b border-green-700 text-green-800 text-center     w-full">
                {{ session('message') }}
                <button class="mx-2 px-1 text-semibold text-green-700 hover:text-green-900" type="button" @click="show=false"><x-icon-regular.check class="w-3 h-3" /></button>
            </div>
        @endif
    </div>

    <div class="py-8">
        {{ $slot }}
    </div>
</main>



@livewireScripts
</body>
</html>
