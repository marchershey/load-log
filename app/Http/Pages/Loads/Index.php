<?php

namespace App\Http\Pages\Loads;

use App\Models\Lane;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Loads')]
class Index extends Component
{
    public int $number;
    public int $bol;
    public int $trailer;
    public int $lane;
    public $date;

    public Collection $lanes;

    public function render()
    {
        return view('pages.loads.index');
    }

    public function openNewLoadModal()
    {
        // Update the date to today
        // $this->date = Carbon::now()->toDateString();

        // Load lanes
        $this->loadLanes();

        // Open new load modal
        $this->modal('new-load-modal')->show();
    }

    public function loadLanes()
    {
        // Load lanes
        $this->lanes = Lane::all();
    }
}
