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
                            $.each(output.features, function (key, place) {
                                if (place.place_type[0] == "region") {
                                    $(".location").text(place.text);
                                    compareLocation(place.text);
                                }
                            });
                        }
                    }
                },
            });
        });
    }
}
getCurrentLocation();

function compareLocation(location) {
    $.ajax({
        url: compare_location_url,
        data: {
            place: location,
        },
        method: "POST",
        success: function (response) {
            if (response.is_changed == true) {
                swal({
                    icon: "warning",
                    text: "Do you want to update your location ?",
                    buttons: true,
                }).then(function (change) {
                    if (change) {
                        $.ajax({
                            url: update_location_url,
                            data: {
                                place: location,
                            },
                            method: "POST",
                            success: function (response) {
                                if (response.success == true) {
                                    swal({
                                        icon: "success",
                                        text: "Your location has been updated successfully",
                                    });
                                    let html =
                                        '<option value="">Select Shop</option>';
                                    $.each(
                                        response.shops,
                                        function (index, name) {
                                            html +=
                                                '<option value="' +
                                                index +
                                                '">' +
                                                name +
                                                "</option>";
                                        }
                                    );

                                    $("#product_shop").html(html);
                                }
                            },
                        });
                    }
                });
            }
        },
    });
}
