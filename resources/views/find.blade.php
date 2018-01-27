@extends('app')

@section('content')
<div class="panel-body">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            @include('errors.errors')
        </div>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
    <form action="/find" method="POST" class="form-horizontal" id="findform">
    {{ csrf_field() }}

        <div class="form-group">
            <label class="col-sm-3 control-label">Your location</label>

            <div class="col-sm-6">
                <input type="text" name="location" id="location" class="form-control">
            </div>
            <input type="text" name="idclosest" id="idclosest" class="form-control hidden">

            <input type="text" name="duration" id="duration" class="form-control hidden">

        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="btn btn-default" onclick="getDistance()">
                    <i class="fa fa-plus"></i> Find closest
                </div>
                <div class="btn btn-default" onclick="getLocation()">
                   Get my location
                </div>
            </div>
        </div>

    </form>

    </div>
</div>

<script>

    function getLocation() {
        var options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        function success(pos) {
            var crd = pos.coords;

            console.log('Your current position is:');
            console.log('Latitude : ' + crd.latitude);
            console.log('Longitude: ' + crd.longitude);
            getDistance(crd.latitude,crd.longitude);

        };

        function error(err) {
            console.warn('ERROR(' + err.code + '): ' + err.message);
        };

        //Used for testing
        //getDistance(41.9703574,-7.654443);
        navigator.geolocation.getCurrentPosition(success, error, options);

    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }


    function getDistance(lat=0,long=0) {
        var restaurants = {!! $restaurants !!};
        var locations = ArrayLocation(restaurants);
        console.log($("#location").val());
        if (lat==0 && long ==0){

            var origin1 = $("#location").val();
        }else {
            var origin1 = new google.maps.LatLng(lat, long)
        }


        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [origin1],
                destinations: locations,
                travelMode: 'WALKING',
            }, callback);

        function callback(response, status) {
            if (status == 'OK') {
                var origins = response.originAddresses;
                var origin0 = origins[0];
                var destinations = response.destinationAddresses;
                var closest= destinations[0];
                var mindur = response.rows[0].elements[0].duration.value;
                var mindurstr = response.rows[0].elements[0].duration;
                var restaurantid=restaurants[0].id;
                for (var i = 0; i < origins.length; i++) {
                    var results = response.rows[i].elements;
                    for (var j = 0; j < results.length; j++) {
                        var element = results[j];
                        var distance = element.distance.text;
                        var duration = element.duration.text;
                        var from = origins[i];
                        var to = destinations[j];
                        console.log("From "+from+" to "+to);
                        console.log("Distance " + distance);
                        console.log("Duration " + duration);
                        if (mindur>element.duration.value){
                            origin0=from;
                            closest=to;
                            mindurstr=element.duration;
                            restaurantid=restaurants[j].id;
                        }
                    }
                }
                console.log("Closest: "+closest);
                console.log("Duration: "+mindurstr.text);
                $("#idclosest").val(restaurantid);
                $("#location").val(origin0);
                $("#duration").val(mindurstr.text);
                $("#findform").submit();
            }

        }
    }

    function ArrayLocation(restaurants) {
        locations=[];
        for (var i=0; i < restaurants.length;i++){
            locations.push(restaurants[i].location);
        }
        return locations;
    }


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACKvwp0jrbkfuJW4kNN3vZKmOY8k1ybEY">
</script>

@endsection