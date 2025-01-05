<?php

namespace App\Livewire;

use App\Models\Fight;
use App\Models\FightParticipant;
use Livewire\Component;

class FightScoreHistory extends Component
{
    public Fight $fight;

    public array $scores;

    protected $listeners = ['reload-event' => '$refresh'];

    public function mount(Fight $fight): void
    {
//        $fight->load(['fightParticipants.player', 'fightParticipants.scores']);
        $this->fight = $fight;
    }


    public function render()
    {
        $this->fight->load(['fightParticipants.scores']);
        $this->scores = collect($this->fight->fightParticipants)->flatMap(fn(FightParticipant $item)=>$item->scores)->toArray();
        return view('livewire.fight-score-history');
    }
}
