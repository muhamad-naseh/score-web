<?php

namespace App;

enum FightStatus: string
{
    case WAITING = "waiting";
    case MATCHING = "matching";
    case PAUSED = "paused";
    case COMPLETED = "completed";

    public function label(): string
    {
        return match($this)
        {
            self::WAITING => 'gray',
            self::MATCHING => "info",
            self::PAUSED => "warning",
            self::COMPLETED => "success",
        };
    }

    public function icon():string{
        $icon =  match ($this){
            self::WAITING => 'play',
            self::MATCHING => "pause",
            self::PAUSED => "play",
            self::COMPLETED => "play-pause",
        };
        return 'heroicon-m-'.$icon;
    }
    public function buttonColor():string{
        return match ($this){
            self::WAITING => 'success',
            self::MATCHING => "warning",
            self::PAUSED => "success",
            self::COMPLETED => "gray",
        };
    }
}
