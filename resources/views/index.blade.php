@extends("layouts.base")

@section("content")
<section class="section section-main">
  <div class="container">
    <div class="top">
      <form action="{{ route("estate") }}" class="form-search">
        <div class="row g-3 mb-3">
          <div class="col-12 col-md-6">
            <div class="form-floating">
              <select class="form-select" name="type" id="typeSelect">
                <option selected disabled value="">Выберите тип</option>
                @foreach($types as $type)
          <option value="{{ $type->slug }}">{{ $type->name }}</option>
        @endforeach
              </select>
              <label for="typeSelect">Тип</label>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-floating">
              <select class="form-select" name="rooms" id="bedSelect">
                <option selected disabled value="">
                  Выберите кол-во комнат
                </option>
                <option value="0">Студия</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="more">4+</option>
              </select>
              <label for="bedSelect">Комнатность</label>
            </div>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-12 col-md-6 col-lg-3">
            <div class="form-floating">
              <input type="number" name="from_price" class="form-control" id="priceFromInput"
                placeholder="name@example.com" />
              <label for="priceFromInput">Цена от, руб.</label>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-3">
            <div class="form-floating">
              <input type="number" name="to_price" class="form-control" id="priceToInput"
                placeholder="name@example.com" />
              <label for="priceToInput">Цена до, руб.</label>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-3">
            <div class="form-floating">
              <input type="number" name="from_square" class="form-control" id="squareFromInput"
                placeholder="name@example.com" />
              <label for="squareFromInput">Площадь от, м2</label>
            </div>
          </div>

          <div class="col-12 col-md-6 col-lg-3">
            <div class="form-floating">
              <input type="number" name="to_square" class="form-control" id="squareToInput"
                placeholder="name@example.com" />
              <label for="squareToInput">Площадь до, м2</label>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2">Найти</button>
      </form>
    </div>
  </div>
</section>

<section class="section section-objects">
  <div class="container">
    <div class="section-title">
      <h1 class="mb-0">{{__('Недвижимость в наличии')}}</h1>
      <hr class="opacity-75" />
    </div>

    <div class="row g-3 lists">
      @foreach ($estates as $estate)
      <div class="col-12 col-md-6 col-xxl-4">
      <a class="bg-body lists__item rounded-1 d-block text-reset text-decoration-none"
        href="{{ route('estate.show', $estate) }}">
        <div class="position-relative">
        <img src="{{ asset('storage/' . $estate->images[0]->url[0]) }}" alt="#" class="img-fluid" />
        </div>

        <div class="mt-2 p-3">
        <p class="text-secondary lists__item-address"> {{ $estate->address }} </p>
        <p>{{'Категория: ' . $types->where('slug', $estate->type->slug)->first()->name}}</p>
        <p class="mb-0">{{ number_format($estate->price, 0, '.', ' ') }} {{__('руб.')}}</p>
        <p class="text-secondary">{{ number_format(round($estate->price / $estate->square), 0, '.', ' ') }}
          {{__('руб./м²')}}
        </p>

        <div class="d-flex justify-content-between mb-3">
          <p class="mb-0">{{ $estate->rooms != 0 ? $estate->rooms . '-' . __('комн. кв')
    . '.' : 'Вид: ' . $estate->object_type}} </p>
          <p class="mb-0">{{ $estate->square }} м²</p>
          <p class="mb-0">
          {{$estate->floor != 0 && $estate->floors != 0 ? $estate->floor . '/' . $estate->floors . 'эт.' : ''}}
          </p>
        </div>

        @if ($estate->estate_type_id == 1 || $estate->estate_type_id == 2)
      <p class="mb-0 text-secondary">{{__('Стены')}} : {{ $estate->walls }}</p>
      <p class="mb-0 text-secondary">{{__('Отделка')}} : {{ $estate->repair }}</p>
    @endif
        </div>
      </a>
      </div>
    @endforeach
    </div>
  </div>
  </div>
  </div>
</section>

<section class="section section-consultation">
  <div class="container">
    <div class="section-title">
      <h1 class="mb-0">{{__('Консультируем бесплатно')}}</h1>
      <hr class="opacity-75" />
    </div>
    <form action="{{ route('consultation') }}" method="POST" class="bg-body p-3 box-shadow rounded-1 form-consultation">
      @csrf
      <input type="hidden" name="is_modal" value="0">
      <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
          <div class="form-floating">
            <input class="form-control" id="nameConsultationInput" type="text" name="name" placeholder="Ваше имя" />
            <label for="nameConsultationInput">{{__('Ваше имя')}}</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректное имя.</div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating">
            <input class="form-control" type="tel" name="phone" id="phoneConsultationInput" data-tel-input
              placeholder="Ваш номер" />
            <label for="phoneConsultationInput">{{__('Ваш номер')}}</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректный номер телефона.</div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <button type="submit" class="btn btn-primary h-100 w-100">
            <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
            {{__('Получить консультацию')}}
          </button>
        </div>
      </div>

      <p class="mb-0">
        {{__('Нажимая кнопку, вы соглашаетесь на обработку')}}
        <a href="{{ route('personal-data') }}" class="fw-medium border-bottom">{{__('персональных данных')}}</a>
      </p>
    </form>
  </div>
