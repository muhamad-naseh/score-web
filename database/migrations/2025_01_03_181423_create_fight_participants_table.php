<?php

use App\FightResult;
use App\Models\Fight;
use App\Models\Player;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fight_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fight::class);
            $table->foreignIdFor(Player::class);
            $table->enum('result', array_column(FightResult::cases(), 'value'))->default(FightResult::NA->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fight_participants');
    }
};
