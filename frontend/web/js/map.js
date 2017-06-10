
    function initMap() {
        var map, coordinate = true, position;


        map = new google.maps.Map(document.getElementById('map'), {
            center: {"lat": 40.813620, "lng": 43.848372},
            zoom: 14
        });
        var marker = new google.maps.Marker({
            map: map,
            position: {"lat": 40.813620, "lng": 43.848372}
        });
    }


