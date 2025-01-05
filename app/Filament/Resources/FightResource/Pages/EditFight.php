<?php

namespace App\Filament\Resources\FightResource\Pages;

use App\Filament\Resources\FightResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFight extends EditRecord
{
    protected static string $resource = FightResource::class;

    public function getRelationManagers(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
