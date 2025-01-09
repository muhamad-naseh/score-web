<?php

namespace App\Livewire;

use App\Models\Fight;
use App\Models\Score;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class FightScoreHistory extends Component
{
    public Fight $fight;

    public array $scores = array();

    protected $listeners = ['reload-event' => '$refresh'];

    public function mount(Fight $record): void
    {
        $this->fight = $record;
        $this->fetchData();
    }

    public function fetchData(): void
    {
        $scoreData = Score::query()
            ->with('fightParticipant.player:id,name')
            ->whereRelation('fightParticipant', fn($builder) => $builder->whereFightId($this->fight->id))
            ->orderByDesc('created_at')
            ->get();

        $scores = $scoreData->map(function (Score $score) {
            return [
                'id' => $score->id,
                'name' => $score->fightParticipant->player->name,
                'type' => $score->type,
                'value' => $score->value,
                'timestamp' => $score->created_at->diffForHumans()
            ];
        })->toArray();

        $totalCurrentScores = count($scores);
        $totalPreviousScores = count($this->scores);
        $this->scores = $scores;

        if ($totalCurrentScores != $totalPreviousScores) {
            $this->dispatch("reload-score-card");
        }
    }

    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {
        return view('livewire.fight-score-history');
    }
}
