@extends("layouts.base")

@section("content")

<section class="section section-detail py-3">
  <div class="container">
    <div class="details d-block d-lg-grid">
      <div class="details-left">
        <div class="details-left__info bg-body p-3 box-shadow rounded-1 mb-3">
          @if ($estate->estate_type_id == 3 || $estate->estate_type_id == 4)
        <div class="d-none d-lg-block mb-3">

        <h1 class="mb-3">{{ $type->where('slug', $estate->type->slug)->first()->name }}, {{ $estate->square }}
          м²</h1>

        <p class="text-secondary mb-0">{{ $estate->address }}</p>
        </div>

      @else
      <div class="d-none d-lg-block mb-3">

      <h1 class="mb-3">{{ $estate->rooms == 0 ? 'Студия' : $estate->rooms . '-комн. кв.' }}, {{ $estate->square }}
        м², {{ $estate->floor }}/{{ $estate->floors }} эт.</h1>

      <p class="text-secondary mb-0">{{ $estate->address }}</p>
      </div>
    @endif

          <div class="swiper swiper-detail">
            <div class="swiper-wrapper">
              @foreach($estate->images[0]->url as $image)
          <div class="swiper-slide" href="{{ asset('storage/' . $image) }}">
          <img src="{{ asset('storage/' . $image) }}" alt="Фото недвижимости #{{ $loop->iteration }}"
            class="rounded-1" />
          </div>
        @endforeach
            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

          <div class="swiper swiper-gallery">
            <div class="swiper-wrapper">
              @foreach($estate->images[0]->url as $image)
          <div class="swiper-slide" href="{{ asset('storage/' . $image) }}">
          <img src="{{ asset('storage/' . $image) }}" alt="Фото недвижимости #{{ $loop->iteration }}"
            class="rounded-1" />
          </div>
        @endforeach
            </div>
          </div>
        </div>

        @if(!empty($estate->video_url))
      <div class="details-left__video bg-body p-3 box-shadow rounded-1 mb-3">
        <h3>Видео-тур</h3>
        <video src="{{ asset('storage/' . $estate->video_url) }}" id="player" controls class="rounded-1"></video>
      </div>
    @endif

        @if ($estate->estate_type_id == 1)
      <div class="d-block d-lg-none bg-body p-3 box-shadow rounded-1 mb-3">
        <h3 class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</h3>
        <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }} руб./м²
        </p>

        <h4 class="mb-3">{{ $estate->rooms }}-комн. кв., {{ $estate->square }} м²,
        {{ $estate->floor }}/{{ $estate->total_floor }} эт.
        </h4>

        <p class="text-secondary mb-0">{{ $estate->address }}</p>
      </div>

      <div class="details-left__description bg-body p-3 box-shadow rounded-1 mb-3">
        <h3>Описание</h3>
        {!! nl2br(e($estate->description)) !!}
      </div>

      <div class="details-left__property bg-body p-3 box-shadow rounded-1 mb-3">
        <h3 class="mb-4">Характеристики</h3>

        <div class="details-left__property-main mb-3">
        <h5 class="mb-3">Основные</h5>

        <div class="details-left__property-item mb-1">
          <p class="text-secondary mb-0">Общая площадь</p>
          <p class="mb-0">{{ $estate->square }} м²</p>
        </div>

        <div class="details-left__property-item mb-1">
          <p class="text-secondary mb-0">Ремонт</p>
          <p class="mb-0">{{ $estate->repair }}</p>
        </div>

        <div class="details-left__property-item mb-1">
          <p class="text-secondary mb-0">Год постройки</p>
          <p class="mb-0">{{ $estate->year_build }}</p>
        </div>

        <div class="details-left__property-item mb-1">
          <p class="text-secondary mb-0">Этаж/Этажность</p>
          <p class="mb-0">{{ $estate->floor }} из {{ $estate->total_floor }}</p>
        </div>

        <div class="details-left__property-item mb-1">
          <p class="text-secondary mb-0">Стены</p>
          <p class="mb-0">{{ $estate->walls }}</p>
        </div>

        <div class="details-left__property-item">
          <p class="text-secondary mb-0">Площадь кухни</p>
          <p class="mb-0">{{ $estate->square_kitchen }} м²</p>
        </div>
        </div>
      </div>

    @elseif ($estate->estate_type_id == 2)

    <div class="d-block d-lg-none bg-body p-3 box-shadow rounded-1 mb-3">
      <h3 class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</h3>
      <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }} руб./м²
      </p>

      <h4 class="mb-3">{{ $estate->rooms }}-комн. кв., {{ $estate->square }} м²,
      {{ $estate->floor }}/{{ $estate->total_floor }} эт.
      </h4>

      <p class="text-secondary mb-0">{{ $estate->address }}</p>
    </div>

    <div class="details-left__description bg-body p-3 box-shadow rounded-1 mb-3">
      <h3>Описание</h3>
      {!! $estate->description !!}
    </div>

    <div class="details-left__property bg-body p-3 box-shadow rounded-1 mb-3">
      <h3 class="mb-4">Характеристики</h3>

      <div class="details-left__property-main mb-3">
      <h5 class="mb-3">Основные</h5>

      <div class="details-left__property-item mb-1">
        <p class="text-secondary mb-0">Общая площадь</p>
        <p class="mb-0">{{ $estate->square }} м²</p>
      </div>

      <div class="details-left__property-item mb-1">
        <p class="text-secondary mb-0">Ремонт</p>
        <p class="mb-0">{{ $estate->repair }}</p>
      </div>

      <div class="details-left__property-item mb-1">
        <p class="text-secondary mb-0">Год постройки</p>
        <p class="mb-0">{{ $estate->year_build }}</p>
      </div>

      <div class="details-left__property-item mb-1">
        <p class="text-secondary mb-0">Этаж/Этажность</p>
        <p class="mb-0">{{ $estate->floor }} из {{ $estate->total_floor }}</p>
      </div>

      <div class="details-left__property-item mb-1">
        <p class="text-secondary mb-0">Стены</p>
        <p class="mb-0">{{ $estate->walls }}</p>
      </div>

      <div class="details-left__property-item">
        <p class="text-secondary mb-0">Площадь кухни</p>
        <p class="mb-0">{{ $estate->square_kitchen }} м²</p>
      </div>
      </div>
    </div>

  @elseif ($estate->estate_type_id == 3)

  <div class="d-block d-lg-none bg-body p-3 box-shadow rounded-1 mb-3">
    <h3 class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</h3>
    <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }}
    руб./м²
    </p>

    <h4 class="mb-3">{{ $estate->rooms }}-комн. кв., {{ $estate->square }} м²,
    {{ $estate->floor }}/{{ $estate->total_floor }} эт.
    </h4>

    <p class="text-secondary mb-0">{{ $estate->address }}</p>
  </div>

  <div class="details-left__description bg-body p-3 box-shadow rounded-1 mb-3">
    <h3>Описание</h3>
    {!! $estate->description !!}
  </div>

  <div class="details-left__property bg-body p-3 box-shadow rounded-1 mb-3">
    <h3 class="mb-4">Характеристики</h3>

    <div class="details-left__property-main mb-3">
    <h5 class="mb-3">Основные</h5>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Общая площадь</p>
      <p class="mb-0">{{ $estate->square }} м²</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Ремонт</p>
      <p class="mb-0">{{ $estate->repair }}</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Год постройки</p>
      <p class="mb-0">{{ $estate->year_build }}</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Этаж/Этажность</p>
      <p class="mb-0">{{ $estate->floor }} из {{ $estate->total_floor }}</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Стены</p>
      <p class="mb-0">{{ $estate->walls }}</p>
    </div>

    <div class="details-left__property-item">
      <p class="text-secondary mb-0">Площадь кухни</p>
      <p class="mb-0">{{ $estate->square_kitchen }} м²</p>
    </div>
    </div>
  </div>

