<?php

namespace App\Livewire;

use App\Models\Fight;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public Fight $fight;
    public function mount(Fight $fight)
    {
        $this->fight = $fight;
    }

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
