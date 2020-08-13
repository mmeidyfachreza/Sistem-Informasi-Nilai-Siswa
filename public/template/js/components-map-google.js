function createBasicMap(id, lat, long, markerImage) {

    var location = new google.maps.LatLng(lat, long);

    var mapCanvas = document.getElementById(id);
    var mapOptions = {
        zoom: 14,
        scrollwheel: false,
        center: location
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);

    marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: markerImage
    });

}

function createSimpleMap(id, lat, long, markerImage) {

    var location = new google.maps.LatLng(lat, long);

    var mapCanvas = document.getElementById(id);
    var mapOptions = {
        zoom: 14,
        scrollwheel: false,
        center: location,
        styles: [{
            featureType: "landscape", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "transit", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "water", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "road", elementType: "labels.icon", stylers: [{ visibility: "off" }]
        }, {
            stylers: [{ hue: "#00aaff" }, { saturation: -100 }, { gamma: 2.15 }, { lightness: 12 }]
        }, {
            featureType: "road", elementType: "labels.text.fill", stylers: [{ visibility: "on" }, { lightness: 24 }]
        }, {
            featureType: "road", elementType: "geometry", stylers: [{ lightness: 57 }]
        }]
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);

    marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: markerImage
    });

}

function createAdvancedMap(id, lat, long, json, markerImage) { 

    var location = new google.maps.LatLng(lat, long);

    var mapCanvas = document.getElementById(id);
    var mapOptions = {
        zoom: 14,
        scrollwheel: false,
        center: location,
        styles: [{
            featureType: "landscape", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "transit", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "water", elementType: "labels", stylers: [{ visibility: "off" }]
        }, {
            featureType: "road", elementType: "labels.icon", stylers: [{ visibility: "off" }]
        }, {
            stylers: [{ hue: "#00aaff" }, { saturation: -100 }, { gamma: 2.15 }, { lightness: 12 }]
        }, {
            featureType: "road", elementType: "labels.text.fill", stylers: [{ visibility: "on" }, { lightness: 24 }]
        }, {
            featureType: "road", elementType: "geometry", stylers: [{ lightness: 57 }]
        }]
    }
    var map = new google.maps.Map(mapCanvas, mapOptions);

    var newMarkers = [];
    var markerClicked = 0;
    var activeMarker = false;
    var lastClicked = false;

    for (var i = 0; i < json.length; i++) {

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(json[i].latitude, json[i].longitude),
            map: map,
            icon: markerImage
        });

        // place marker
        newMarkers.push(marker);

        //infobox

        var infoboxContent = document.createElement("div");
        var infoboxOptions = {
            content: infoboxContent,
            disableAutoPan: false,
            pixelOffset: new google.maps.Size(-325, -60),
            zIndex: null,
            alignBottom: true,
            boxClass: "infobox",
            enableEventPropagation: true,
            closeBoxMargin: "0px 0px -30px 0px",
            closeBoxURL: "img/map-close.png",
            infoBoxClearance: new google.maps.Size(1, 1)
        };
        // infobox html

        infoboxContent.innerHTML = drawInfobox(infoboxContent, json, i);

        newMarkers[i].infobox = new InfoBox(infoboxOptions);

        google.maps.event.addListener(marker, 'click', function() {
            // reference clicked marker
            var curMarker =  this;
            // loop through all markers
            $.each(newMarkers, function(index, marker) {
                // if marker is not the clicked marker, close the marker
                if(marker !== curMarker) {
                    marker.infobox.close();
                }
            });

            curMarker.infobox.open(map, this);
          });
    }
}

function drawInfobox(infoboxContent, json, i) {

    if (json[i].name) {
        var title = '<h3><a href="' + json[i].link + '">' + json[i].name + '</a></h3>'
    }
    else {
        title = ''
    }

    if (json[i].about) {
        var about = '<p class="about">' + json[i].about + '</p>'
    }
    else {
        about = ''
    }

    if (json[i].address) {
        var address = '<p class="address"><i class="fa fa-map-marker"></i>' + json[i].address + '</p>'
    }
    else {
        address = ''
    }
    if (json[i].image) {
        var image = '<div class="image" style="background-image: url(\'' + json[i].image + '\')"></div>';
    }
    else {
        image = '<div class="image"></div>'
    }

    if (json[i].email) {
        var email = '<i class="fa fa-envelope-o"></i><a href="mailto:' + json[i].email + '">' + json[i].email + '</a><br>'
    }
    else {
        email = ''
    }
    if (json[i].phone) {
        var phone = '<i class="fa fa-phone"></i>' + json[i].phone + '<br>'
    }
    else {
        phone = ''
    }

    if (json[i].url) {
        var url = '<a href="' + json[i].url + '">' + json[i].url + '</a><br>'

    }
    else {
        url = ''
    }

    var ibContent = '';
    ibContent =
        '<div class="infobox clearfix">' +
        '<div class="inner">' +
        image +
        '<div class="text">' +
        title +
        about +
        address +
        '<p class="details">' +
        email +
        phone +
        '</p>' +
        '</div>' +
        '</div>' +
        '</div>';
    return ibContent;
}





