<?php

namespace App\Http\Pages\Loads;

use App\Models\Lane;
use App\Models\Load;
use App\Models\Trailer;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Loads')]
class Index extends Component
{
    public int $number;
    public int $bol;
    public int $trailer;
    public string $lane;
    public string $lane2;
    public $date;

    public Collection $lanes;
    public Collection $trailers;

    public function render()
    {
        return view('pages.loads.index');
    }

    public function initNewLoad()
    {
        // Update the date to today
        $this->date = Carbon::now()->toDateString();

        // Get lane and trailers
        $this->lanes = Lane::all();
        $this->trailers = Trailer::all()->sortBy('number');

        // Open new load modal
        $this->modal('new-load-modal')->show();
    }

    public function addLoad()
    {
        // $load = Load::create([
        //     'number' =>
        // ]);

    }
}
