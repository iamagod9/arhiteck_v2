<?php

namespace App\Filament\Services;

use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;
use App\Models\Estate;

class EstateService
{
  public static function getAddressAndPoints($search, $isReturnPoints = false): array
  {
    if (empty($search)) {
      return [];
    }

    $response = Http::get('https://catalog.api.2gis.com/3.0/suggests', [
      'q' => $search,
      'type' => 'building',
      'suggest_type' => 'address',
      'fields' => 'items.point',
      'key' => 'b0394cab-b1f6-45a8-b6e7-2e205fb132fd'
    ]);

    $json = $response->json();
    if ($json['meta']['code'] != 200) {
      return [];
    }

    if (empty($json['result']['items'])) {
      return [];
    }

    $items = $json['result']['items'];

    if ($isReturnPoints) {
      return [
        'lon' => $items[0]["point"]["lon"],
        'lat' => $items[0]["point"]["lat"]
      ];
    }

    return collect($items)->pluck('full_name', 'search_attributes.suggested_text')->toArray();
  }

  public static function getMedia(): array
  {
    return [
      Forms\Components\Grid::make()
        ->schema([
          Forms\Components\Section::make('Изображения')
            ->collapsible()
            ->description('Загрузка изображений')
            ->schema([
              Forms\Components\Repeater::make('url')
                ->label('Изображения')
                ->relationship('images')
                ->minItems(1)
                ->maxItems(10)
                ->reorderable()
                ->reorderableWithButtons()
                ->addActionLabel('Добавить изображение')
                ->addable(false)
                ->defaultItems(1)
                ->cloneable()
                ->orderColumn('sort')
                ->schema([

                  Forms\Components\FileUpload::make('url')
                    ->label('')
                    ->multiple()
                    ->minFiles(1)
                    ->directory('img/estates')
                    ->image()
                    ->imageEditor()
                    ->imageEditorEmptyFillColor('#879f94')
                    ->maxSize(15360),
                ])->columns(1)
                ->columnSpan(2),
            ])
            ->columns(2)
            ->columnSpanFull(),
        ])
        ->columnSpan(2)
        ->columns(1),

      Forms\Components\Section::make('Видео')
        ->collapsible()
        ->description('Загрузка видео')
        ->schema([
          Forms\Components\FileUpload::make('video_url')
            ->nullable()
            ->maxSize(30720)
            ->directory('videos/estates')
            ->label('Видеоролик'),
        ])
        ->columnSpan(2),
    ];
  }

  public static function getGeneral(): array
  {
    return [
      Forms\Components\TextInput::make('id')
        ->label('id')
        ->hidden(),
      Forms\Components\Textarea::make('description')
        ->autofocus()
        ->rows(10)
        ->required()
        ->maxLength(7500)
        ->columnSpan(3)
        ->label('Описание'),
      Forms\Components\Select::make('address')
        ->required()
        ->label('Адрес')
        ->searchable()
        ->getSearchResultsUsing(fn (string $search): array => self::getAddressAndPoints($search))
        ->getOptionLabelUsing(fn ($value): ?string => $value)
        ->live()
        ->searchDebounce(1000)
        ->afterStateUpdated(function ($state, Set $set) {
          $points = self::getAddressAndPoints($state, true);
          if (count($points) > 0) {
            $set('lat', $points['lat']);
            $set('lon', $points['lon']);
          }
        })
        ->columnSpanFull(),
      Forms\Components\Hidden::make('lon')
        ->dehydrated(),
      Forms\Components\Hidden::make('lat')
        ->dehydrated(),
      Forms\Components\Placeholder::make('map')
        ->label('Местоположение на карте')
        ->content(fn($get) => new HtmlString("<img src='https://static.maps.2gis.com/1.0?s=900,400&z=16&pt={$get('lat')},{$get('lon')}~u:https://i.postimg.cc/90Ykr5df/marker-1.png~a:0.5,1' style='width: 100%;'/>"))
        ->columnSpan(3)
        ->hidden(fn($get) => empty ($get('lat')) || empty ($get('lon'))),
      // Forms\Components\TextInput::make('contact_phone')
      //   ->required()
      //   ->tel()
      //   ->placeholder('79876543219')
      //   ->prefix('+')
      //   ->label('Контактный телефон'),
    ];
  }

