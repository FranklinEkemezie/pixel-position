<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions | {{ $heading }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-black flex flex-col min-h-lvh">

    <header class="px-8 lg:px-12">
        <nav class="flex flex-col lg:flex-row lg:items-center justify-center lg:justify-between border-b-1 py-4 border-gray-50/10">
            <a href="/" class="hidden lg:flex items-center justify-center">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Pixel Position Logo">
            </a>

            <!-- Show on mobile, Hide on larger screen -->
            <div class="flex lg:hidden items-center justify-between mb-4">
                <a href="/" class="flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Pixel Position Logo">
                </a>

                <div class="flex items-center justify-center space-x-6">
                    <x-nav-button href="/register">Sign Up</x-nav-button>
                    <x-nav-button href="/login">Login</x-nav-button>
                </div>
            </div>

            <div class="flex items-center justify-center lg:justify-between space-x-2">
                <x-nav-link href="/jobs">Jobs</x-nav-link>
                <x-nav-link href="/careers">Careers</x-nav-link>
                <x-nav-link href="/salaries">Salaries</x-nav-link>
                <x-nav-link href="/companies">Companies</x-nav-link>
            </div>

            <div class="hidden lg:flex lg:items-center lg:justify-between space-x-4 lg:space-x-6 transition">
                <x-nav-button href="/">Sign Up</x-nav-button>
                <x-nav-button href="/login">Login</x-nav-button>
            </div>
        </nav>
    </header>

    <main class="px-8 lg:px-12">
        {{ $slot }}
    </main>

    <footer class="flex-shrink mt-4 px-8 lg:px-12">
        <div class="py-4 flex flex-col lg:flex-row items-center justify-between border-t border-gray-100/10 space-y-4 lg:space-y-0">
            <a href="/" class="flex items-center justify-center self-end lg:self-auto">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="Pixel Position Logo">
            </a>

            <div class="flex items-center justify-center space-x-4">
                <x-nav-link href="/jobs">Jobs</x-nav-link>
                <x-nav-link href="/careers">Careers</x-nav-link>
                <x-nav-link href="/salaries">Salaries</x-nav-link>
                <x-nav-link href="/companies">Companies</x-nav-link>
            </div>
        </div>
    </footer>
</body>
</html>
