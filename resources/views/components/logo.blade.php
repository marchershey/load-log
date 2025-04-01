@props([
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
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center space-x-2']) }}>
    <div class="bg-accent {{ $iconPadding }} flex items-center justify-center rounded-full">
        <flux:icon.truck class="{{ $iconSize }} text-white dark:text-black" />
    </div>
    <flux:heading class="font-bold! {{ $textSize }} min-w-0 truncate leading-5">{{ config('app.name') }}</flux:heading>
</div>
