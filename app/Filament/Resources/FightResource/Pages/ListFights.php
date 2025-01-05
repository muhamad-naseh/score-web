<?php

namespace App\Filament\Resources\FightResource\Pages;

use App\Filament\Resources\FightResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFights extends ListRecords
{
    protected static string $resource = FightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
