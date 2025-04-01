<x-layouts.minimal>
    <form class="max-w-screen-phone mx-auto w-full" wire:submit="authenticate">
        <flux:card class="space-y-6">
            <flux:heading size="lg">Create Account</flux:heading>
            <flux:input type="text" wire:model.blur="username" label="Username" placeholder="Your username" />
            <flux:input type="password" wire:model.blur="password" label="Password" placeholder="Your password" />
            <flux:field>
                <flux:input type="password" wire:model.blur="password_confirmation" placeholder="Confirm your password" />
                <flux:error name="password_confirmation" />
            </flux:field>

            <div class="space-y-2">
                <flux:button class="w-full" type="submit" variant="primary">Create Account</flux:button>
                <flux:button class="w-full" href="{{ route('auth.login') }}" wire:navigate.hover variant="ghost">I already have an account</flux:button>
            </div>
        </flux:card>
    </form>
</x-layouts.minimal>
