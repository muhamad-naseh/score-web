<?php

namespace App\Livewire;

use App\Models\Fight;
use App\Models\FightParticipant;
use App\Models\Score;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
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


    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {
        $this->fight->load(['fightParticipants.scores']);
        $this->scores = collect($this->fight->fightParticipants)
            ->flatMap(fn(FightParticipant $item) => $item->scores->map(function (Score $score) use ($item) {
                return [
                    'id' => $score->id,
                    'name' => $item->player->name,
                    'type' => $score->type,
                    'value' => $score->value,
                    'timestamp' => $score->created_at->diffForHumans()
                ];
            }))
            ->toArray();
        return view('livewire.fight-score-history');
    }
}
