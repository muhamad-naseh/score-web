<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'value'];

    public $timestamps = true;

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function fights(): HasMany
    {
        return $this->hasMany(Fight::class);
    }
}
