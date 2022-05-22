@extends('layouts.app')
@php
$menu='';
@endphp
@section('content')
<style>
    .marker {
        background-image: url('{{asset("/assets/images/marker.png")}}');
        background-size: cover;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
    }
</style>
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
                <div>Your Location : <span id="location"></span></div>
                <div id="map" style="height:400px;width:100%">
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<link href="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.8.2/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWxscHJpY2VjbHViIiwiYSI6ImNsM2dzZnVubzBhY2ozYnBrcGtwdTJndDIifQ.wOey5VSVjjU9kbWg5u10RA';
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
    });

    function getcurrentmaploc(initialLoad) {
        initialLoad = typeof initialLoad !== "undefined" ? initialLoad : 0;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var long = position.coords.longitude;
                var lat = position.coords.latitude;
                $.ajax({
                    url: "https://api.tiles.mapbox.com/v4/geocode/mapbox.places/" + long + "," + lat + ".json?access_token=" + mapboxgl.accessToken,
                    type: "get",
                    dataType: "html",
                    beforeSend: function() {},
                    success: function(responce) {
                        var output = JSON.parse(responce);
                        if (output) {
                            if (output.features) {
                                if (output.features.length > 0) {
                                    console.log(output.features);
                                    $('#location').text(output.features[0].place_name);
                                    map = new mapboxgl.Map({
                                        container: 'map',
                                        style: 'mapbox://styles/mapbox/streets-v11',
                                        center: [long, lat],
                                        zoom: 13
                                    });
                                    const geojson = {
                                        type: 'FeatureCollection',
                                        features: [{
                                            type: 'Feature',
                                            geometry: {
                                                type: 'Point',
                                                coordinates: [long, lat]
                                            },
                                            properties: {
                                                title: 'Mapbox',
                                                description: 'Washington, D.C.'
                                            }
                                        }]
                                    };

                                    for (const feature of geojson.features) {
                                        const el = document.createElement('div');
                                        el.className = 'marker';
                                        new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);
                                    }
                                }
                            }
                        }

                    },
                });
            });
        }
    }
    getcurrentmaploc();
</script>
@endpush
