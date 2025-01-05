<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FightResource\Pages;
use App\Filament\Resources\FightResource\RelationManagers;
use App\Models\Fight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FightResource extends Resource
{
    protected static ?string $model = Fight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
                Forms\Components\Repeater::make("fightParticipants")
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('player_id')
                            ->hiddenLabel(true)
                            ->relationship('player', 'name')
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->required()
                    ])
                    ->minItems(2)
                    ->maxItems(2)
                    ->defaultItems(2)
                    ->deletable(false)
                    ->grid(2)
                    ->itemLabel(function ($uuid, $component) {
                        $keys = array_keys($component->getState());
                        $index = array_search($uuid, $keys);
                        return "Player " . $index + 1;
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_player'),
                Tables\Columns\TextColumn::make('second_player'),
                Tables\Columns\TextColumn::make('date')
                    ->label("Fight Date")
                    ->dateTime()
                    ->dateTimeTooltip()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make("Start Fight")
                    ->color('success')
                    ->url(fn(Fight $record) => self::getUrl('start', [
                        'record' => $record
                    ])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->with(['fightParticipants.player']);
            });
    }

    public static function getRelations(): array
    {
        return [
//            RelationManagers\PlayersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFights::route('/'),
            'create' => Pages\CreateFight::route('/create'),
            'view' => Pages\ViewFight::route('/{record}'),
            'edit' => Pages\EditFight::route('/{record}/edit'),
            'start' => Pages\StartFight::route('/{record}/start'),
        ];
    }
}
