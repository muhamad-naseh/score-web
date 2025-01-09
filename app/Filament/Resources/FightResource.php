<?php

namespace App\Filament\Resources;

use App\FightStatus;
use App\Filament\Resources\FightResource\Pages;
use App\Livewire\FightScoreHistory;
use App\Livewire\ScoreCard;
use App\Models\Fight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime("D, d M Y H:i:s")
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
                    ->icon('heroicon-m-play')
                    ->hidden(fn(Fight $record) => $record->status == FightStatus::COMPLETED)
                    ->url(fn(Fight $record) => self::getUrl('start', [
                        'record' => $record
                    ])),
                Tables\Actions\EditAction::make()
                    ->disabled(fn(Fight $record) => $record->status == FightStatus::COMPLETED)
                    ->hidden(fn(Fight $record) => $record->status == FightStatus::COMPLETED)
                    ->hiddenLabel(),
                Tables\Actions\DetachAction::make()->hiddenLabel()->requiresConfirmation()
//                Tables\Actions\ViewAction::make()
//                    ->hiddenLabel(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->with(['fightParticipants.player'])->orderByDesc('created_at');
            });
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make([
                    'default' => 5,
                ])
                    ->schema([
                        Section::make("Score Card")
                            ->description('lorem')
                            ->columnSpan(3)
                            ->key('name')
                            ->schema([
                                Livewire::make(ScoreCard::class)
                                    ->key('score-history'),
                                Grid::make([
                                    'default' => 3,
                                ])
                                    ->schema([
                                        TextEntry::make('status')
                                            ->badge(),
                                        TextEntry::make('date')
                                            ->dateTime("D, d M Y H:i:s")
                                            ->label('Fight Date')
                                            ->icon('heroicon-m-clock'),
                                        TextEntry::make('updated_at')
                                            ->dateTime("D, d M Y H:i:s")
                                            ->label('Completed At')
                                            ->icon('heroicon-m-clock')
                                    ])

                            ]),
                        Section::make('Score Log')
                            ->description('Score Log History')
                            ->columnSpan(2)
//                            ->headerActions([
//                                Action::make('resetStars')
//                                    ->icon('heroicon-m-x-mark')
//                                    ->color('danger')
//                                    ->dispatch('reload-score-card'),
//                            ])
                            ->schema([
                                Livewire::make(FightScoreHistory::class)
                                    ->key('score-history')
                            ])->compact(),
                    ])
            ]);
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