</section>

<section class="section section-banks">
  <div class="container">
    <div class="section-title">
      <h1 class="mb-0">{{__('Работаем со всеми ведущими банками')}}</h1>
      <hr class="opacity-75" />
    </div>
    <div class="swiper swiper-banks">
      <div class="swiper-wrapper">
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank1.png') }}" alt="#" class="img-fluid" />
        </div>
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank2.png') }}" alt="#" class="img-fluid" />
        </div>
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank3.png') }}" alt="#" class="img-fluid" />
        </div>
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank4.png') }}" alt="#" class="img-fluid" />
        </div>
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank5.png') }}" alt="#" class="img-fluid" />
        </div>
        <div class="swiper-slide box-shadow">
          <img src="{{ asset('img/bank6.png') }}" alt="#" class="img-fluid" />
        </div>
      </div>

      <div class="swiper-pagination"></div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</section>

<section class="section section-reviews">
  <div class="container">
    <div class="section-title">
      <h1 class="mb-0">{{ __('Отзывы') }}</h1>
      <hr class="opacity-75" />
    </div>

    <div class="reviews mb-3">
      <div class="swiper swiper-reviews">
        <div class="swiper-wrapper">
          @foreach($feedbacks as $feedback)
        @if($feedback->is_published)
      <div class="swiper-slide text-center">
      <div class="reviews-item box-shadow bg-body p-3 rounded-1">
        <div class="reviews-item__stars mb-2">
        @for($i = 0; $i < 5; $i++)
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" @class(['active' => $feedback->stars > $i])>
      <path
      d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
      </svg>
    @endfor
        </div>

        <div class="reviews-item__name mb-2">{{ $feedback->name }}</div>
        <div class="reviews-item__message">{{ $feedback->comment }}</div>
      </div>
      </div>
    @endif
      @endforeach

        </div>
        <div class="swiper-button-prev swiper-button-hidden"></div>
        <div class="swiper-button-next swiper-button-hidden"></div>
      </div>
    </div>

    <form action="{{ route('feedback.store') }}" method="POST" class="bg-body p-3 box-shadow rounded-1 form-feedback">
      @csrf
      <div class="row g-3 mb-3">
        <div class="col-12 col-md-5">
          <div class="form-floating">
            <input class="form-control" type="tel" data-tel-input name="feedback_phone" id="phoneFeedbackInput"
              placeholder="Ваш номер" />
            <label for="phoneFeedbackInput">{{ __('Ваш номер') }}</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректный номер телефона.</div>
          </div>
        </div>

        <div class="col-12 col-md-5">
          <div class="form-floating">
            <input class="form-control" type="text" name="feedback_name" id="nameInput" placeholder="Ваше имя" />
            <label for="nameInput">{{ __('Ваше имя') }}</label>
            <div class="invalid-tooltip">Укажите, пожалуйста, корректное имя.</div>
          </div>
        </div>

        <div class="col-12 col-md-2">
          <div class="feedback-stars">
            <div class="feedback-stars__group">
              <input name="stars" value="0" type="radio" checked />

              <label for="feedback-star-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                </svg></label>
              <div class="invalid-tooltip"></div>
              <input name="stars" id="feedback-star-1" value="1" type="radio" />

              <label for="feedback-star-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                </svg></label>
              <input name="stars" id="feedback-star-2" value="2" type="radio" />

              <label for="feedback-star-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                </svg></label>
              <input name="stars" id="feedback-star-3" value="3" type="radio" />

              <label for="feedback-star-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                </svg></label>
              <input name="stars" id="feedback-star-4" value="4" type="radio" />

              <label for="feedback-star-5"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                  <path
                    d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                </svg></label>
              <input name="stars" id="feedback-star-5" value="5" type="radio" />
            </div>
          </div>
        </div>
      </div>

      <div class="form-floating mb-3">
        <textarea class="form-control review-textarea" type="text" name="comment" placeholder="Отзыв"
          id="messageTextarea"></textarea>
        <label for="messageTextarea">{{ __('Комментарий') }}</label>
        <div class="invalid-tooltip">Укажите, пожалуйста, комментарий. (макс. 1000 симв.)</div>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
        <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
        {{ __('Оставить отзыв') }}
      </button>

      <p class="mb-0">
        Оставляя отзыв, вы соглашаетесь на обработку
        <a href="{{ route('personal-data') }}" class="fw-medium border-bottom">персональных данных</a>
      </p>
    </form>
  </div>
</section>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
    validationForm(document.querySelector('.form-consultation'));
    validationForm(document.querySelector('.form-feedback'));
    })
  </script>
@endpush