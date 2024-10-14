<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use App\Filament\Resources\EstateResource\Pages;
use App\Models\Estate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Services\EstateService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class EstateResource extends Resource
{
    protected static ?string $model = Estate::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $modelLabel = 'Недвижимость';

    protected static ?string $pluralModelLabel = 'Недвижимость';

    protected static ?string $navigationLabel = 'Недвижимость';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Выберите тип недвижимости')
                    ->schema(
                        fn(string $operation) => [
                            Forms\Components\Select::make('estate_type_id')
                                ->relationship('type', 'name')
                                ->label('Тип недвижимости')
                                ->live()
                                ->disabled($operation === "edit")
                                ->preload()
                                ->afterStateUpdated(fn(Select $component) => $component
                                    ->getContainer()
                                    ->getComponent('dynamicTypeFields')
                                    ->getChildComponentContainer()
                                    ->fill()),

                            Grid::make(2)
                                ->schema(function (Get $get) {
                                    return match ((int) ($get('estate_type_id'))) {
                                        1 => (new EstateService())->getNewEstate(),
                                        2 => (new EstateService())->getSecondEstate(),
                                        3 => (new EstateService())->getHouses(),
                                        4 => (new EstateService())->getAreas(),

                                        default => [],
                                    };
                                })
                                ->key('dynamicTypeFields')
                        ]
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('estate_type_id')
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(function (Estate $record) {
                        return $record->type->name;
                    })
                    ->label('Тип недвижимости'),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('Адрес'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(label: 'Дата обновления'),
                Tables\Columns\TextColumn::make('price')
                    ->money('RUB')
                    ->numeric(locale: 'ru')
                    ->sortable()
                    ->label('Цена'),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable()
                    ->getStateUsing(function (Estate $record) {
                        return $record->user->name;
                    })
                    ->label('Автор объявления'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->label('Дата создания'),
                Tables\Columns\TextColumn::make('date_begin')
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->label('Дата публикации'),
            ])
            ->filters([
                //
            ])

            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Посмотреть'),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEstates::route('/'),
            // 'view' => Pages\ViewEstate::route('/{record}'),
            'create' => Pages\CreateEstate::route('/create'),
            'edit' => Pages\EditEstate::route('/{record}/edit'),
        ];
    }

    public static function savePreviewMap($lat, $lon)
    {
        $response = Http::get("https://static.maps.2gis.com/1.0?s=900,400&z=16&pt={$lat},{$lon}~u:https://i.postimg.cc/90Ykr5df/marker-1.png~a:0.5,1");
        if ($response->successful()) {
            $fileName = 'img/maps/' . uniqid() . '.png';
            Storage::disk('public')->put($fileName, $response->body());
            return Storage::url($fileName);
        }
        return null;
    }
}
