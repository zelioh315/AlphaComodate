@extends('layouts.app')

@section('content')
 <br>
 <br>
      <div class="card mb-3">
        <div id="Map" class="tabcontent">
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
                    draggable: false,
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
      </div>

      <div class="col">
      <h3>Property Description</h3>
      <hr>
      <ul>
      <li>Number of Rooms: {{$properties->number_of_rooms}}</li>
      <li>Number of Baths: {{$properties->number_of_baths}}</li>
      <li>Property Type: {{$properties->property_type}}</li>
        <li>Price: {{$properties->price}}pcm</li>
      </ul>
      </div>
      

        <script>
          function openTab(evt, tabTitle) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabTitle).style.display = "block";
            evt.currentTarget.className += " active";
          }

          document.getElementById("defaultOpen").click();
        </script>

        <script>
          var str = {{$properties->features}};
            var facilities = str.split("\n");
            for(x = 0; x< facilities.length; x++){
              document.getElementById("facilities").innerHTML = facilities[x] + <br> ;
            }
        </script>


@endsection