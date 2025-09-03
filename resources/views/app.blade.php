<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Metanoia III') }}</title>

        <link rel="icon" href="/favicons/favicon.ico" sizes="any">
        <link rel="icon" href="/favicons/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png">

        @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased text-black">
        @inertia
    </body>
</html>
