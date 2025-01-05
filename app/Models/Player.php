<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = ['name', 'category_id', 'birth', 'gender', 'team', 'address', 'age', 'weight'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fights(): BelongsToMany
    {
        return $this->belongsToMany(Fight::class, 'fight_participants')
            ->withPivot('result')->withTimestamps();
    }
}
