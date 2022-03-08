<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@stack('title')</title>

    <meta property="og:title" content="Wordle Group - Keep Score In Wordle With Friends">
    <meta property="og:site_name" content="Wordle Group">
    <meta property="og:url" content="https://wordlegroup.com">
    <meta property="og:description" content="A free and easy way to keep score in Wordle with your friends.">
    <meta property="og:type" content="website">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">
    <link rel="shortcut icon" href="/favicons/favicon.ico">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    @stack('scripts')

    @livewireStyles
</head>
<body>

<x-layout.navbar />

<main>
    {{ $slot }}
</main>



@livewireScripts
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