  public static function getPaids(): array
  {
    return [
      Forms\Components\Section::make('Платное размещение')
        ->collapsible()
        ->description('Для подключения услуг в кошельке на Авито должно быть достаточно рублей или бонусов.')
        ->schema([
          Forms\Components\Select::make('listing_fee')
            ->default('Package')
            ->options([
              'Package' => 'Package ',
              'PackageSingle' => 'PackageSingle ',
              'Single' => 'Single',
            ])
            ->label('Вариант платного размещения'),
          Forms\Components\Select::make('ad_status')
            ->default('Free')
            ->options([
              'Free' => 'Free',
              'Highlight' => 'Highlight',
              'XL' => 'XL',
              'x2_1' => 'x2_1',
              'x2_7' => 'x2_7',
              'x5_1' => 'x5_1',
              'x5_7' => 'x5_7',
              'x10_1' => 'x10_1',
              'x10_7' => 'x10_7',
              'x15_1' => 'x15_1',
              'x15_7' => 'x15_7',
              'x20_1' => 'x20_1',
              'x20_7' => 'x20_7',
            ])
            ->label('Услуга продвижения'),
        ])
    ];
  }

  public static function getNewEstate()
  {
    return [
      Wizard::make([
        Wizard\Step::make('Обязательные поля')
          ->icon('heroicon-o-shield-exclamation')
          ->schema([
            ...self::getGeneral(),
            Forms\Components\Select::make('operation_type')
              ->options([
                'Продам' => 'Продам',
              ])
              ->default('Продам')
              ->required()
              ->label('Тип объявления'),
            Forms\Components\TextInput::make('category')
              ->hidden()
              ->default('Квартиры')
              ->required()
              ->maxLength(255)
              ->label('Категория недвижимости'),
            Forms\Components\Select::make('user_id')
              ->required()
              ->relationship('user', 'name')
              ->label('Автор объявления'),
            Forms\Components\TextInput::make('price')
              ->placeholder('От 100 до 9999999999')
              ->required()
              ->numeric()
              ->minValue(100)
              ->maxValue(9999999999)
              ->postfix('руб. ')
              ->label('Цена'),
            Forms\Components\TextInput::make('market_type')
              ->hidden()
              ->default('Новостройка')
              ->required()
              ->maxLength(255)
              ->label('Принадлежность квартиры к рынку'),
            Forms\Components\Select::make('house_type')
              ->options([
                'Кирпичный' => 'Кирпичный',
                'Панельный' => 'Панельный',
                'Блочный' => 'Блочный',
                'Монолитный' => 'Монолитный',
                'Монолитно-кирпичный' => 'Монолитно-кирпичный',
              ])
              ->required()
              ->label('Тип дома'),
            Forms\Components\TextInput::make('floor')
              ->placeholder('От 1 до 99')
              ->required()
              ->numeric()
              ->minValue(1)
              ->maxValue(99)
              ->label('Этаж'),
            Forms\Components\TextInput::make('floors')
              ->placeholder('От 1 до 99')
              ->required()
              ->numeric()
              ->minValue(1)
              ->maxValue(99)
              ->label('Количество этажей в доме'),
            Forms\Components\Select::make('rooms')
              ->options([
                'Студия' => 'Студия',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10 и более' => '10 и более',
                'Своб.  планировка' => 'Своб.  планировка',
              ])
              ->required()
              ->label('Количество комнат'),
            Forms\Components\TextInput::make('square')
              ->placeholder('От 10 до 5000')
              ->required()
              ->numeric()
              ->minValue(10)
              ->maxValue(5000)
              ->label('Общая площадь объекта'),
            Forms\Components\Select::make('status')
              ->options([
                'Квартира' => 'Квартира',
                'Апартаменты' => 'Апартаменты',
              ])
              ->required()
              ->label('Статус недвижимости'),
            Forms\Components\TextInput::make('new_development_id')
              ->required()
              ->numeric()
              ->label('Объект новостройки'),
            Forms\Components\Select::make('property_rights')
              ->options([
                'Собственник' => 'Собственник',
                'Посредник' => 'Посредник',
                'Застройщик' => 'Застройщик',
              ])
              ->required()
              ->label('Право собственности'),
            Forms\Components\Select::make('decoration')
              ->options([
                'Без отделки' => 'Без отделки',
                'Предчистовая' => 'Предчистовая',
                'Чистовая' => 'Чистовая',
              ])
              ->required()
              ->label('Отделка помещения'),
          ])
          ->columnSpan(2)
          ->columns(3),
        Wizard\Step::make('Медиафайлы')
          ->icon('heroicon-o-photo')
          ->schema([
            ...self::getMedia(),
          ]),
        Wizard\Step::make('Дополнительные поля')
          ->icon('heroicon-o-share')
          ->schema([
            Forms\Components\TextInput::make('avito_id')
              ->hidden()
              ->label('Номер объявления на Авито'),
            Forms\Components\DateTimePicker::make('date_begin')
              ->date()
              ->label('Дата размещения объявления'),
            Forms\Components\DateTimePicker::make('date_end')
              ->date()
              ->label('Дата и время окончания размещения'),
            Forms\Components\Select::make('contact_method')
              ->default('По телефону и в сообщениях')
              ->options([
                'По телефону и в сообщениях' => 'По телефону и в сообщениях',
                'По телефону' => 'По телефону',
              ])
              ->label('Способ связи'),
            Forms\Components\Select::make('balcony_or_loggia')
              ->multiple()
              ->options([
                'Балкон' => 'Балкон',
                'Лоджия' => 'Лоджия',
              ])
              ->label('Балкон и/или лоджия'),
            Forms\Components\TextInput::make('kitchen_space')
              ->maxValue(100)
              ->numeric()
              ->label('Площадь кухни'),
            Forms\Components\TextInput::make('living_space')
              ->placeholder('От 5 до 5000')
              ->minValue(5)
              ->maxValue(5000)
              ->numeric()
              ->label('Жилая площадь'),
            Forms\Components\Select::make('passenger_elevator')
              ->default('1')
              ->options([
                'Нет' => 'Нет',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
              ])
              ->label('Пассажирский лифт'),
            Forms\Components\Select::make('freight_elevator')
              ->default('1')
              ->options([
                'Нет' => 'Нет',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
              ])
              ->label('Грузовой лифт'),
            Forms\Components\Select::make('courtyard')
              ->multiple()
              ->options([
                'Закрытая территория' => 'Закрытая территория',
                'Детская площадка' => 'Детская площадка',
                'Спортивная площадка' => 'Спортивная площадка',
              ])
              ->label('Тип двора'),
            Forms\Components\Select::make('parking_type')
              ->multiple()
              ->options([
                'Подземная' => 'Подземная',
                'Наземная многоуровневая' => 'Наземная многоуровневая',
                'Открытая во дворе' => 'Открытая во дворе',
                'За шлагбаумом во дворе' => 'За шлагбаумом во дворе',
              ])
              ->label('Парковка'),
            Forms\Components\Select::make('room_type')
              ->multiple()
              ->options([
                'Изолированные' => 'Изолированные',
                'Смежные' => 'Смежные',
              ])
              ->label('Тип комнат'),
            Forms\Components\Select::make('bathroom_type')
              ->options([
                'Совмещённый' => 'Совмещённый',
                'Раздельный' => 'Раздельный',
              ])
              ->label('Санузел'),
            Forms\Components\TextInput::make('ceiling_height')
              ->numeric()
              ->placeholder('От 1 до 50')
              ->minValue(1)
              ->maxValue(50)
              ->label('Высота потолков'),
            Forms\Components\Select::make('nd_additionally')
              ->multiple()
              ->options([
                'Гардеробная' => 'Гардеробная',
                'Панорамные окна' => 'Панорамные окна',
              ])
              ->label('Дополнительно'),

            Forms\Components\TextInput::make('apartment_number')
              ->default('Во двор')
              ->label('Номер квартиры'),
            Forms\Components\Select::make('view_from_windows')
              ->multiple()
              ->options([
                'Во двор' => 'Во двор',
                'На улицу' => 'На улицу',
                'На солнечную сторону' => 'На солнечную сторону',
              ])
              ->label('Вид из окон'),

            ...self::getPaids(),
          ])
          ->columns(3)
          ->columnSpan(2),
      ])
        ->skippable()
        ->columnSpan(2),
    ];
  }

