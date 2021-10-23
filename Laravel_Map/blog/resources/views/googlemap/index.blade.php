@extends('layouts.main')
@section('script')
    
<style>
/* trich tu main.blade.php */
</style>
<div id="map"></div>
<pre id="info"></pre>
<!-- tuday -->
<div id='inputs'></div>
<div id='errors'></div>
<div id='directions'>
  <div id='routes'></div>
  <div id='instructions'></div>
</div>

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
<div id='filters' class='ui-select'>
    <input type='radio' checked=checked class='filter'
         name='filter' id='restaurant' value='restaurant'/><label for='restaurant'>restaurant</label>
    <input type='radio' checked=checked class='filter'
        name='filter' id='bicycle' value='bicycle'/><label for='bicycle'>bicycle</label>
    <input type='radio' checked=checked class='filter'
        name='filter' id='bar' value='bar'/><label for='bar'>bar</label>
</div>

<script>
//Hiển thị bản đồ
mapboxgl.accessToken = 
    'pk.eyJ1IjoiZHJhZ29yZXhpIiwiYSI6ImNrdXFuc2ZnYjJpam4ycG82NGc4dnprZDQifQ.SEB1pvvctns_i8MjVO8PRg';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [105.84203751903286,21.0764765996029], 
        zoom: 9
      });

//chuyen doi style map
    const layerList = document.getElementById('menu');
    const inputs = layerList.getElementsByTagName('input');
        for (const input of inputs) {
            input.onclick = (layer) => {
                const layerId = layer.target.id;
                map.setStyle('mapbox://styles/mapbox/' + layerId);
            };
        }

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

//tim kiem dia diem
    map.addControl(
        new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        })
    );
//thanh công cụ
    const nav = new mapboxgl.NavigationControl()
            map.addControl(nav)
            map.addControl(new mapboxgl.FullscreenControl());

//chi duong
    map.addControl(
        new MapboxDirections({
            accessToken: mapboxgl.accessToken
        }),
        'top-left'
    );
        
// Docs for route event is here:
// https://github.com/mapbox/mapbox-gl-directions/blob/master/API.md#on`enter code here`
    directions.on('route', e => {
// routes is an array of route objects as documented here:
// https://docs.mapbox.com/api/navigation/#route-object:
    let routes = e.route
        routes.map(r => r.legs[0].steps[0].name)//get the origin
        tail=routes.map(r => r.legs[0].steps.length)//get length of instructions
        routes.map(r => r.legs[0].steps[tail-1].name)//get destination
    });
   


//highlight tòa nhà khi zoom
    // map.on('load', () => {
    // map.setPaintProperty('building', 'fill-color', [
    // 'interpolate',['exponential', 0.5],['zoom'],10,'#D9D3C9',15,'#ffd700'
    // ]);
    // map.setPaintProperty('building', 'fill-opacity', ['interpolate',['exponential', 0.5],['zoom'],10,0.5,18,1]);
    // });
    
    // // When the button is clicked, zoom in to zoom level 19.
    // // The animation duration is 9000 milliseconds.
    // document.getElementById('zoom').addEventListener('click', () => {
    // map.zoomTo(18, { duration: 9000 });
    // });
    


</script>
 
@endsection
@section('content')
<div class="container">
</div>
@endsection