<?php

namespace App\Http\Pages\Loads\Forms;

use App\Models\Lane;
use App\Models\Load;
use App\Models\Trailer;
use App\Traits\WithRealTimeInputValidation;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoadForm extends Component
{
    use WithRealTimeInputValidation;

    public ?Load $load;

    #[Validate('required|string|size:7', as: 'load number')]
    public string $number;

    #[Validate('nullable|string|max:20', as: 'BOL')]
    public string $bol;

    #[Validate('required|string|size:6', as: 'trailer')]
    public string $trailer_number;

    #[Validate('required|integer|exists:lanes,id', as: 'lane')]
    public int $lane_id;

    #[Validate('required|date_format:Y-m-d', as: 'date')]
    public string $date;

    public array $all_lanes = [];
    public array $all_trailers = [];

    function render()
    {
        return view('pages.loads.forms.load-form');
    }

    function initForm(): void
    {
        // Get lane and trailers
        $this->all_lanes = Lane::all()->toArray();
        $this->all_trailers = Trailer::with('lane')->get()->sortBy('number')->toArray();
    }

    #[On('set-load')]
    function setLoad(Load $load): void
    {
        $this->load = $load;
        $this->number = $load->number;
        $this->bol = $load->bol;
        $this->trailer_number = $load->trailer->number;
        $this->lane_id = $load->lane->id;
        $this->date = $load->date;
    }

    #[On('clear-load')]
    function clearLoad(): void
    {
        $this->reset();
    }

    function submit(): void
    {
        $this->validate();

        try {
            $load = Load::createLoad($this->all());
        } catch (\Throwable $th) {
            Flux::toast($th->getMessage(), heading: 'Error', variant: 'danger');
            return;
        }

        Flux::toast('Load ' . $load['number'] . ' was successfully added.', heading: 'Load Added', variant: 'success');
        $this->dispatch('load-added')->to(\App\Http\Pages\Loads\Index::class);
    }

    function update(): void
    {
        $this->validate();
    }

    function delete(Load $load): void
    {
        $load->delete();
        Flux::toast($load->number . ' was successfully deleted.');
    }
}
