<x-layouts.dashboard title="Loads">

    <div class="flex items-center justify-between">
        <flux:heading size="xl">Loads</flux:heading>
        <flux:button size="sm" icon="plus" wire:click="initNewLoad()">Add load</flux:button>
    </div>

    <div class="-mx-6">
        <flux:table>
            <flux:table.columns>
                <flux:table.column></flux:table.column>
                <flux:table.column>Load Number</flux:table.column>
                <flux:table.column>BOL</flux:table.column>
                <flux:table.column>Trailer</flux:table.column>
                <flux:table.column>Lane</flux:table.column>
                <flux:table.column>Date</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                <flux:table.row>
                    <flux:table.cell>
                        <flux:button icon="clipboard" variant="subtle" />
                    </flux:table.cell>
                    <flux:table.cell>Lindsey Aminoff</flux:table.cell>
                    <flux:table.cell>Jul 29, 10:45 AM</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="green" size="sm" inset="top bottom">Paid</flux:badge>
                    </flux:table.cell>
                    <flux:table.cell variant="strong">$49.00</flux:table.cell>
                </flux:table.row>
            </flux:table.rows>
        </flux:table>
    </div>

    <flux:modal class="max-tablet:[:where(&)]:min-w-full" name="new-load-modal" variant="flyout" position="left" x-trap="true">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New Load</flux:heading>
                <flux:text class="mt-2">Add details below to add a new load.</flux:text>
            </div>

            <flux:input type="tel" label="Load Number" mask="0999999" placeholder="Enter load number" />
            <flux:input type="number" label="Bill of Lading" placeholder="Enter BOL number" />

            {{-- Trailers --}}
            <flux:select label="Trailer Number" variant="combobox" wire:model="trailer" placeholder="Enter Trailer Number">
                <x-slot name="input">
                    <flux:select.input type="tel" mask="999999" wire:model.blur="trailer" x-model="search" />
                </x-slot>

                @if (isset($trailers))
                    @foreach ($trailers as $trailer)
                        <flux:select.option value="{{ $trailer->id }}" clearable>
                            {{ $trailer->number }}&nbsp;<span class="text-gray-400">({{ $trailer->lane->name }})</span>
                        </flux:select.option>
                    @endforeach
                @endif
            </flux:select>

            {{-- Lanes --}}
            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Lane</flux:label>
                    <flux:link class="text-sm" href="#" variant="subtle">Add lane</flux:link>
                </div>
                <flux:select variant="listbox" searchable wire:model.change="lane" placeholder="Choose a lane...">
                    @if (isset($lanes))
                        @foreach ($lanes as $lane)
                            <flux:select.option value="{{ $lane->id }}" clearable>
                                <div class="flex flex-col">
                                    <span class="text-base">{{ $lane->name }}</span>
                                    <span class="text-xs text-gray-400 [ui-selected_&]:hidden">{{ $lane->city }}, {{ $lane->state }}</span>
                                </div>
                            </flux:select.option>
                        @endforeach
                    @endif
                </flux:select>
            </flux:field>

            <flux:date-picker label="Date" with-today wire:model.change="date" />

            <div class="flex">
                <flux:button class="w-full" type="submit" variant="primary">Save load</flux:button>
            </div>
        </div>
    </flux:modal>

</x-layouts.dashboard>
