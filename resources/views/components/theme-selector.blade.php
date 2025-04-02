@props([
    'size' => 'base',
])

<div class="flex justify-center">
    <flux:button aria-label="Toggle dark mode" x-on:keydown.d.window="if (document.activeElement.localName === 'body') { $flux.dark = ! $flux.dark }" tooltip="Change theme" tooltip-kbd="D" x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" />
</div>
