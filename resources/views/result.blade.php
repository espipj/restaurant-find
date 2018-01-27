@extends('app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">

@endsection
@section('content')


    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1>Restaurant Detail</h1>
            </div>
        </div>

        <div class="panel-info col-sm-6 col-sm-offset-3">
            <h3>Name: {{$restaurant->name}}</h3>
            <h3>Location: {{$restaurant->location}}</h3>
            <h3>Walk time: {{$duration}}</h3>
        </div>
        <p class="hidden" id="location">{{$location}}</p>

    </div>

    <div class="container-fluid">
        <div id="map" class="map"></div>
    </div>


    <script charset="utf-8">
        var dest= {!! $restaurant !!};
        var locs= $("#location").text();
        console.log(locs);
        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
            });
            directionsDisplay.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {


            directionsService.route({
                origin: locs,
                destination: dest.location,
                travelMode: 'WALKING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACKvwp0jrbkfuJW4kNN3vZKmOY8k1ybEY&callback=initMap">
    </script>



@endsection