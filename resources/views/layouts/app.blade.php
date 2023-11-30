<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head_scripts')
</head>

<body>
    @if (Session::has('success'))
        <div x-data="{ open: true }" x-init="$nextTick(() => {
            setTimeout(() => { open = false }, 2500)
        })" x-cloak class="fixed top-20 right-5">
            <div x-show="open" class="text-xs bg-green-500 text-white px-2.5 py-2 rounded-md shadow-xl">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

    @if (Session::has('error'))
        <div x-data="{ open: true }" x-init="$nextTick(() => {
            setTimeout(() => { open = false }, 2500)
        })" x-cloak class="fixed top-20 right-5">
            <div x-show="open" class="text-xs bg-red-500 text-white px-2.5 py-2 rounded-md shadow-xl">
                {{ Session::get('error') }}
            </div>
        </div>
    @endif

    <div class="min-h-screen flex flex-col">
        @include('inc.header')
        <main class="flex-grow py-8 container">
            @yield('main')
        </main>
        @include('inc.footer')
    </div>
    @stack('body_scripts')
</body>

</html>
