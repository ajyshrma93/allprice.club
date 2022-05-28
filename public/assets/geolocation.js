mapboxgl.accessToken =
    "pk.eyJ1IjoiYWxscHJpY2VjbHViIiwiYSI6ImNsM2dzZnVubzBhY2ozYnBrcGtwdTJndDIifQ.wOey5VSVjjU9kbWg5u10RA";
var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
});
function getCurrentLocation(initialLoad) {
    initialLoad = typeof initialLoad !== "undefined" ? initialLoad : 0;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var long = position.coords.longitude;
            var lat = position.coords.latitude;
            $.ajax({
                url:
                    "https://api.tiles.mapbox.com/v4/geocode/mapbox.places/" +
                    long +
                    "," +
                    lat +
                    ".json?access_token=" +
                    mapboxgl.accessToken,
                type: "get",
                dataType: "html",
                beforeSend: function () {},
                success: function (responce) {
                    var output = JSON.parse(responce);
                    if (output) {
                        if (output.features) {
                            if (output.features.length > 0) {
                                $(".location").text(
                                    output.features[0].place_name
                                );
                            }
                        }
                    }
                },
            });
        });
    }
}
getCurrentLocation();
