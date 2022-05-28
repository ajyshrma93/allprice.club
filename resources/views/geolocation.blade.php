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
<script>
    function loadLoctionOnMap(initialLoad) {
        initialLoad = typeof initialLoad !== "undefined" ? initialLoad : 0;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var long = position.coords.longitude;
                var lat = position.coords.latitude;
                $.ajax({
                    url: "https://api.tiles.mapbox.com/v4/geocode/mapbox.places/" +
                        long +
                        "," +
                        lat +
                        ".json?access_token=" +
                        mapboxgl.accessToken,
                    type: "get",
                    dataType: "html",
                    beforeSend: function() {},
                    success: function(responce) {
                        var output = JSON.parse(responce);
                        if (output) {
                            if (output.features) {
                                if (output.features.length > 0) {
                                    $("#location").text(
                                        output.features[0].place_name
                                    );
                                    map = new mapboxgl.Map({
                                        container: "map",
                                        style: "mapbox://styles/mapbox/streets-v11",
                                        center: [long, lat],
                                        zoom: 13,
                                    });
                                    const geojson = {
                                        type: "FeatureCollection",
                                        features: [{
                                            type: "Feature",
                                            geometry: {
                                                type: "Point",
                                                coordinates: [long, lat],
                                            },
                                            properties: {
                                                title: "Mapbox",
                                                description: "Washington, D.C.",
                                            },
                                        }, ],
                                    };
                                    map.addControl(
                                        new mapboxgl.GeolocateControl({
                                            positionOptions: {
                                                enableHighAccuracy: true,
                                            },
                                            // When active the map will receive updates to the device's location as it changes.
                                            trackUserLocation: true,
                                            // Draw an arrow next to the location dot to indicate which direction the device is heading.
                                            showUserHeading: true,
                                        })
                                    );
                                    for (const feature of geojson.features) {
                                        const el = document.createElement("div");
                                        el.className = "marker";
                                        new mapboxgl.Marker(el)
                                            .setLngLat(feature.geometry.coordinates)
                                            .addTo(map);
                                    }
                                }
                            }
                        }
                    },
                });
            });
        }
    }
    loadLoctionOnMap();
</script>

@endpush
