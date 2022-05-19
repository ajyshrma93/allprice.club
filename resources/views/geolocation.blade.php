@extends('layouts.app')
@php
$menu='';
@endphp
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-6">
                    <h3 class="user-itesm-title">Geo Location</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div id="map">
                    <p>Ip Address : {{request()->ip()}}</p>
                </div>
                @foreach ((array) $userLocation as $key => $value )
                @php
                if($key == 'driver'){
                    continue;
                }
                @endphp
                {{$key}} : {{$value}} </br>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }
</script>
@endpush