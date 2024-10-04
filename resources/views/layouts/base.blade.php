<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config("app.name", "Агенство недвижимости") }}</title>

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/fontawesome.all.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/lightgallery-bundle.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
</head>

<body class="bg-body-tertiary">
    @if (session('success'))
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                swal({
                    text: "{{ session('success') }}",
                    icon: 'success'
                });
            })
        </script>
    @endif
  @include("includes.header")

  <main class="main">
    @yield("content")
  </main>

  @include("includes.footer")

  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('js/lg-thumbnail.min.js') }}"></script>
  <script src="{{ asset('js/lg-zoom.min.js') }}"></script>
  <script src="{{ asset('js/lightgallery.min.js') }}"></script>
  <script src="{{ asset('js/phoneinput.js') }}"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>

  @stack('scripts')
</body>

</html>