google.maps.event.addDomListener(window, 'load', init);
var map;
function init() {
    var mapOptions = {
        center: new google.maps.LatLng(43.293375,13.004239),
        zoom: 8,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
        },
        disableDoubleClickZoom: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        },
        scaleControl: true,
        scrollwheel: true,
        panControl: true,
        streetViewControl: true,
        draggable : true,
        overviewMapControl: true,
        overviewMapControlOptions: {
            opened: false,
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    var mapElement = document.getElementById('mappa');
    var map = new google.maps.Map(mapElement, mapOptions);
    var locations = [
        ['Eastern Analogic', 'Da: Lunedi a Venerdi | ore : 8.30-12.30 / 15.30-18.30', '+39 071.220.1', 'undefined', 'undefined', 43.586533,  13.517393, 'http://tweb.dii.univpm.it/~grp_57/ZendProject/public/images/map-green.png'],['Eastern Analogic', 'Da: Lunedi a Venerdi | ore : 8.30-12.30 / 15.30-18.30', '+39 0735.757.677', 'undefined', 'undefined', 42.914777,  13.890880, 'http://tweb.dii.univpm.it/~grp_57/ZendProject/public/images/map-green.png']
    ];
    for (i = 0; i < locations.length; i++) {
        if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
        if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
        if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
        if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
        if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
        marker = new google.maps.Marker({
            icon: markericon,
            position: new google.maps.LatLng(locations[i][5], locations[i][6]),
            map: map,
            title: locations[i][0],
            desc: description,
            tel: telephone,
            email: email,
            web: web
        });
        link = '';            bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web, link);
    }
    function bindInfoWindow(marker, map, title, desc, telephone, email, web, link) {
        var infoWindowVisible = (function () {
            var currentlyVisible = false;
            return function (visible) {
                if (visible !== undefined) {
                    currentlyVisible = visible;
                }
                return currentlyVisible;
            };
        }());
        iw = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, 'click', function() {
            if (infoWindowVisible()) {
                iw.close();
                infoWindowVisible(false);
            } else {
                var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+title+"</h4><p>"+desc+"<p><p>"+telephone+"<p></div>";
                iw = new google.maps.InfoWindow({content:html});
                iw.open(map,marker);
                infoWindowVisible(true);
            }
        });
        google.maps.event.addListener(iw, 'closeclick', function () {
            infoWindowVisible(false);
        });
    }
}