  public static function getAreas()
  {
    return [
      Wizard::make([
        Wizard\Step::make('Обязательные поля')
          ->icon('heroicon-o-shield-exclamation')
          ->schema([
            ...self::getGeneral(),
            Forms\Components\Select::make('user_id')
              ->required()
              ->relationship('user', 'name')
              ->label('Автор объявления'),
            Forms\Components\Select::make('operation_type')
              ->options([
                'Продам' => 'Продам',
              ])
              ->default('Продам')
              ->label('Тип объявления'),
            Forms\Components\Select::make('category')
              ->options([
                'Земельные участки' => 'Земельные участки',
              ])
              ->default('Земельные участки')
              ->required()
              ->label('Категория недвижимости'),
            Forms\Components\TextInput::make('price')
              ->placeholder('От 1 до 9999999999')
              ->required()
              ->numeric()
              ->minValue(100)
              ->maxValue(9999999999)
              ->postfix('руб. ')
              ->label('Цена'),
            Forms\Components\Select::make('object_type')
              ->required()
              ->options([
                'Поселений (ИЖС)' => 'Поселений (ИЖС)',
                'Сельхозназначения (СНТ, ДНП)' => 'Сельхозназначения (СНТ, ДНП)',
                'Промназначения' => 'Промназначения',
                'Личное подсобное хозяйство (ЛПХ)' => 'Личное подсобное хозяйство (ЛПХ)',
              ])
              ->label('Вид объекта'),
            Forms\Components\Select::make('property_rights')
              ->options([
                'Собственник' => 'Собственник',
                'Посредник' => 'Посредник',
              ])
              ->required()
              ->label('Право собственности'),
            Forms\Components\TextInput::make('square')
              ->required()
              ->placeholder('От 1 до 10000')
              ->numeric()
              ->minValue(1)
              ->maxValue(10000)
              ->label('Площадь участка'),
          ])->columns(2)->columnSpan(2),
        Wizard\Step::make('Медиафайлы')
          ->icon('heroicon-o-photo')
          ->schema([
            ...self::getMedia(),
          ]),
        Wizard\Step::make('Дополнительные поля')
          ->icon('heroicon-o-share')
          ->schema([
            Forms\Components\TextInput::make('avito_id')
              ->hidden()
              ->label('Номер объявления на Авито'),
            Forms\Components\DateTimePicker::make('date_begin')
              ->date()
              ->label('Дата размещения объявления'),
            Forms\Components\DateTimePicker::make('date_end')
              ->label('Дата и время окончания размещения'),
            Forms\Components\Select::make('contact_method')
              ->default('По телефону и в сообщениях')
              ->options([
                'По телефону и в сообщениях' => 'По телефону и в сообщениях',
                'По телефону' => 'По телефону',
                'В сообщениях' => 'В сообщениях',
              ])
              ->label('Способ связи'),

            ...self::getPaids(),
          ])->columns(2)->columnSpan(2),
      ])
        ->skippable()
        ->columnSpan(2),
    ];
  }