@elseif ($estate->estate_type_id == 4)

  <div class="d-block d-lg-none bg-body p-3 box-shadow rounded-1 mb-3">
    <h3 class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</h3>
    <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }}
    руб./м²
    </p>

    <h4 class="mb-3"> {{ $estate->square }} м²,
    {{ $estate->floor }}/{{ $estate->total_floor }} эт.
    </h4>

    <p class="text-secondary mb-0">{{ $estate->address }}</p>
  </div>

  <div class="details-left__description bg-body p-3 box-shadow rounded-1 mb-3">
    <h3>Описание</h3>
    {!! $estate->description !!}
  </div>

  <div class="details-left__property bg-body p-3 box-shadow rounded-1 mb-3">
    <h3 class="mb-4">Характеристики</h3>

    <div class="details-left__property-main mb-3">
    <h5 class="mb-3">Основные</h5>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Площадь участка</p>
      <p class="mb-0">{{ $estate->square }} м²</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Контактный номер</p>
      <p class="mb-0">{{ $estate->contact_phone }}</p>
    </div>
    </div>


    <div class="details-left__property-flat">
    <h5 class="mb-3">Об участке</h5>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Вид объекта</p>
      <p class="mb-0">{{ $estate->object_type }}</p>
    </div>

    <div class="details-left__property-item mb-1">
      <p class="text-secondary mb-0">Категория недвижимости</p>
      <p class="mb-0">{{ $estate->category }}</p>
    </div>
    </div>
  </div>

