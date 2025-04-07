<?php

namespace App\Livewire\Forms;

use App\Models\Load;
use App\Traits\WithRealTimeInputValidation;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoadForm extends Form
{
    use WithRealTimeInputValidation;

    public ?Load $load;

    #[Validate('required|string|size:7', as: 'load number')]
    public string $number;

    #[Validate('required|string|max:20', as: 'BOL')]
    public string $bol;

    #[Validate('required|string|size:6|regex:/^(1[3-9]|2[0-5])[0-9]{4}$/', as: 'trailer')]
    public int $trailer_number;

    #[Validate('required|string|integer|exists:lanes,id', as: 'lane')]
    public int $lane_id;

    #[Validate('required|date_format:Y-m-D', as: 'date')]
    public string $date;

    function setLoad(Load $load): void
    {
        $this->load = $load;

        $this->number = $load->number;
        $this->bol = $load->bol;
        $this->trailer_number = $load->trailer->number;
        $this->lane_id = $load->lane->id;
        $this->date = $load->date;
    }

    function save(): Load|bool
    {
        $this->validate();

        try {
            $load = Load::createLoad($this->all());
        } catch (\Throwable $th) {
            Flux::toast($th->getMessage(), heading: 'Error', variant: 'danger');
            return false;
        }

        return $load;
    }
}
