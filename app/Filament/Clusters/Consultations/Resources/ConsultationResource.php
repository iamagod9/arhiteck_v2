<?php

namespace App\Filament\Clusters\Consultations\Resources;

use App\Enums\ConsultationStatus;
use App\Filament\Clusters\Consultations\Resources\ConsultationResource\Widgets\ConsultationStats;
use App\Filament\Clusters\Consultations;
use App\Filament\Clusters\Consultations\Resources\ConsultationResource\Pages;
use App\Filament\Clusters\Consultations\Resources\ConsultationResource\RelationManagers;
use App\Models\Consultation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;

    protected static ?string $navigationLabel = 'Консультации';

    protected static ?string $modelLabel = 'Консультации';

    protected static ?string $pluralModelLabel = 'Консультации';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $cluster = Consultations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Заявка')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Имя'),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->label('Телефон'),
                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->options(ConsultationStatus::class)
                            ->required(),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Телефон'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Статус'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(label: 'Дата создания'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Дата обновления'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            ConsultationStats::class,
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
