<?php

namespace App\Livewire;

use App\Models\Fight;
use App\Models\FightParticipant;
use App\Models\Score;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class ScoreCard extends Component
{
    public Fight $fight;
    public FightParticipant $participant1;
    public FightParticipant $participant2;

    public function mount(Fight $fight): void
    {
        $this->fight = $fight;
        $this->fight->load('fightParticipants.player');
        if (count($this->fight->fightParticipants) ==2){
            $this->participant1 = $this->fight->fightParticipants->get(0);
            $this->participant2 = $this->fight->fightParticipants->get(1);
        }
    }


    public function render(): Application|\Illuminate\Contracts\View\View|Factory|View
    {
        $scoreGrouped = Score::addSelect(['fight_participant_id', 'type', DB::raw("sum(value) as total_score")])
            ->whereRelation('fightParticipant', fn($builder) => $builder->whereFightId($this->fight->id))
            ->groupBy(['type', 'fight_participant_id'])
            ->get();
        return view('livewire.score-card');
    }

}
