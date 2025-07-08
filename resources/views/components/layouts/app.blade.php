<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <x-layouts.partials.navbar />
    <div class="relative flex flex-col items-center">
        <div class="relative w-full max-w-2xl lg:max-w-7xl">
            <main class="mt-6">{{ $slot }}</main>
        </div>
    </div>
</body>

</html>
