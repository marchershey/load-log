<?php

namespace App\Http\Pages\Loads;

use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Loads')]
class Index extends Component
{
    public $date;

    public function render()
    {
        return view('pages.loads.index');
    }

    public function updateDate()
    {
        $this->date = Carbon::now()->toDateString();
    }
}
