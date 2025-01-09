<?php

namespace App\Filament\Resources\FightResource\Pages;

use App\Filament\Resources\FightResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFight extends ViewRecord
{
    protected static string $resource = FightResource::class;

    protected static ?string $title =  'Detail Fight';
}
