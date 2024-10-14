@extends("layouts.base")
@section("content")
<section class="section-map" id="map"></section>
@endsection
@push('scripts')
  <script src="https://mapgl.2gis.com/api/js/v1"></script>
  <script src="{{ asset('js/clustering.js') }}"></script>
  <script>
    const map = new mapgl.Map('map', {
    zoom: 13,
    key: 'b0394cab-b1f6-45a8-b6e7-2e205fb132fd',
    });
    const markers = [
    @foreach($estates as $estate)
      {
      coordinates: [{{ $estate->lon }}, {{ $estate->lat }}],
      anchors: [20, 40],
      type: 'html',
      html: `
      <div class="marker-wrapper">
      <div class="marker mini"></div>
      <div class="marker-popup rounded-1">
      {{ $estate->price >= 1000000 ? number_format($estate->price / 1000000, 1, '.', '') . ' млн.' : number_format($estate->price / 1000, 0, '.', '') . ' тыс.' }} руб.
      <div class="marker-popup__arrow"></div>
      </div>
      <a class="marker-popup__detail p-2 column-gap-2 overflow-hidden bg-body box-shadow rounded-1 text-reset" href="{{ route('estate.show', $estate->id) }}" target="_blank" rel="noopener noreferrer">
      <img src="{{ asset('storage/' . $estate->images[0]->url[0]) }}" class="marker-popup__detail-img rounded-1" />
      <div class="marker-popup__detail-info">
      <p class="mb-0">{{ $estate->rooms }}-комн. кв.</p>
      <p class="mb-0"><span class="fw-bold">{{ number_format($estate->price, 0, '.', ' ') }} руб.</span> {{ $estate->square }} м²</p>
      <p class="mb-0">{{ $estate->address }}</div>
      </div>
      </a>
      </div>`,
    },
  @endforeach
    ];
    const markerCoordinates = markers.map(marker => marker.coordinates);
    const markerCoordinatesLength = markerCoordinates.length;
    const averageCoordinates = markerCoordinates.reduce(
    (acc, coords) => {
      acc[0] += coords[0]; // Долгота
      acc[1] += coords[1]; // Широта
      return acc;
    },
    [0, 0]
    ).map(coord => coord / markerCoordinatesLength);
    map.setCenter(averageCoordinates);
    const markerPopupsClose = () => {
    const popups = document.querySelectorAll('.marker-popup__detail');
    popups.forEach((popup) => popup.classList.remove('active'));
    };
    const clusterer = new mapgl.Clusterer(map, {
    radius: 80,
    disableClusteringAtZoom: 20,
    clusterStyle: (count) => {
      return {
      type: 'html',
      html: `<div class="cluster">${count}</div>`,
      };
    },
    });
    clusterer.load(markers);
    clusterer.on('click', (event) => {
    if (event.target.type === 'marker') {
      const parentElement = event.originalEvent.target.parentElement;
      let popupDetail = parentElement?.querySelector('.marker-popup__detail');
      if (popupDetail && !popupDetail.classList.contains('active')) {
      markerPopupsClose();
      popupDetail.classList.add('active');
      }
    }
    });
    map.on('click', markerPopupsClose);
    map.on('zoom', markerPopupsClose);
  </script>
@endpush