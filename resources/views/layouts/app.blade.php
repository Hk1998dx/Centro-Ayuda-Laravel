<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-900">
    <div class="flex justify-end p-4">
        <label for="theme-toggle" class="inline-flex relative items-center cursor-pointer">
            <input type="checkbox" id="theme-toggle" class="sr-only peer" />
            <div class="w-10 h-6 bg-gray-200 dark:bg-gray-600 rounded-full peer peer-checked:bg-lime-600 peer-checked:dark:bg-lime-400"></div>
            <span class="absolute left-1 top-1 w-4 h-4 bg-white dark:bg-gray-800 rounded-full transition-transform peer-checked:translate-x-4"></span>
        </label>
    </div>

    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('modals')
    <!-- Script para el cambio de tema -->
    <script>
        const themeToggle = document.getElementById("theme-toggle");

        // Al cargar la página, recuperar el modo guardado en localStorage
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
            themeToggle.checked = true;
        } else {
            document.documentElement.classList.remove('dark');
            themeToggle.checked = false;
        }

        // Cambiar entre modo claro y oscuro al hacer click en el botón
        themeToggle.addEventListener("change", () => {
            document.documentElement.classList.toggle("dark");

            // Guardar la preferencia del tema en localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
    @livewireScripts
</body>
</html>