  public static function getHouses()
  {
    return [
      Wizard::make([
        Wizard\Step::make('Обязательные поля')
          ->icon('heroicon-o-shield-exclamation')
          ->schema([
            ...self::getGeneral(),
            Forms\Components\TextInput::make('operation_type')
              ->default('Продам')
              ->required()
              ->maxLength(255)
              ->label('Тип объявления'),
            Forms\Components\TextInput::make('category')
              ->default('Дома, дачи, коттеджи')
              ->required()
              ->maxLength(255)
              ->label('Категория недвижимости'),
            Forms\Components\Select::make('user_id')
              ->required()
              ->relationship('user', 'name')
              ->label('Автор объявления'),
            Forms\Components\TextInput::make('price')
              ->placeholder('От 1 до 9999999999')
              ->required()
              ->numeric()
              ->minValue(100)
              ->maxValue(9999999999)
              ->postfix('руб. ')
              ->label('Цена'),
            Forms\Components\Select::make('object_type')
              ->required()
              ->options([
                'Дом' => 'Дом',
                'Дача' => 'Дача',
                'Коттедж' => 'Коттедж',
                'Таунхаус' => 'Таунхаус',
              ])
              ->label('Вид объекта'),
            Forms\Components\TextInput::make('floors')
              ->placeholder('От 1 до 99')
              ->required()
              ->numeric()
              ->minValue(1)
              ->maxValue(99)
              ->label('Количество этажей в доме'),
            Forms\Components\Select::make('rooms')
              ->options([
                'Студия' => 'Студия',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10 и более' => '10 и более',
                'Своб.  планировка' => 'Своб.  планировка',
              ])
              ->required()
              ->label('Количество комнат'),
            Forms\Components\Select::make('walls_type')
              ->required()
              ->options([
                'Кирпич' => 'Кирпич',
                'Брус' => 'Брус',
                'Бревно' => 'Бревно',
                'Газоблоки' => 'Газоблоки',
                'Металл' => 'Металл',
                'Пеноблоки' => 'Пеноблоки',
                'Сэндвич-панели' => 'Сэндвич-панели',
                'Ж/б панели' => 'Ж/б панели',
                'Экспериментальные материалы' => 'Экспериментальные материалы',
              ])
              ->label('Материал стен'),
            Forms\Components\TextInput::make('square')
              ->placeholder('От 1 до 5000')
              ->required()
              ->numeric()
              ->minValue(10)
              ->maxValue(5000)
              ->label('Общая площадь объекта'),
            Forms\Components\TextInput::make('land_area')
              ->required()
              ->numeric()
              ->placeholder('От 1 до 1200')
              ->minValue(1)
              ->maxValue(1200)
              ->label('Площадь участка'),
            Forms\Components\Select::make('land_status')
              ->required()
              ->options([
                'Индивидуальное жилищное строительство (ИЖС)' => 'Индивидуальное жилищное строительство (ИЖС)',
                'Садовое некоммерческое товарищество (СНТ)' => 'Садовое некоммерческое товарищество (СНТ)',
                'Дачное некоммерческое партнёрство (ДНП)' => 'Дачное некоммерческое партнёрство (ДНП)',
                'Фермерское хозяйство' => 'Фермерское хозяйство',
                'Личное подсобное хозяйство (ЛПХ)' => 'Личное подсобное хозяйство (ЛПХ)',
              ])
              ->label('Статус участка'),
            Forms\Components\Select::make('renovation')
              ->required()
              ->options([
                'Требуется' => 'Требуется',
                'Косметический' => 'Косметический',
                'Евро' => 'Евро',
                'Дизайнерский' => 'Дизайнерский',
              ])
              ->label('Ремонт'),
            Forms\Components\Select::make('property_rights')
              ->options([
                'Собственник' => 'Собственник',
                'Посредник' => 'Посредник',
              ])
              ->required()
              ->label('Право собственности'),
          ])->columns(2),

        Wizard\Step::make('Медиафайлы')
          ->icon('heroicon-o-photo')
          ->schema([
            ...self::getMedia(),
          ]),
        Wizard\Step::make('Дополнительные поля')
          ->icon('heroicon-o-share')
          ->schema([
            Forms\Components\TextInput::make('avito_id')
              ->hidden()
              ->label('Номер объявления на Авито'),
            Forms\Components\DateTimePicker::make('date_begin')
              ->date()
              ->label('Дата размещения объявления'),
            Forms\Components\DateTimePicker::make('date_end')
              ->label('Дата и время окончания размещения'),
            Forms\Components\Select::make('contact_method')
              ->default('По телефону и в сообщениях')
              ->options([
                'По телефону и в сообщениях' => 'По телефону и в сообщениях',
                'По телефону' => 'По телефону',
              ])
              ->label('Способ связи'),
            Forms\Components\Select::make('land_additionally')
              ->multiple()
              ->options([
                'Баня или сауна' => 'Баня или сауна',
                'Бассейн' => 'Бассейн',
              ])
              ->label('Дополнительно (на участке)'),
            Forms\Components\Select::make('house_additionally')
              ->options([
                'Терраса или веранда' => 'Терраса или веранда',
              ])
              ->label('Дополнительно (в доме)'),
            Forms\Components\Select::make('electricity')
              ->options([
                'Нет' => 'Нет',
                'Есть' => 'Есть',
              ])
              ->label('Электричество'),
            Forms\Components\Select::make('gas_supply')
              ->options([
                'Нет' => 'Нет',
                'По границе участка' => 'По границе участка',
                'В доме' => 'В доме',
              ])
              ->label('Газоснабжение'),
            Forms\Components\Select::make('heating')
              ->options([
                'Нет' => 'Нет',
                'Есть' => 'Есть',
              ])
              ->label('Отопление'),
            Forms\Components\Select::make('heating_type')
              ->options([
                'Центральное' => 'Центральное',
                'Газовое' => 'Газовое',
                'Электрическое' => 'Электрическое',
                'Жидкотопливный котёл' => 'Жидкотопливный котёл',
                'Печь' => 'Печь',
                'Камин' => 'Камин',
                'Другое' => 'Другое',
              ])
              ->label('Тип отопления'),
            Forms\Components\Select::make('water_supply')
              ->options([
                'Нет' => 'Нет',
                'Центральное' => 'Центральное',
                'Скважина' => 'Скважина',
                'Колодец' => 'Колодец',
              ])
              ->label('Водоснабжение'),
            Forms\Components\Select::make('sewerage')
              ->options([
                'Центральная' => 'Центральная',
                'Септик' => 'Септик',
                'Выгребная яма' => 'Выгребная яма',
                'Станция биоочистки' => 'Станция биоочистки',
                'Нет' => 'Нет',
              ])
              ->label('Канализация'),
            Forms\Components\Select::make('infrastructure')
              ->multiple()
              ->options([
                'Магазин' => 'Магазин',
                'Аптека' => 'Аптека',
                'Детский сад' => 'Детский сад',
                'Школа' => 'Школа',
              ])
              ->label('Инфраструктура'),
            Forms\Components\Select::make('lease_multimedia')
              ->multiple()
              ->options([
                'Wi-Fi' => 'Wi-Fi',
                'Телевидение' => 'Телевидение',
              ])
              ->label('Мультимедиа'),
            Forms\Components\Select::make('parking_type')
              ->options([
                'Нет' => 'Нет',
                'Гараж' => 'Гараж',
                'Парковочное место' => 'Парковочное место',
              ])
              ->label('Парковка'),
            Forms\Components\Select::make('bathroom_type')
              ->options([
                'В доме' => 'В доме',
                'На улице' => 'На улице',
              ])
              ->label('Санузел'),
            Forms\Components\TextInput::make('built_year')
              ->placeholder('от 1900 до н.в')
              ->minValue(1900)
              ->maxValue(date('Y'))
              ->numeric()
              ->label('Год постройки'),

            ...self::getPaids(),
          ])
          ->columns(3)
          ->columnSpan(2),
      ])
        ->skippable()
        ->columnSpan(2),
    ];
  }

