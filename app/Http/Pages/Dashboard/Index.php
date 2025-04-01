<?php

namespace App\Http\Pages\Dashboard;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Index extends Component
{
    public function render()
    {
        return view('pages.dashboard.index');
    }
}
