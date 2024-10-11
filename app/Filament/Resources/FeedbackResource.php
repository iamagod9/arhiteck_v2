<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationLabel = 'Отзывы';

    protected static ?string $modelLabel = 'Отзыв';

    protected static ?string $pluralModelLabel = 'Отзывы';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Отзывы')
                    ->description('Список отзывов')
                    ->schema([
                        Forms\Components\Select::make('stars')
                            ->options([1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5])
                            ->required()
                            ->label('Оценка'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Имя'),
                        Forms\Components\TextInput::make('comment')
                            ->required()
                            ->maxLength(255)
                            ->label('Комментарий'),
                        Forms\Components\TextInput::make('phone')
                            // ->tel()
                            ->required()
                            ->maxLength(255)
                            ->label('Телефон'),
                        Forms\Components\Toggle::make('is_published')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->label('Опубликован'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->label('id'),
                Tables\Columns\TextColumn::make('stars')
                    ->numeric()
                    ->sortable()
                    ->label('Оценка'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable()
                    ->label('Комментарий'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Телефон'),
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
                Tables\Columns\BooleanColumn::make('is_published')
                    ->sortable()
                    ->label('Опубликован'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
