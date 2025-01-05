<?php

namespace App\Filament\Resources\FightResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayersRelationManager extends RelationManager
{
    protected static string $relationship = 'players';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('result')
                    ->required()
                    ->options([
                        '-' => '-'
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('result'),
            ])
            ->filters([
                //
            ])
//            ->headerActions([
//                Tables\Actions\AttachAction::make()
//                    ->form(fn (Tables\Actions\AttachAction $action): array => [
//                        $action->getRecordSelect(),
//                        Forms\Components\TextInput::make('result')->required(),
//                    ]),
//            ])
//            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DetachAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                    Tables\Actions\DetachBulkAction::make(),
//                ]),
//            ])
            ;

    }
}
