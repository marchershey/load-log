@props(['title', 'nav' => []])

<div class="flex h-full w-full bg-white dark:bg-gray-900">
    <flux:sidebar class="flex h-full shrink-0 bg-white duration-200 dark:bg-gray-900" stashable>

        <div class="flex justify-between">
            <x-logo />
            <flux:sidebar.toggle class="laptop:hidden" icon="x-mark" />
        </div>

        <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

        <flux:navlist variant="outline">
            <flux:navlist.item href="{{ route('dashboard.index') }}" wire:navigate.hover icon="house">Dashboard</flux:navlist.item>
            <flux:navlist.item href="{{ route('loads') }}" wire:navigate.hover icon="truck">Loads</flux:navlist.item>
            <flux:navlist.group class="mt-4" heading="More" expandable :expanded="false">
                <flux:navlist.item href="#" wire:navigate.hover icon="route">Lanes</flux:navlist.item>
                <flux:navlist.item href="#" wire:navigate.hover icon="caravan">Trailers</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

    </flux:sidebar>
    {{-- content --}}
    <div class="relative flex flex-1 flex-col overflow-y-auto">
        {{-- header --}}
        <flux:header class="sticky top-0 w-full bg-white dark:bg-gray-900">
            <div class="flex w-full">
                <div class="flex w-full space-x-2">
                    <flux:sidebar.toggle class="laptop:hidden mr-4" icon="menu" inset="left" />
                    <div class="laptop:hidden min-w-0 flex-1 truncate">
                        <x-logo />
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <x-theme-selector />
                    <flux:dropdown class="-mr-4" position="top" align="end">
                        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                        <flux:menu>
                            <flux:menu.item icon="user-cog">Edit Profile</flux:menu.item>
                            <flux:menu.item href="{{ route('auth.logout') }}" variant="danger" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </flux:header>

        <flux:main class="min-laptop:rounded-tl-2xl min-laptop:border-l border-t border-gray-200 bg-gray-100 dark:border-gray-400/10 dark:bg-gray-800">
            <div class="flex flex-col space-y-10">
                {{ $slot }}
            </div>
        </flux:main>
    </div>
</div>

{{-- <div class="h-full">
    <flux:sidebar class="dark flex h-full shrink-0 bg-white duration-200 dark:bg-gray-800" sticky stashable>

        <div class="flex justify-between">
            <x-logo />
            <flux:sidebar.toggle class="laptop:hidden" icon="x-mark" />
        </div>

        <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

        <flux:navlist variant="outline">
            <flux:navlist.item href="{{ route('dashboard.index') }}" wire:navigate icon="house">Dashboard</flux:navlist.item>
            <flux:navlist.item href="{{ route('auth.login') }}" wire:navigate icon="truck">Loads</flux:navlist.item>
            <flux:navlist.group heading="Information" expandable :expanded="false">
                <flux:navlist.item href="#" icon="route">Lanes</flux:navlist.item>
                <flux:navlist.item href="#" icon="caravan">Trailers</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

    </flux:sidebar>

    <flux:header class="min-h-auto laptop:sticky laptop:top-0 dark fixed hidden w-full border-b border-zinc-200 bg-white dark:border-0 dark:bg-zinc-800">
        <div class="laptop:flex-nowrap laptop:justify-between flex w-full flex-wrap items-center">
            <div class="laptop:w-auto laptop:order-2 flex min-h-[56px] w-full items-center justify-between space-x-2">
                <flux:sidebar.toggle class="laptop:hidden" icon="bars-2" inset="left" />
                <div class="laptop:hidden min-w-0 flex-1 truncate">
                    <x-logo />
                </div>
                <x-theme-selector />
                <flux:dropdown class="-mr-4" position="top" align="end">
                    <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                    <flux:menu>
                        <flux:menu.item icon="user-cog">Edit Profile</flux:menu.item>
                        <flux:menu.item href="{{ route('auth.logout') }}" variant="danger" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>
            <div class="overflow-x-auto">
                @if ($nav)
                    <flux:navbar class="w-full overflow-x-auto" wire:scroll>
                        @foreach ($nav as $text => $data)
                            @php
                                // If $data is an array, pull the 'link' and 'badge' values; otherwise, treat $data as the URL.
                                $route = is_array($data) && isset($data['route']) ? $data['route'] : $data;
                                $badge = is_array($data) && isset($data['badge']) ? $data['badge'] : null;
                                $badgeColor = is_array($data) && isset($data['badgeColor']) ? $data['badgeColor'] : null;
                                $badgeVariant = is_array($data) && isset($data['badgeVariant']) ? $data['badgeVariant'] : 'solid';
                            @endphp
                            <flux:navbar.item href="{{ route($route) }}" wire:current wire:navigate.hover>
                                <span>{{ $text }}</span>
                                @if ($badge)
                                    <flux:badge class="px-1! py-0.5! rounded-sm! ml-2" size="sm" color="{{ $badgeColor }}" variant="{{ $badgeVariant }}">
                                        {{ $badge }}
                                    </flux:badge>
                                @endif
                            </flux:navbar.item>
                        @endforeach
                    </flux:navbar>
                @endif
            </div>
        </div>
    </flux:header>

    <div class="flex flex-col">
        <div>top bar</div>
        <div>seconard bar</div>
        <flux:main>
            Main content
        </flux:main>

    </div>

    <flux:main class="p-0! relative hidden overflow-hidden overflow-y-auto dark:bg-gray-900">
        <flux:header class="fixed w-full border-b border-zinc-200 bg-white dark:border-0 dark:bg-zinc-800">
            <flux:sidebar.toggle class="laptop:hidden" icon="bars-2" inset="left" />
        </flux:header>
        <div class="mt-52px!">
            first<br>
            asdf<br>
            asdf<br>
            asdf<br>
        </div>
        asdf<br>
        <div class="max-w-screen-laptop @if (count($nav) > 0) mt-[98px] @else mt-[49px] @endif flex flex-col space-y-10 p-6 lg:p-8">
            <flux:heading size="xl" level="1">{{ $title }}</flux:heading>
            {{ $slot }}
        </div>
    </flux:main>
</div> --}}
