<header class="header">
  <nav class="navbar navbar-expand-lg bg-body shadow-sm">
    <div class="container">
      <a class="navbar-brand me-auto d-block d-lg-none" href="{{ route('home') }}"><img
          src="{{ asset('img/logo.png') }}" alt="Логотип" class="logo" /></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
        aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbar">
        <a class="navbar-brand d-none d-lg-block" href="{{ route("home") }}"><img src="{{ asset('img/logo.png') }}"
            alt="Логотип" class="logo" /></a>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route("home") }}">{{__('Главная')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('estate', ['type' => 'novostroyka']) }}">{{__('Новостройки')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('estate', ['type' => 'vtorichnoe']) }}">{{__('Вторичная')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('estate', ['type' => 'dom-dacha']) }}">{{__('Дома, дачи')}}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('estate', ['type' => 'uchastok']) }}">{{__('Участки')}}</a>
          </li>
        </ul>

        <a class="general-link" href="https://arhitek42.ru/">{{__('Дом под ключ')}}</a>
        <a href="tel:+73842657775" class="text-reset">+7 (3842) 65 77 75</a>
      </div>
    </div>
  </nav>

  <div class="feedback" data-bs-toggle="modal" data-bs-target="#feedbackModal">
    <div class="feedback-icon">
      <i class="fa-solid fa-message-lines"></i>
    </div>
  </div>

  @include("includes.feedback-modal")
</header>