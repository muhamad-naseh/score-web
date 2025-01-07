<?php

namespace App\Models;

use App\ScoreType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Integer;

class Score extends Model
{

    protected $fillable = ['type', 'value'];

    public $timestamps = true;

    protected $casts = [
        'type' => ScoreType::class,
        'value' => 'int'
    ];

    public function fightParticipant(): BelongsTo
    {
        return $this->belongsTo(FightParticipant::class);
    }
}
