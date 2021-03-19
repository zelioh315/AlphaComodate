@extends('layouts.app')

@section('content')

    <h1>Map Example</h1>
    <head>
        <p>{{$address['lat']}}</p>
        <p>{{$address['lng']}}</p>
        <p>{{$address['formatted_address']}}</p>
        <div id="map" style="width:100%;height:400px;"></div>   
        <script>
          let marker;
    
          function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
              zoom: 16,
              center: { lat: {{$address['lat']}}, lng: {{$address['lng']}} },
            });
            marker = new google.maps.Marker({
              map,
              draggable: true,
              animation: google.maps.Animation.DROP,
              position: { lat: {{$address['lat']}}, lng: {{$address['lng']}} },
            });
            marker.addListener("click", toggleBounce);
          }
    
            function toggleBounce() {
              if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
              } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
              }
            }
        </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvxoZdoTf5GcBFXLOWKVI_jElP7mlU-28&callback=initMap&libraries=&v=weekly"async></script>
  </div>

    </head>

@endsection