@endif

        <div class="details-left__viewing bg-body p-3 box-shadow rounded-1 mb-3">
          <h3>Запланируйте просмотр</h3>
          <p class="text-secondary">
            С вами свяжется специалист по недвижимости, подтвердит выбранное
            время просмотра, организует посещение и проведёт вам
            экскурсию.
          </p>

          <h4>Выберите дату и время</h4>

          <div class="details-left__viewing-date mb-3"></div>

          <div class="row g-2 mb-3">
            <div class="col-12 col-sm-6">
              <div class="form-floating">
                <select class="form-select details-left__viewing-time" id="timeSelect" name="time">
                  <option value="Как можно быстрее" selected>Как можно быстрее</option>
                </select>
                <label for="timeSelect">Время</label>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-floating">
                <input type="tel" name="phone" class="form-control" id="phoneViewingInput" data-tel-input
                  placeholder="Номер телефона" />
                <label for="phoneViewingInput">Номер телефона</label>

                <div class="invalid-tooltip">Укажите, пожалуйста, корректный номер телефона.</div>
              </div>
            </div>
          </div>

          <button class="btn btn-primary w-100 py-2 mb-2 btn-viewing">
            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
            Записаться на просмотр
          </button>

          <p class="mb-0">
            Нажимая кнопку, вы даете согласие на обработку
            <a href="{{ route('personal-data') }}" class="fw-medium border-bottom">персональных данных</a>
          </p>
        </div>

        <div class="details-left__map bg-body p-3 box-shadow rounded-1">
          <h3>Инфраструктура района</h3>

          <ul>
            <li>Оцените уровень комфорта обустройства района</li>
            <li>
              Узнайте расстояние и время до работы, школы или детского
              сада
            </li>
          </ul>
          <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#mapModal">
            <img
              src="https://static.maps.2gis.com/1.0?s=900,400&pt={{ $estate->lat }},{{ $estate->lon }}~u:https://i.postimg.cc/90Ykr5df/marker-1.png~a:0.5,1"
              alt="Карта" class="img-fluid rounded-1" />
          </button>
        </div>
      </div>

      <div class="details-right d-none d-lg-block">
        <form action="{{ route('consultation') }}" class="bg-body p-3 box-shadow rounded-1 form-consultation">
          <input type="hidden" name="is_estate" value="1">
          <h2 class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} руб.</h2>
          <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }}
            руб./м²
          </p>

          <div class="form-floating mb-3">
            <input class="form-control" id="nameInput" placeholder="Ваше имя" name="name_estate_consultation" />
            <label for="nameInput">Ваше имя</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректное имя.</div>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" id="phoneInput" type="tel" data-tel-input placeholder="Ваш номер"
              name="phone_estate_consultation" maxlength="18" />
            <label for="phoneInput">Ваш номер</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректный номер телефона.</div>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
            Перезвонить мне
          </button>

          <p class="mb-0">
            Нажимая кнопку, вы даете согласие на обработку
            <a href="{{ route('personal-data') }}" class="fw-medium border-bottom">персональных данных</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true"
  data-lon="{{ $estate->lon }}" data-lat="{{ $estate->lat }}">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="mapModalLabel">Инфраструктура района</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0" id="map"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://mapgl.2gis.com/api/js/v1"></script>
  <script src="{{ asset('js/realty.js') }}"></script>
  <script src="{{ asset('js/plyr.js') }}"></script>
  <script>validationForm(document.querySelector('.form-consultation')); new Plyr('#player');</script>
@endpush