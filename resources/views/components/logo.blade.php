{{-- @props([
    'size' => 'md',
    'iconSize',
    'iconPadding',
    'textSize',
])

@php
    switch ($size) {
        case 'sm':
            $iconSize ??= 'size-4';
            $iconPadding ??= 'p-1';
            $textSize ??= 'text-md!';
            break;
        case 'md':
            $iconSize ??= 'size-6';
            $iconPadding ??= 'p-2';
            $textSize ??= 'text-lg!';
            break;
        case 'lg':
            $iconSize ??= 'size-6';
            $iconPadding ??= 'p-2';
            $textSize ??= 'text-2xl!';
            break;
    }
@endphp --}}

{{-- <flux:brand name="Acme Inc." href="#">
    <x-slot name="logo">
        <div class="bg-accent text-accent-foreground flex size-6 shrink-0 items-center justify-center rounded">
            <i class="font-serif font-bold">A</i>
        </div>
    </x-slot>
</flux:brand> --}}

<flux:brand name="{{ config('app.name') }}" href="#">
    <x-slot name="logo">
        <div class="bg-accent text-accent-foreground flex size-6 shrink-0 items-center justify-center rounded">
            <flux:icon.truck variant="micro" />
        </div>
    </x-slot>
</flux:brand>

{{-- <div {{ $attributes->merge(['class' => 'flex items-center space-x-2']) }}>
    <div class="bg-accent {{ $iconPadding }} flex items-center justify-center rounded-full">
        <flux:icon.truck class="{{ $iconSize }} text-white dark:text-black" />
    </div>
    <flux:heading class="font-bold! {{ $textSize }} min-w-0 truncate leading-5">{{ config('app.name') }}</flux:heading>
</div> --}}
