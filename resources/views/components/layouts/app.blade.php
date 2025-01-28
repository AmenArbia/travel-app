<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<<<<<<< HEAD

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">






=======
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df




    <title>{{ $title ?? 'Travel-App' }}</title>
<<<<<<< HEAD
    @vite(['resources/css/app.css', 'resources/js/app.js'])
=======
    @vite(['resources/css/app.css' , 'resources/js/app.js'])
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
    @livewireStyles()
</head>

<body class="bg-white ">
<<<<<<< HEAD
    <main>
        {{ $slot }}
=======
    @livewire('partials.navbar')
    <main>
        {{ $slot}}
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
    </main>
    @livewireScripts()
</body>

<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> fbfb256ea01591146f7910984e8acb0ae24b71df
