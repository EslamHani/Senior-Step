<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StepCounter extends Component
{

	public $steps = [];


    public function increment()
    {
        $this->steps[] = count($this->steps);
    }

    public function remove($step)
    {
    	unset($this->steps[$step]);
    }

    public function render()
    {
        return view('livewire.step-counter');
    }
}
