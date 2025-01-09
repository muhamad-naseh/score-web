<?php

namespace App\Livewire;

use App\Models\Fight;
use App\Models\FightParticipant;
use App\Models\Score;
use App\ScoreType;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ScoreCard extends Component
{
    public Fight $fight;
    public Collection $scores;
    public FightParticipant $participant1;
    public FightParticipant $participant2;

    public function mount(Fight $record): void
    {
        $this->fight = $record;
        $this->fight->load('fightParticipants.player:id,name');
        if (count($this->fight->fightParticipants) ==2){
            $this->participant1 = $this->fight->fightParticipants->get(0);
            $this->participant2 = $this->fight->fightParticipants->get(1);
        }
        $this->loadScores();
    }

    #[On('reload-score-card')]
    public function loadScores(): void
    {
        \Log::debug("reloadPage");
        $scoreGrouped = Score::addSelect(['fight_participant_id', 'type', DB::raw("sum(value) as total_score")])
            ->whereRelation('fightParticipant', fn($builder) => $builder->whereFightId($this->fight->id))
            ->groupBy(['type', 'fight_participant_id'])
            ->get();

        $scores = collect();
        foreach (ScoreType::cases() as $scoreType){
            $score1 = $scoreGrouped->firstWhere(fn($item)=> $item->fight_participant_id == $this->participant1->id && $item->type == $scoreType);
            $score2  = $scoreGrouped->firstWhere(fn($item)=> $item->fight_participant_id == $this->participant2->id && $item->type == $scoreType);
            $scores->add(
                array(
                    "score_1" => (int) $score1?->total_score ?? 0,
                    'score_2' => (int) $score2?->total_score ?? 0,
                    'type' => $scoreType
                )
            );
        }
        $this->scores = $scores;
    }


    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {

        return view('livewire.score-card');
    }

}
