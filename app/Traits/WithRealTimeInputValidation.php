<?php

namespace App\Traits;

trait WithRealTimeInputValidation
{
    // Validate field when updated
    public function updated($field)
    {
        $this->validateOnly($field);
    }
}
