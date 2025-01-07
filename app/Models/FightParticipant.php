<?php

namespace App\Models;

use App\FightResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FightParticipant extends Model
{
    protected $table = 'fight_participants';

    protected $fillable = ['fight_id', 'player_id', 'result'];

    public $timestamps = true;

    protected $casts = [
        'result' => FightResult::class,
    ];

    public function fight(): BelongsTo
    {
        return $this->belongsTo(Fight::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class)->orderByDesc('created_at');
    }
}
