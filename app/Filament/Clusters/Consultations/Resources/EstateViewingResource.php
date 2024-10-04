<?php

namespace App\Filament\Clusters\Consultations\Resources;

use App\Enums\EstateViewingStatus;
use App\Filament\Clusters\Consultations;
use App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Widgets\EstateViewingStats;
use App\Filament\Clusters\Consultations\Resources\EstateViewingResource\Pages;
use App\Filament\Clusters\Consultations\Resources\EstateViewingResource\RelationManagers;
use App\Models\EstateViewing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstateViewingResource extends Resource
{
    protected static ?string $model = EstateViewing::class;
    protected static ?string $navigationLabel = 'Визиты';

    protected static ?string $modelLabel = 'Визиты';

    protected static ?string $pluralModelLabel = 'Визиты';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $cluster = Consultations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Визиты')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Телефон'),
                        Forms\Components\DatePicker::make('date')
                            ->label('Дата посещения'),
                        Forms\Components\Select::make('time')
                            ->options(function ($times = [14, 15, 16, 17, 18, 19, 20, 21]) {
                                $options = ['Как можно быстрее' => 'Как можно быстрее'];
                                foreach ($times as $time) {
                                    $formattedTime = $time . ':00' . ' - ' . ($time + 1) . ':00';
                                    $options[$formattedTime] = $formattedTime;
                                }
                                return $options;
                            })->label('Время посещения'),
                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->options(EstateViewingStatus::class)
                            ->required()
                            ->label('Статус'),
                        Forms\Components\TextInput::make('id')
                            ->label('Объект')
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->label('id'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Телефон'),
                Tables\Columns\TextColumn::make('date')
                    ->searchable()
                    ->label('Дата посещения'),
                Tables\Columns\TextColumn::make('time')
                    ->label('Время посещения'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Статус'),
                Tables\Columns\TextColumn::make('estate_id')
                    ->label('Объект'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            EstateViewingStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstateViewings::route('/'),
            'create' => Pages\CreateEstateViewing::route('/create'),
            'edit' => Pages\EditEstateViewing::route('/{record}/edit'),
        ];
    }
}
