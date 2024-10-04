@extends("layouts.base")

@section("content")
<section class="section section-lists">
    <div class="container">
        <div class="section-title position-relative">
            <h1 class="mb-0">Результаты поиска / {{ $estates_total }} недвижимости</h1>
            <hr class="opacity-75" />

            <a href="map.html" class="btn btn-primary w-100 py-2 mb-3">Показать на карте</a>

            <div class="filters-wrapper" data-bs-toggle="modal" data-bs-target="#filters">
                <div class="filters"><i class="fa-solid fa-filter"></i> Фильтр</div>
                <span>{{ $estates_total }}</span>
            </div>
        </div>

        <div class="lists">
            @foreach($estates as $estate)
                <a class="bg-body lists__item results drounded-1 text-reset text-decoration-none mb-3"
                    href="{{ route('estate.show', $estate->id) }}">
                    <div class="lists__item-left">
                        <img src="{{ asset('storage/' . $estate->images[0]->url[0]) }}" alt="#" class="first" />

                        <div class="lists__item-images">
                            @foreach($estate->images[0]->url as $image)
                                @if($loop->iteration == 1 || $loop->iteration == 2)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Фото недвижимости #{{ $loop->iteration }}" />
                                @endif

                                @if($loop->iteration == 3)
                                    <div class="lists__item-images__text">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            alt="Фото недвижимости #{{ $loop->iteration }}" />
                                        <span>Ещё фото</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="lists__item-right p-3">
                        <p class="text-secondary">
                            {{$estate->address}}
                        </p>
                        <p class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</p>
                        <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }}
                            руб./м²</p>

                        <div class="d-flex justify-content-between mb-3">
                            <p class="mb-0">{{ $estate->rooms == 0 ? 'Студия' : $estate->rooms . '-комн. кв.' }},
                                {{ $estate->square }} м², {{ $estate->floor }}/{{ $estate->total_floor }} эт.
                            </p>
                        </div>

                        <p class="lists__item-right__text mb-0 text-secondary">{!! $estate->description !!}</p>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $estates->onEachSide(1)->links() }}
    </div>
</section>

<div class="modal fade" id="filters" tabindex="-1" aria-labelledby="filtersLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="filtersLabel">Фильтр</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="typeSelect" name="type">
                                @if(empty($type_slug))
                                    <option selected disabled value="">Выберите тип</option>
                                @endif

                                @foreach($types as $type)
                                    <option value="{{ $type->slug }}" @selected($type->slug == $type_slug)>{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="typeSelect">Тип</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="bedSelect" name="rooms">
                                @if($rooms == '')
                                    <option selected disabled value="">Выберите кол-во комнат</option>
                                @endif

                                @for($i = 0; $i < 4; $i++)
                                    <option value="{{ $i }}" @selected($i === $rooms)>{{ $i == 0 ? 'Студия' : $i }}</option>
                                @endfor
                                <option value="more" @selected($rooms == "more")>4+</option>
                            </select>
                            <label for="bedSelect">Комнатность</label>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" name="from_price" class="form-control" id="priceFromInput"
                                placeholder="name@example.com" value="{{ $from_price }}" />
                            <label for="priceFromInput">Цена от, руб.</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" name="to_price" class="form-control" id="priceToInput"
                                placeholder="name@example.com" value="{{ $to_price }}" />
                            <label for="priceToInput">Цена до, руб.</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" name="from_square" class="form-control" id="squareFromInput"
                                placeholder="name@example.com" value="{{ $from_square }}" />
                            <label for="squareFromInput">Площадь от, м2</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="form-floating">
                            <input type="number" name="to_square" class="form-control" id="squareToInput"
                                placeholder="name@example.com" {{ $to_square }} />
                            <label for="squareToInput">Площадь до, м2</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary w-100 py-2">Найти</button>
            </div>
        </form>
    </div>
</div>
@endsection