<div class="flex h-full flex-col space-y-10 overflow-auto p-5">
    <div class="flex-1">
        <div class="flex min-h-full w-full flex-col items-center justify-center space-y-10">
            {{ $slot }}
        </div>
    </div>
    <div>
        <x-layouts.footer showThemeSelector />
    </div>
</div>
