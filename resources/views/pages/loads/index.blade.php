<x-layouts.dashboard title="Loads">

    <div class="flex items-center justify-between">
        <flux:heading size="xl">Loads</flux:heading>
        <flux:modal.trigger name="start-load-modal">
            <flux:button size="sm" icon="plus" wire:click="updateDate()">Add load</flux:button>
        </flux:modal.trigger>
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

    <flux:modal name="start-load-modal" variant="flyout" position="left" x-trap="true">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add New Load</flux:heading>
                <flux:text class="mt-2">Add details below to add a new load.</flux:text>
            </div>

            <flux:input type="tel" label="Load Number" mask="0999999" placeholder="Enter load number" />
            <flux:input type="tel" label="Bill of Lading" wire:focus mask="999999" placeholder="Enter BOL number" />
            <flux:input type="tel" label="Trailer Number" mask="999999" placeholder="Enter trailer number" />

            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Lane</flux:label>
                    <flux:link class="text-sm" href="#" variant="subtle">Add lane</flux:link>
                </div>
                <flux:select variant="combobox" placeholder="Choose lane..." :filter="false">
                    <flux:select.option>Grupo (Louisville, KY)</flux:select.option>
                </flux:select>
                <flux:error name="password" />
            </flux:field>
            <flux:date-picker label="Date" with-today wire:model.change="date" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save load</flux:button>
            </div>
        </div>
    </flux:modal>

</x-layouts.dashboard>