  public static function getSecondEstate()
  {
    return [
      Wizard::make([
        Wizard\Step::make('Обязательные поля')
          ->icon('heroicon-o-shield-exclamation')
          ->schema([
            ...self::getGeneral(),
            Forms\Components\TextInput::make('operation_type')
              ->hidden()
              ->default('Продам')
              ->required()
              ->maxLength(255)
              ->label('Тип объявления'),
            Forms\Components\TextInput::make('category')
              ->hidden()
              ->default('Квартиры')
              ->required()
              ->maxLength(255)
              ->label('Категория недвижимости'),
            Forms\Components\Select::make('user_id')
              ->required()
              ->relationship('user', 'name')
              ->label('Автор объявления'),
            Forms\Components\TextInput::make('price')
              ->placeholder('От 1 до 9999999999')
              ->required()
              ->numeric()
              ->minValue(100)
              ->maxValue(9999999999)
              ->postfix('руб. ')
              ->label('Цена'),
            Forms\Components\TextInput::make('market_type')
              ->hidden()
              ->default('Вторичка')
              ->required()
              ->maxLength(255)
              ->label('Принадлежность квартиры к рынку'),
            Forms\Components\Select::make('house_type')
              ->options([
                'Кирпичный' => 'Кирпичный',
                'Панельный' => 'Панельный',
                'Блочный' => 'Блочный',
                'Монолитный' => 'Монолитный',
                'Монолитно-кирпичный' => 'Монолитно-кирпичный',
                'Деревянный' => 'Деревянный',
              ])
              ->required()
              ->label('Тип дома'),
            Forms\Components\TextInput::make('floor')
              ->placeholder('От 1 до 99')
              ->required()
              ->numeric()
              ->minValue(1)
              ->maxValue(99)
              ->label('Этаж'),
            Forms\Components\TextInput::make('floors')
              ->placeholder('От 1 до 99')
              ->required()
              ->numeric()
              ->minValue(1)
              ->maxValue(99)
              ->label('Количество этажей в доме'),
            Forms\Components\Select::make('rooms')
              ->options([
                'Студия' => 'Студия',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10 и более' => '10 и более',
                'Своб.  планировка' => 'Своб.  планировка',
              ])
              ->required()
              ->label('Количество комнат'),
            Forms\Components\TextInput::make('square')
              ->placeholder('От 1 до 5000')
              ->required()
              ->numeric()
              ->minValue(10)
              ->maxValue(5000)
              ->label('Общая площадь объекта'),
            Forms\Components\TextInput::make('kitchen_space')
              ->required()
              ->placeholder('От 2 до 100')
              ->postfix('м2')
              ->minValue(2)
              ->maxValue(100)
              ->numeric()
              ->label('Площадь кухни'),
            Forms\Components\Select::make('room_type')
              ->required()
              ->options([
                'Изолированные' => 'Изолированные',
                'Смежные' => 'Смежные',
              ])
              ->multiple()
              ->label('Тип комнат'),
            Forms\Components\Select::make('deal_type')
              ->required()
              ->options([
                'Прямая продажа ' => 'Прямая продажа',
                'Альтернативная' => 'Альтернативная',
              ])
              ->label('Тип сделки'),
            Forms\Components\Select::make('category')
              ->options([
                'Квартира' => 'Квартира',
                'Апартаменты' => 'Апартаменты',
              ])
              ->required()
              ->label('Категория недвижимости'),
            Forms\Components\Select::make('renovation')
              ->required()
              ->options([
                'Требуется' => 'Требуется',
                'Косметический' => 'Косметический',
                'Евро' => 'Евро',
                'Дизайнерский' => 'Дизайнерский',
              ])
              ->label('Ремонт'),
            Forms\Components\Select::make('property_rights')
              ->options([
                'Собственник' => 'Собственник',
                'Посредник' => 'Посредник',
              ])
              ->required()
              ->label('Право собственности'),
          ])
          ->columnSpan(2)
          ->columns(3),
        Wizard\Step::make('Медиафайлы')
          ->icon('heroicon-o-photo')
          ->schema([
            ...self::getMedia(),
          ]),
        Wizard\Step::make('Дополнительные поля')
          ->icon('heroicon-o-share')
          ->schema([
            Forms\Components\TextInput::make('avito_id')
              ->hidden()
              ->label('Номер объявления на Авито'),
            Forms\Components\DateTimePicker::make('date_begin')
              ->date()
              ->label('Дата размещения объявления'),
            Forms\Components\DateTimePicker::make('date_end')
              ->label('Дата и время окончания размещения'),
            Forms\Components\Select::make('contact_method')
              ->default('По телефону и в сообщениях')
              ->options([
                'По телефону и в сообщениях' => 'По телефону и в сообщениях',
                'По телефону' => 'По телефону',
              ])
              ->label('Способ связи'),
            Forms\Components\Select::make('balcony_or_loggia')
              ->multiple()
              ->options([
                'Балкон' => 'Балкон',
                'Лоджия' => 'Лоджия',
              ])
              ->label('Балкон и/или лоджия'),
            Forms\Components\Select::make('lease_appliances')
              ->multiple()
              ->options([
                'Кондиционер' => 'Кондиционер',
                'Холодильник' => 'Холодильник',
                'Стиральная машина' => 'Стиральная машина',
                'Посудомоечная машина' => 'Посудомоечная машина',
                'Водонагреватель' => 'Водонагреватель',
              ])
              ->label('Бытовая техника'),
            Forms\Components\TextInput::make('living_space')
              ->placeholder('От 5 до 5000')
              ->minValue(5)
              ->maxValue(5000)
              ->numeric()
              ->label('Жилая площадь'),
            Forms\Components\TextInput::make('apartment_number')
              ->placeholder('Укажите номер квартиры')
              ->label('Номер квартиры'),
            Forms\Components\Select::make('passenger_elevator')
              ->default('1')
              ->options([
                'Нет' => 'Нет',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
              ])
              ->label('Пассажирский лифт'),
            Forms\Components\Select::make('freight_elevator')
              ->default('1')
              ->options([
                'Нет' => 'Нет',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
              ])
              ->label('Грузовой лифт'),
            Forms\Components\Select::make('courtyard')
              ->multiple()
              ->options([
                'Закрытая территория' => 'Закрытая территория',
                'Детская площадка' => 'Детская площадка',
                'Спортивная площадка' => 'Спортивная площадка',
              ])
              ->label('Тип двора'),
            Forms\Components\Select::make('parking_type')
              ->multiple()
              ->options([
                'Подземная' => 'Подземная',
                'Наземная многоуровневая' => 'Наземная многоуровневая',
                'Открытая во дворе' => 'Открытая во дворе',
                'За шлагбаумом во дворе' => 'За шлагбаумом во дворе',
              ])
              ->label('Парковка'),
            Forms\Components\Select::make('bathroom_type')
              ->options([
                'Совмещённый' => 'Совмещённый',
                'Раздельный' => 'Раздельный',
              ])
              ->label('Санузел'),
            Forms\Components\TextInput::make('ceiling_height')
              ->numeric()
              ->placeholder('От 1 до 50')
              ->minValue(1)
              ->maxValue(50)
              ->label('Высота потолков'),
            Forms\Components\Select::make('nd_additionally')
              ->multiple()
              ->options([
                'Гардеробная' => 'Гардеробная',
                'Панорамные окна' => 'Панорамные окна',
              ])
              ->label('Дополнительно'),
            Forms\Components\Select::make('repair_additionally')
              ->options([
                'Теплый пол' => 'Теплый пол',
              ])
              ->label('Дополнительные опции ремонта'),
            Forms\Components\Select::make('in_house')
              ->multiple()
              ->options([
                'Консьерж' => 'Консьерж',
                'Мусоропровод' => 'Мусоропровод',
                'Газоснабжение' => 'Газоснабжение',
              ])
              ->label('В доме'),
            Forms\Components\Select::make('view_from_windows')
              ->multiple()
              ->options([
                'Во двор' => 'Во двор',
                'На улицу' => 'На улицу',
                'На солнечную сторону' => 'На солнечную сторону',
              ])
              ->label('Вид из окон'),
            Forms\Components\Select::make('ss_additionally')
              ->multiple()
              ->options([
                'Мебель' => 'Мебель',
                'Бытовая техника' => 'Бытовая техника',
                'Гардеробная' => 'Гардеробная',
                'Панорамные' => 'Панорамные ',
              ])
              ->label('Дополнительные опции'),
            Forms\Components\Select::make('furniture')
              ->multiple()
              ->options([
                'Кухня' => 'Кухня',
                'Шкафы' => 'Шкафы',
                'Спальные места' => 'Спальные места',
              ])
              ->label('Фурнитура'),
            Forms\Components\TextInput::make('built_year')
              ->placeholder('от 1900 до н.в')
              ->minValue(1900)
              ->maxValue(date('Y'))
              ->numeric()
              ->label('Год постройки'),

            ...self::getPaids(),
          ])
          ->columns(3)
          ->columnSpan(2),
      ])
        ->skippable()
        ->columnSpan(2),
    ];
  }
}
