<div class="space-y-6" wire:init="initForm()">
    <div>
        <flux:heading size="lg">Add New Load</flux:heading>
        <flux:text class="mt-2">Add details below to add a new load.</flux:text>
    </div>

    {{-- {{ gettype($this->lane_id) }} --}}
    <form class="space-y-6" wire:submit.prevent="submit">
        <flux:input type="tel" clearable wire:model.blur="number" label="Load Number" mask="0999999" placeholder="Enter Load Number" />
        <flux:input type="tel" clearable wire:model.blur="bol" label="BOL Number" placeholder="Enter BOL Number" />
        <flux:select clearable label="Trailer Number" variant="combobox" wire:model.change="trailer_number" placeholder="Enter Trailer Number">
            <x-slot name="input">
                <flux:select.input type="tel" clearable mask="999999" wire:model.blur="trailer_number" invalid="{{ $errors->has('trailer_number') }}" />
            </x-slot>
            @foreach ($all_trailers as $trailer)
                <flux:select.option value="{{ $trailer['number'] }}">
                    <span class="font-mono text-base">{{ $trailer['number'] }}</span>
                    &nbsp;<span class="truncate text-gray-400">({{ $trailer['lane']['name'] }})</span>
                </flux:select.option>
            @endforeach
        </flux:select>
        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Lane</flux:label>
                <flux:link class="text-sm" href="#" variant="subtle">Add Lane</flux:link>
            </div>
            <flux:select variant="listbox" clearable searchable wire:model.change="lane_id" placeholder="Choose a lane...">
                @foreach ($all_lanes as $lane)
                    <flux:select.option value="{{ $lane['id'] }}">
                        <div class="flex flex-col">
                            <span class="text-base">{{ $lane['name'] }}</span>
                            <span class="text-xs text-gray-400 [ui-selected_&]:hidden">{{ $lane['city'] }}, {{ $lane['state'] }}</span>
                        </div>
                    </flux:select.option>
                @endforeach
            </flux:select>
            <flux:error name="lane_id" />
        </flux:field>
        <flux:date-picker label="Empty Date" max="today" description:trailing="When the EMPTY or T-CALL macro was submitted." with-today placeholder="Select the empty date..." wire:model.change="date" />
        <flux:button class="w-full" type="submit" variant="primary">
            {{ $load ? 'Edit' : 'Add' }} Load
        </flux:button>
    </form>
</div>
