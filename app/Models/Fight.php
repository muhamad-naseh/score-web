<?php

namespace App\Models;

use App\FightStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fight extends Model
{

    protected $fillable = ['category_id', 'date', 'status'];

    protected $casts = [
        'status' => FightStatus::class,
        'date' => 'datetime'
    ];

    public $timestamps = true;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fightParticipants(): HasMany
    {
        return $this->hasMany(FightParticipant::class);
    }

    protected function firstPlayer(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->fightParticipants->first()->player->name,
        );
    }

    protected function secondPlayer(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->fightParticipants->skip(1)->first()->player->name,
        );
    }

}
