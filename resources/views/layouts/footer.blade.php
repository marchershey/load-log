@props([
    'showThemeSelector' => false,
])

<div {{ $attributes->class(['text-zinc-300 dark:text-zinc-700 flex flex-col space-y-2 text-center text-xs']) }}>
    @if ($showThemeSelector)
        <x-theme-selector />
    @endif
    <div>
        Powered by {{ config('app.name') }} - an open source project
    </div>
    <div>
        &copy;{{ date('Y') }} {{ config('app.name') }} LLC.
    </div>
</div>
