<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $fillable = ['name', 'birth', 'gender', 'team', 'address', 'age', 'weight'];

    public $timestamps = true;

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
