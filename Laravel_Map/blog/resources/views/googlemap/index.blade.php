@extends('layouts.main')
@section('script')
<style>
/* trich tu main.blade.php */
</style>
<div id="map"></div>
<pre id="info"></pre>
<!-- tuday -->

<div id="menu">
  <input id="streets-v11" type="radio" name="rtoggle" value="streets" checked="checked">
  <label for="streets-v11">Mặc định</label>
  <input id="satellite-v9" type="radio" name="rtoggle" value="satellite">
  <!-- See a list of Mapbox-hosted public styles at -->
  <!-- https://docs.mapbox.com/api/maps/styles/#mapbox-styles -->
  <label for="satellite-v9">Vệ tinh</label>
  <input id="dark-v10" type="radio" name="rtoggle" value="dark">
  <label for="dark-v10">Màu tối</label>
  <input id="outdoors-v11" type="radio" name="rtoggle" value="outdoors">
  <label for="outdoors-v11">Ngoài trời</label>
</div>

<script>
    //Hiển thị bản đồ
    mapboxgl.accessToken = 'pk.eyJ1IjoiZHJhZ29yZXhpIiwiYSI6ImNrdXFuc2ZnYjJpam4ycG82NGc4dnprZDQifQ.SEB1pvvctns_i8MjVO8PRg';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [105.84203751903286,21.0764765996029], 
        zoom: 9
    });
    
    //tao searchbar token cho ban do
    const coordinatesGeocoder = function (query) {
// Match anything which looks like
// decimal degrees coordinate pair.
    const matches = query.match(
    /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
    );
    if (!matches) {
        return null;
    }
    
    function coordinateFeature(lng, lat) {
    return {
        center: [lng, lat],
        geometry: {
        type: 'Point',
        coordinates: [lng, lat]
        },
        place_name: 'Lat: ' + lat + ' Lng: ' + lng,
        place_type: ['coordinate'],
        properties: {},
        type: 'Feature'
        };
    }
    
    const coord1 = Number(matches[1]);
    const coord2 = Number(matches[2]);
    const geocodes = [];
    
    if (coord1 < -90 || coord1 > 90) {
    // must be lng, lat
        geocodes.push(coordinateFeature(coord1, coord2));
    }
    
    if (coord2 < -90 || coord2 > 90) {
    // must be lat, lng
        geocodes.push(coordinateFeature(coord2, coord1));
    }
    
    if (geocodes.length === 0) {
    // else could be either lng, lat or lat, lng
        geocodes.push(coordinateFeature(coord1, coord2));
        geocodes.push(coordinateFeature(coord2, coord1));
    }
    
    return geocodes;
    };
    
    // Add the control to the map.
    map.addControl(
        new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            localGeocoder: coordinatesGeocoder,
            zoom: 4,
            placeholder: 'Nhập tọa độ cần tìm',
            mapboxgl: mapboxgl,
            reverseGeocode: true
        })
    );

    //chuyen doi style map
        const layerList = document.getElementById('menu');
        const inputs = layerList.getElementsByTagName('input');
        for (const input of inputs) {
        input.onclick = (layer) => {
        const layerId = layer.target.id;

        map.setStyle('mapbox://styles/mapbox/' + layerId);
        };
        }
    //Marker for map
        var test ='<?php echo $dataArray;?>';
        var dataMap = JSON.parse = JSON.parse(test);

        dataMap.features.forEach(function(marker) {
        
    //tạo thẻ div có class là marker, để hồi chỉnh css cho marker
        const el = document.createElement('div');
        el.className = 'marker';

    //gắn marker đó tại vị trí tọa độ
        new mapboxgl.Marker(el).setLngLat(marker.geometry.coordinates)
            .setLngLat(marker.geometry.coordinates)
            .setPopup(
                new mapboxgl.Popup({ offset: 25 }) // add popups
                    .setHTML(
                        // `<h3>${marker.properties.name}</h3><p>${marker.properties.address}</p>`
                        '<h3>' + marker.properties.name + '</h3><p>' + marker.properties.address + '</p><p>' + marker.properties.phone + '</p>'
                    )
                )
            .addTo(map);
        });

//thanh công cụ
    const nav = new mapboxgl.NavigationControl()
    map.addControl(nav)
    map.addControl(new mapboxgl.FullscreenControl());

//lay toa do tai con tro 
  map.on('mousemove', (e) => {
    document.getElementById('info').innerHTML =
    // `e.point` is the x, y coordinates of the `mousemove` event
    // relative to the top-left corner of the map.
    JSON.stringify(e.point) +
    '<br />' +
    // `e.lngLat` is the longitude, latitude geographical position of the event.
    JSON.stringify(e.lngLat.wrap());
  });

 
//chỉ đường

    map.addControl(new MapboxDirections({
        accessToken: mapboxgl.accessToken
        }),
        'top-left'
    );


//highlight tòa nhà khi zoom
    map.on('load', () => {
    map.setPaintProperty('building', 'fill-color', [
    'interpolate',['exponential', 0.5],['zoom'],10,'#D9D3C9',15,'#ffd700'
    ]);
    map.setPaintProperty('building', 'fill-opacity', ['interpolate',['exponential', 0.5],['zoom'],10,0.5,18,1]);
    });
    
    // When the button is clicked, zoom in to zoom level 19.
    // The animation duration is 9000 milliseconds.
    document.getElementById('zoom').addEventListener('click', () => {
    map.zoomTo(18, { duration: 9000 });
    });
</script>
 
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
           
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- tao 1 searchbar -->
            <!-- <form action="{{ route('search') }}" method="GET"> -->
           <!-- <form action="{{route('boxmap.index')}}" method="post" id="boxmap"> -->
           @csrf
                <!-- <div class="form-group">
                    <label for="name">Search</label>
                    <input type="text" name="name" placeholder="Search BoxMap" class="form-control"/>
                </div>
                
                <div class="form-group">
                    <input type="submit" name="submit" value="Search Location" class="btn btn-success"/>
                </div> -->
            </form>
        </div>
    </div>
</div>
@endsection