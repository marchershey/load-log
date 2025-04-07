<x-layouts.dashboard title="Loads">

    <div class="flex items-center justify-between">
        <flux:heading size="xl">Loads</flux:heading>
        <div class="flex items-center space-x-6">
            <flux:icon.loading wire:loading />
            <flux:button size="sm" icon="plus" wire:click="addLoad()">Add Load</flux:button>
        </div>
    </div>

    @php($loads = $this->loads())
    <flux:table wire:loading.class="opacity-50" :paginate="$loads">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$table_sort_by === 'number'" :direction="$table_sort_dir" wire:click="sort('number')">Load Number</flux:table.column>
            <flux:table.column sortable :sorted="$table_sort_by === 'bol'" :direction="$table_sort_dir" wire:click="sort('bol')">BOL</flux:table.column>
            <flux:table.column sortable :sorted="$table_sort_by === 'trailers.number'" :direction="$table_sort_dir" wire:click="sort('trailers.number')">Trailer</flux:table.column>
            <flux:table.column sortable :sorted="$table_sort_by === 'lanes.name'" :direction="$table_sort_dir" wire:click="sort('lanes.name')">Lane</flux:table.column>
            <flux:table.column sortable :sorted="$table_sort_by === 'date'" :direction="$table_sort_dir" wire:click="sort('date')">Date</flux:table.column>
            <flux:table.column>
                <flux:dropdown>
                    <flux:button variant="ghost" size="sm" icon="cog-6-tooth"></flux:button>

                    <flux:menu>
                        <flux:menu.submenu heading="Sort by">
                            <flux:menu.radio.group wire:model.change="table_sort_by">
                                <flux:menu.radio value="date">Date</flux:menu.radio>
                                <flux:menu.radio value="id">ID</flux:menu.radio>
                                <flux:menu.radio value="number">Load Number</flux:menu.radio>
                                <flux:menu.radio value="bol">BOL</flux:menu.radio>
                                <flux:menu.radio value="trailers.number">Trailer</flux:menu.radio>
                                <flux:menu.radio value="lanes.name">Lane</flux:menu.radio>
                                <flux:menu.radio value="created_at">Created at</flux:menu.radio>
                                <flux:menu.radio value="updated_at">Updated at</flux:menu.radio>
                                <flux:menu.radio value="deleted_at">Deleted at</flux:menu.radio>
                            </flux:menu.radio.group>
                            <flux:menu.separator />
                            <flux:menu.radio.group wire:model.change="table_sort_dir">
                                <flux:menu.radio value="asc">Accending</flux:menu.radio>
                                <flux:menu.radio value="desc">Decending</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu.submenu>

                        <flux:menu.group>
                            <flux:menu.checkbox wire:model.change="only_hidden_loads">Show Hidden loads</flux:menu.checkbox>
                        </flux:menu.group>
                    </flux:menu>
                </flux:dropdown>
            </flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @if ($loads->total() > 0)
                @foreach ($loads as $load)
                    <flux:table.row class="hover:bg-white/10" :key="$load['id']">
                        <flux:table.cell>
                            <div class="flex items-center space-x-2">
                                <flux:button class="mb-1" square variant="ghost" size="xs" x-on:click="navigator.clipboard.writeText('{{ $load['number'] }}'), copied = true, setTimeout(() => copied = false, 1000)" x-data="{
                                    value: {{ $load['number'] }},
                                    copied: false
                                }">
                                    <flux:icon.clipboard class="size-5" x-show="!copied" />
                                    <flux:icon.clipboard-check class="size-5 text-green-600" x-cloak x-show="copied" />
                                </flux:button>
                                <span class="font-mono">{{ $load['number'] }}</span>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="font-mono">{{ $load['bol'] }}</flux:table.cell>
                        <flux:table.cell class="font-mono">{{ $load['trailer']['number'] }}</flux:table.cell>
                        <flux:table.cell>{{ $load['lane']['name'] }}</flux:table.cell>
                        <flux:table.cell>{{ $load['date'] }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown>
                                <flux:button variant="subtle" size="sm" icon="ellipsis-vertical"></flux:button>
                                <flux:menu>
                                    <flux:menu.item wire:click="editLoad({{ $load['id'] }})">Edit</flux:menu.item>
                                    @if ($load->trashed())
                                        <flux:menu.item wire:click="unhideLoad({{ $load['id'] }})">Restore</flux:menu.item>
                                    @else
                                        <flux:menu.item wire:click="hideLoad({{ $load['id'] }})">Hide</flux:menu.item>
                                    @endif
                                    <flux:menu.separator />
                                    {{-- <flux:modal.trigger :name="'delete-load-'.$load['id']"> --}}
                                    <flux:menu.item variant="danger" wire:click="confirmDeleteLoad({{ $load['id'] }})">Delete</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            @else
                <flux:table.row>
                    <flux:table.cell class="text-center" colspan="6">
                        <flux:heading>No loads found</flux:heading>
                        {{-- <flux:text class="mt-2">After you add your first load, it will appear here.</flux:text> --}}
                    </flux:table.cell>
                </flux:table.row>
            @endif
        </flux:table.rows>
    </flux:table>

    <flux:modal class="max-tablet:[:where(&)]:min-w-full" wire:close="dispatch('clear-load')" wire:model.self="show_load_modal" variant="flyout" position="left" x-trap="true">
        <livewire:pages.loads.forms.load-form />
    </flux:modal>

    {{-- Delete Modal --}}
    <flux:modal class="min-w-[22rem]" wire:model.self="show_delete_modal">
        <form class="space-y-6" wire:submit.prevent="deleteLoad()">
            <div>
                <flux:heading size="lg">Are you sure?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to <strong>permanently delete</strong> load <span class="font-bold">{{ $load_to_delete['number'] ?? '' }}</span>.</p>
                    <p>You <strong>WILL NOT</strong> be able to recover this load, whatsoever.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger">Delete load</flux:button>
            </div>
        </form>
    </flux:modal>

</x-layouts.dashboard>
