@props(['title'])

<!DOCTYPE html>
<html class="h-full overscroll-none scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no">
    @env('production')
    @vite(['resources/css/app.css?' . Str::random(10), 'resources/js/app.js?' . Str::random(10)])
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endenv
    @livewireStyles
    @fluxAppearance
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <title>{{ ($title ?? 'NO TITLE SET') . ' - ' . config('app.name') }}</title>
</head>

<body class="@container flex h-screen overflow-hidden" x-data x-on:console-log.window="console.log(event.detail.message)">
    <!-- Main Content -->
    <div class="w-full">
        {{ $slot }}
    </div>

    @env('local')
    <div class="fixed bottom-0 z-50 flex w-full justify-center text-[11px]">
        <span class="phone:hidden block">null</span>
        <span class="phone:block tablet:hidden hidden">phone</span>
        <span class="tablet:block hidden landscape:hidden">tablet</span>
        <span class="laptop:hidden hidden landscape:block">landscape</span>
        <span class="laptop:block desktop:hidden hidden">laptop</span>
        <span class="desktop:block hidden">desktop</span>
        <span class="block sm:hidden">(xs)</span>
        <span class="hidden sm:block md:hidden">(sm)</span>
        <span class="hidden md:block lg:hidden">(md)</span>
        <span class="hidden lg:block xl:hidden">(lg)</span>
        <span class="hidden xl:block 2xl:hidden">(xl)</span>
        <span class="hidden 2xl:block">(2xl)</span>
    </div>
    @endenv

    @persist('toast')
        <flux:toast position="bottom right" />
    @endpersist

    <!-- Livewire Script Config -->
    @livewireScriptConfig
    @fluxScripts

    <!-- Custom Scripts -->
    @stack('scripts')
</body>

</html>
