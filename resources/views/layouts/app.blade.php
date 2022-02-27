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

<main class="py-8">

    <div>
        @if (session()->has('message') && session('message'))
            <div class="p-2 text-sm bg-green-700 text-white w-full max-w-2xl mx-auto mb-8 rounded">
                {{ session('message') }}
            </div>
        @endif
    </div>

    {{ $slot }}
</main>



@livewireScripts
</body>
</html>
