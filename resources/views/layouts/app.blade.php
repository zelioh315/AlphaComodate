<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlphaComodate') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="/storage/wallpaper/alicon11.png"  />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script src="js/bootstrap.min.js">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- Icons -->
     {{-- <script src='http://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> --}}
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <style>
        .owl-carousel .item {
          height: 15rem;
          /* background: #595a5a; */
          padding: 1rem;
        }
        .owl-carousel .item h4 {
          color: #FFF;
          font-weight: 400;
          margin-top: 0rem;
         }
        </style>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
        <script>
        jQuery(document).ready(function($){
          $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            autoplay:true,
            autoplayTimeout:3000,
            responsive:{
              0:{
                items:1
              },
              600:{
                items:3
              },
              1000:{
                items:5
              }
            }
          })
        })
        </script>
     
     <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    
</head>
<body>
    <a name="top"></a>
    <div id="app">
        <main class="py-4">
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
            @yield('content')
        </div>
            @include('inc.foot')
        </main>
    </div>
    
    {{-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script >
        CKEDITOR.replace('summary-ckeditor');
</script> --}}

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YourAPIKey"></script>
<script>
    function initialize() {
        var options = {
        // types: ['(cities)']['address','geocode'],
        componentRestrictions: {country: "uk"}
        };
      var input = document.getElementById('searchTextField');
      var autocomplete = new google.maps.places.Autocomplete(input,options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- <script>
    var lat ;//= document.getElementById("lat");
    var long ;//= document.getElementById("long");
    // function getLocation() {
      if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        alert("Geolocation is not supported by this browser.") ;
      }
    
    
    function showPosition(position) {
        lat = position.coords.latitude ;
        long = position.coords.longitude;

        // document.getElementById('user_lat').value = lat;
        // document.getElementById('user_lng').value = long;
    }

    var latlng;
        latlng = new google.maps.LatLng(lat, long);

        new google.maps.Geocoder().geocode({'latLng' : latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    var country = null, countryCode = null, city = null, cityAlt = null;
                    var c, lc, component;
                    for (var r = 0, rl = results.length; r < rl; r += 1) {
                        var result = results[r];

                        if (!city && result.types[0] === 'locality') {
                            for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                                component = result.address_components[c];

                                if (component.types[0] === 'locality') {
                                    city = component.long_name;
                                    break;
                                }
                            }
                        }
                        else if (!city && !cityAlt && result.types[0] === 'administrative_area_level_1') {
                            for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                                component = result.address_components[c];

                                if (component.types[0] === 'administrative_area_level_1') {
                                    cityAlt = component.long_name;
                                    break;
                                }
                            }
                        } else if (!country && result.types[0] === 'country') {
                            country = result.address_components[0].long_name;
                            countryCode = result.address_components[0].short_name;
                        }

                        if (city && country) {
                            break;
                        }
                    }

                    console.log("City: " + city + ", City2: " + cityAlt + ", Country: " + country + ", Country Code: " + countryCode);
                }
            }
        });
    </script>
 --}}

</body>
</html>
