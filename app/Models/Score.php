<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{

    protected $fillable = ['fight_participant_id', 'score_type', 'score_value'];

    public function participants(): BelongsTo
    {
        return $this->belongsTo(FightParticipant::class);
    }
}
