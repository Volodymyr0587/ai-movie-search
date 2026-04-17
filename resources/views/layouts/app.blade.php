<!DOCTYPE html>
<html lang="en" class="bg-black text-white">

    <head>
        <meta charset="UTF-8">
        <title>AI Movie Search</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="bg-black text-white min-h-screen antialiased">

        <div class="min-h-screen flex flex-col">
            {{ $slot }}
        </div>

        @livewireScripts
    </body>

</html>