<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>AI Movie Search</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="bg-gray-100">

        {{ $slot }}

        @livewireScripts
    </body>

</html>