<footer class="footer bg-body shadow-sm py-3">
  <div class="container">
    <div class="row g-3">
      <div class="col-12 col-lg-4">
        <a href=""><img src="{{ asset('img/logo.png') }}" alt="Логотип" class="logo" /></a>
      </div>

      <div class="col-12 col-lg-4">
        <ul class="list-unstyled mb-0">
          <li class="nav-item">
            <a class="nav-link d-inline-block" href="{{ route('home') }}">Главная</a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-inline-block" href="{{ route('estate', ['type' => 'novostroyka']) }}">Новостройки</a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-inline-block" href="{{ route('estate', ['type' => 'vtorichnoe']) }}">Вторичная</a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-inline-block" href="{{ route('estate', ['type' => 'dom-dacha']) }}">Дома, дачи</a>
          </li>

          <li class="nav-item">
            <a class="nav-link d-inline-block" href="{{ route('estate', ['type' => 'uchastok']) }}">Участки</a>
          </li>
        </ul>
      </div>

      <div class="col-12 col-lg-4">
        <p class="mb-0">650000, г. Кемерово, ул. Тухачевского, 50/5, оф. 405</p>
        <p class="mb-0">пн-пт: 9:00 – 18:00 / сб-вс: выходной</p>
        <p class="mb-0">
          <a href="tel:+73842657775" class="text-reset">+7 (3842) 65 77 75</a>
        </p>
        <p class="mb-0">
          <a href="mailto:mail@arhitek42.ru" class="text-reset">mail@arhitek42.ru</a>
        </p>
      </div>
    </div>
    <hr />
    <div class="d-flex justify-content-between flex-wrap row-gap-3">
      <p class="mb-0">
        Copyright &copy; 2024, ООО "Архитек42", ОГРН: 1194205015927. Все права
        защищены
      </p>
      <a href="{{ route('personal-data') }}" class="text-reset">Политика конфиденциальности</a>
    </div>
  </div>
</footer>