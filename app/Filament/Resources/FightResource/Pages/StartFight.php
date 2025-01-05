<?php

namespace App\Filament\Resources\FightResource\Pages;

use App\Filament\Resources\FightResource;
use App\Models\Fight;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class StartFight extends Page
{
    use InteractsWithRecord;

    protected static ?string $title = "Start Fight";

    protected static string $resource = FightResource::class;

    protected static string $view = 'filament.resources.fight-resource.pages.start-fight';

    public function mount(Fight $record): void
    {
        $record->load('fightParticipants.player');
        $this->record = $record;
    }
}
