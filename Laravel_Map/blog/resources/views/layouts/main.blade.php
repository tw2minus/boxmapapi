<!DOCTYPE html>
<html>
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Styles -->
<script src="{{asset('js/app.js')}}" defer></script>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<script src="{{asset('js/jquery.min.js')}}"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.5.1/mapbox-gl.js"></script>
  </head>
  <body>
    <!-- Load the `mapbox-gl-geocoder` plugin. -->
    <div >
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">

  <!-- load the direction map -->
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css">
<!-- link gi` do geocoder tim` vi tri -->
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" type="text/css">
 
        @yield('content')
    </div>
  </body>
<style>
    body {
        margin: 0;
        padding: 0;
    }
    #map {
      position: absolute; 
      top: 0; 
      bottom: 0; 
      width: 100%;
    }
    .marker {
        background-image: url('https://smarttrain.edu.vn/assets/uploads/2017/10/678111-map-marker-512.png');
        background-size: cover;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;

    }
    .mapboxgl-popup {
        max-width: 200px;
    }
    .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    }
    .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
    }
    #info {
      display: table;
      position: relative;
      margin: 0px auto;
      word-wrap: anywhere;
      white-space: pre-wrap;
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 12px;
      text-align: center;
      color: #222;
      background: #fff;
    }
    #zoom {
      display: block;
      position: relative;
      margin: 20px auto;
      width: 50%;
      height: 40px;
      padding: 10px;
      border: none;
      border-radius: 3px;
      font-size: 12px;
      text-align: center;
      color: #fff;
      background: #ee8a65;
    }
    #menu {
      position: absolute;
      background: #efefef;
      padding: 15px;
      font-family: 'Open Sans', sans-serif;
      bottom:0;
     
    }
</style>

@yield('script')
</html>