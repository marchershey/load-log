<x-layouts.dashboard title="Dashboard" :nav="[
    'Dashboard' => 'dashboard.index',
    'login' => 'auth.login',
    'register' => 'auth.register',
]">

    <div class="text-center">

        <flux:heading size="lg">Nothing to see here yet.</flux:heading>
        <button x-on:click="$flux.toast({
    {{-- heading: 'Success!', --}}

    text: 'Your changes have been saved',
    duration: 0
})">
            Save changes
        </button>
    </div>

</x-layouts.dashboard>
