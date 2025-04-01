<x-layouts.minimal>
    <form class="max-w-screen-phone mx-auto w-full" wire:submit="authenticate">
        <flux:card class="space-y-6">
            <flux:heading size="lg">Sign in</flux:heading>
            <flux:input type="text" wire:model.blur="username" label="Username" placeholder="Your Username" />
            <flux:input type="password" wire:model.blur="password" label="Password" placeholder="Your Password" />

            <div class="space-y-2">
                <flux:button class="w-full" type="submit" variant="primary">Log in</flux:button>
                <flux:button class="w-full" href="{{ route('auth.register') }}" wire:navigate.hover variant="ghost">Sign up for a new account</flux:button>
            </div>
        </flux:card>
    </form>
</x-layouts.minimal>
