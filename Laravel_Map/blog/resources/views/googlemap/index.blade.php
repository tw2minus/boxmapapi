@extends('layouts.main')
@section('script')
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZHJhZ29yZXhpIiwiYSI6ImNrdHY4bTB2azBoODIydXFtcjIzNmtrNG0ifQ.EihMX207_FyF-sTdaxwWlA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [ 105.84203751903286,21.0764765996029], //lng,lat 10.818746, 106.629179
        zoom: 9
    });
  
    </script>
    <style>
        #map {
            width: 100%;
            height: 700px;
        }
        .marker {
            background-image: url('E:\Xamppre\htdocs\Laravel_Map\blog\storage\marker\placeholder.png'); 
            background-repeat:no-repeat;
            background-size:100%;
            width: 50px;
            height: 100px;
            cursor: pointer; 
        }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2>Google Map</h2>
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
           <form action="{{route('boxmap.index')}}" method="post" id="boxmap">
           @csrf
                <div class="form-group">
                    <label for="title">Search</label>
                    <input type="text" name="title" placeholder="Search BoxMap" class="form-control"/>
                </div>
                
                <div class="form-group">
                    <input type="submit" name="submit" value="Search Location" class="btn btn-success"/>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h2>Show google Map</h2>
            <div id="map"></div>       
        </div>
    </div>
</div>
@endsection