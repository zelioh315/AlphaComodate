@extends('layouts.app')
   
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="/storage/wallpaper/alicon11.png"  />

<style>
    /* body, html {
      height: 100%;
      font-family: Arial, Helvetica, sans-serif;
    } */
    
    * {
      box-sizing: border-box;
    }
    
    .bg-img {
      /* The image used */
      background-image: url("/storage/wallpaper/alpha.jpg" );
      height: 100%; 

    
      /* min-height: 380px; */
    
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      /* background-size: 100%; */
      
    }
    
    /* Add styles to the form container */
    .homepage {
      position: absolute;
      left: 5%;
      margin: 20px;
      max-width: 650px;
      max-height: 1000px;
      padding: 16px;
      /* position: absolute;
      left: 25%;
      margin: 20px;
      max-width: 650px;
      max-height: 1000px;
      padding: 16px; */
      /* background-color: #f7f7ab; */
      background: rgba(230, 225, 241, 0.35);
     
      
    }
    
    /* Full-width input fields */
    /* input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    } */
    
    /* input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    } */
    
    /* Set a style for the submit button */
    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      opacity: 0.9;
    }
    
    .btn:hover {
      opacity: 1;
    }
    </style>
 
 
 <a name="top"></a>
    {{-- <h2>Form on Hero Image</h2> --}}
    <div class="bg-img">
        <br><br><br>
        
        <form name="myForm" method="get"  novalidate="novalidate" onsubmit="return validateForm()" class="homepage" action="{{url('/properties/{radius}/{lng}/{lat}')}}">
            <h3> Search Properties for Rent around you</h3>
            @csrf
            <div class="form-row align-items-center">
              <div class="col-md-8 offset-md-0">
                {{-- <label class="sr-only" for="inlineFormInput">place</label> --}}
                <b><label for="location">Location</label></b>
                 <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i style='font-size:20px' class="material-icons">&#xe55c;</i></div>
                    </div>
                    @php
                        $placeholder = ' eg. luton, peckham or se25';
                    @endphp
                {{-- <input type="text" class="form-control" id="inlineFormInput" placeholder="Jane Doe"> --}}
                <input class="form-control @error('searchTextField') is-invalid @enderror" id="searchTextField" name="searchTextField" type="text"  placeholder="{{$placeholder}}" autocomplete="on" runat="server"  autocomplete="searchTextField" required>  
                                 @error('searchTextField')
                                    <span class="invalid-feedback" role="alert">
                                      {{-- <strong> Please enter location</strong> --}}
                                    </span>
                                @enderror
                <input type="hidden" id="city2" name="city2" />
                <input type="hidden" id="cityLat" name="cityLat" />
                <input type="hidden" id="cityLng" name="cityLng" />
              </div>
              </div>
              <div class="col-md-4 offset-md-0">
                <b><label for="Radius">Search radius</label></b>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class="material-icons">&#xe569;</i></div>
                  </div>
                  {{-- <input type="text" class="form-control" name="radius" size="3" id="inlineFormInputGroup" placeholder="radius"> --}}
                  <select class="form-control" name="radius">
                    <option value="Any">Any</option>
                    <option value="1">1 mile</option>
                    <option value="3">3 miles</option>
                    <option value="5">5 miles</option>
                    <option value="7">7 miles</option>
                    <option value="9">9 mile</option>
                    <option value="11">11 miles</option>
                    <option value="13">13 miles</option>
                    <option value="15+">15+ miles</option>
                  </select>
                </div>
              </div>
            </div>

              <div class="form-row align-items-center">
              <div class="col-md-5 offset-md-0">
                <b><label for="min_price">Minimum Price</label></b>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class="fa fa-gbp"></i></div>
                  </div>
                  {{-- <input type="text" class="form-control" name="min_price" size="5" id="inlineFormInputGroup" placeholder="min price"> --}}
                  <select class="form-control" name="min_price">
                    <option value="">No min</option>
                    <option value="100"  data-condensed="100">&pound;100 pcm</option>
                    <option value="200"  data-condensed="200">&pound;200 pcm</option>
                    <option value="300"  data-condensed="300">&pound;300 pcm</option>               
                    <option value="400"  data-condensed="400">&pound;400 pcm</option>
                    <option value="500"  data-condensed="500">&pound;500 pcm</option>
                    <option value="600"  data-condensed="600">&pound;600 pcm</option>
                    <option value="700"  data-condensed="700">&pound;700 pcm</option>
                    <option value="800"  data-condensed="800">&pound;800 pcm</option>
                    <option value="900"  data-condensed="900">&pound;900 pcm</option>
                    <option value="1000"  data-condensed="1k">&pound;1,000 pcm</option>
                    <option value="1250"  data-condensed="1.25k">&pound;1,250 pcm</option>
                    <option value="1500"  data-condensed="1.5k">&pound;1,500 pcm</option>
                
                
                    <option value="1750"  data-condensed="1.75k">&pound;1,750 pcm</option>
                
                
                    <option value="2000"  data-condensed="2k">&pound;2,000 pcm</option>
                
                
                    <option value="2250"  data-condensed="2.25k">&pound;2,250 pcm</option>
                
                
                    <option value="2500"  data-condensed="2.5k">&pound;2,500 pcm</option>
                
                
                    <option value="2750"  data-condensed="2.75k">&pound;2,750 pcm</option>
                
                
                    <option value="3000"  data-condensed="3k">&pound;3,000 pcm</option>
                
                
                    <option value="3250"  data-condensed="3.25k">&pound;3,250 pcm</option>
                    <option value="3500"  data-condensed="3.5k">&pound;3,500 pcm</option>
                    <option value="3750"  data-condensed="3.75k">&pound;3,750 pcm</option>
                    <option value="4000"  data-condensed="4k">&pound;4,000 pcm</option>
                    <option value="4250"  data-condensed="4.25k">&pound;4,250 pcm</option>
                    <option value="4500"  data-condensed="4.5k">&pound;4,500 pcm</option>
                    <option value="4750"  data-condensed="4.75k">&pound;4,750 pcm</option>
                    <option value="5000"  data-condensed="5k">&pound;5,000 pcm</option>
                    <option value="5500"  data-condensed="5.5k">&pound;5,500 pcm</option>
                    <option value="6000"  data-condensed="6k">&pound;6,000 pcm</option>
                    <option value="6500"  data-condensed="6.5k">&pound;6,500 pcm</option>
                    <option value="7000"  data-condensed="7k">&pound;7,000 pcm</option>
                    <option value="7500"  data-condensed="7.5k">&pound;7,500 pcm</option>
                    <option value="8000"  data-condensed="8k">&pound;8,000 pcm</option>
                    <option value="8500"  data-condensed="8.5k">&pound;8,500 pcm</option>
                    <option value="9000"  data-condensed="9k">&pound;9,000 pcm</option>
                    <option value="9500"  data-condensed="9.5k">&pound;9,500 pcm</option>
                    <option value="10000"  data-condensed="10k">&pound;10,000 pcm</option>
                    <option value="12500"  data-condensed="12.5k">&pound;12,500 pcm</option>
                    <option value="15000"  data-condensed="15k">&pound;15,000 pcm</option>
                    <option value="17500"  data-condensed="17.5k">&pound;17,500 pcm</option>
                    <option value="20000"  data-condensed="20k">&pound;20,000 pcm</option>
                    <option value="25000"  data-condensed="25k">&pound;25,000 pcm</option>
                
                
                  </select>
                </div>
              </div>
              <div class="col-md-5 offset-md-0">
                <b><label for="max_price">Maximum Price</label></b>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class="fa fa-gbp"></i></div>
                </div>
                {{-- <input type="text" class="form-control" name="max_price" size="5" id="inlineFormInputGroup" placeholder="max price"> --}}
                <select class="form-control" name="max_price">
                    <option value="">No max</option>
                    <option value="100"  data-condensed="100">&pound;100 pcm</option>
                    <option value="200"  data-condensed="200">&pound;200 pcm</option>
                    <option value="300"  data-condensed="300">&pound;300 pcm</option>               
                    <option value="400"  data-condensed="400">&pound;400 pcm</option>
                    <option value="500"  data-condensed="500">&pound;500 pcm</option>
                    <option value="600"  data-condensed="600">&pound;600 pcm</option>
                    <option value="700"  data-condensed="700">&pound;700 pcm</option>
                    <option value="800"  data-condensed="800">&pound;800 pcm</option>
                    <option value="900"  data-condensed="900">&pound;900 pcm</option>
                    <option value="1000" data-condensed="1k">&pound;1,000 pcm</option>
                    <option value="1250" data-condensed="1.25k">&pound;1,250 pcm</option>
                    <option value="1500"  data-condensed="1.5k">&pound;1,500 pcm</option>
                    <option value="1750"  data-condensed="1.75k">&pound;1,750 pcm</option>
                    <option value="2000"  data-condensed="2k">&pound;2,000 pcm</option>
                    <option value="2250"  data-condensed="2.25k">&pound;2,250 pcm</option>
                    <option value="2500"  data-condensed="2.5k">&pound;2,500 pcm</option>
                    <option value="2750"  data-condensed="2.75k">&pound;2,750 pcm</option>
                    <option value="3000"  data-condensed="3k">&pound;3,000 pcm</option>
                    <option value="3250"  data-condensed="3.25k">&pound;3,250 pcm</option>
                    <option value="3500"  data-condensed="3.5k">&pound;3,500 pcm</option>
                    <option value="3750"  data-condensed="3.75k">&pound;3,750 pcm</option>
                    <option value="4000"  data-condensed="4k">&pound;4,000 pcm</option>
                    <option value="4250"  data-condensed="4.25k">&pound;4,250 pcm</option>
                    <option value="4500"  data-condensed="4.5k">&pound;4,500 pcm</option>
                    <option value="4750"  data-condensed="4.75k">&pound;4,750 pcm</option>
                    <option value="5000"  data-condensed="5k">&pound;5,000 pcm</option>
                    <option value="5500"  data-condensed="5.5k">&pound;5,500 pcm</option>
                    <option value="6000"  data-condensed="6k">&pound;6,000 pcm</option>
                    <option value="6500"  data-condensed="6.5k">&pound;6,500 pcm</option>
                    <option value="7000"  data-condensed="7k">&pound;7,000 pcm</option>
                    <option value="7500"  data-condensed="7.5k">&pound;7,500 pcm</option>
                    <option value="8000"  data-condensed="8k">&pound;8,000 pcm</option>
                    <option value="8500"  data-condensed="8.5k">&pound;8,500 pcm</option>
                    <option value="9000"  data-condensed="9k">&pound;9,000 pcm</option>
                    <option value="9500"  data-condensed="9.5k">&pound;9,500 pcm</option>
                    <option value="10000"  data-condensed="10k">&pound;10,000 pcm</option>
                    <option value="12500"  data-condensed="12.5k">&pound;12,500 pcm</option>
                    <option value="15000"  data-condensed="15k">&pound;15,000 pcm</option>
                    <option value="17500"  data-condensed="17.5k">&pound;17,500 pcm</option>
                    <option value="20000"  data-condensed="20k">&pound;20,000 pcm</option>
                    <option value="25000"  data-condensed="25k">&pound;25,000 pcm</option>
                  </select>
              </div>
            </div>
              </div>
              <div class="form-row align-items-center">

                <div class="col-md-5 offset-md-0">
                  <b><label for="num_beds">Bedrooms</label></b>
                  {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i style="font-size:20px" class="material-icons">&#xe549;</i></div>
                    </div>
                    {{-- <input type="text" class="form-control" name="beds" id="inlineFormInputGroup" size="3" placeholder="Beds"> --}}
                    <select class="form-control" name="bedrooms" >
                      <option value="Any" selected="selected">Any</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5+</option>
                    </select>
                  </div>
                </div>

              <div class="col-md-5 offset-md-0">
                <b><label for="property_type">Property Type</label></b>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class="fa fa-home"></i></div>
                </div>
                {{-- <input type="text" class="form-control" name="property_type" size="5" id="inlineFormInputGroup" placeholder="property type"> --}}
                <select class="form-control" name="property_type">
                    <option value="show all" selected="selected">show all</option>
                    <option value="flat/apartment" >Flat/Apartment</option>
                    <option value="student lets" >Student lets</option>
                    <option value="studio" >Studio</option>
                    <option value="house" >House</option>
                  </select>
                </div>
            </div>
            <div class="col-md-3 offset-md-5"  >
              <button  type="submit" class="btn btn-info btn-lg" >Search</button>
            </div>
              
            </div>
          </form>    
    </div>

    <form name="locationform" method="get" action="{{url('/')}}">
      @csrf
      <input type="hidden" id="user_lat" name="user_lat" value="">
      <input type="hidden" id="user_lng" name="user_lng" value="">
    </form>
    {{-- <p id="lat"></p>
    <p id="long"></p> --}}
@section('content')
@if(count($properties)> 0)
<h1>Properties around you</h1>
@endif
<div class="owl-carousel owl-theme mt-5">
    @if(count($properties)> 0)
        @foreach ($properties as $p)
          @php
                $heading = $p->header;
                $head = substr($heading,0,15)
            @endphp
            @if(count($photos)> 0)
              @foreach ( $photos as $file )
                  @if($file->properties_id== $p->id)
                  <div class="item"><a href = "/properties/{{$p->id}}">
                    <div class="card">
                      <div class="ribbon ribbon-top-left">
                        <span>£{{$p->price}} pcm</span>
                        <img src="storage/cover_images/{{$file->filename}}" alt={{$p->header}}>
                      
                        <div style="text-align: left" class="card-footer">
                          <P > {{$p->City}}</P>
                          {{-- <p>{{$distance}}</p> --}}
                        {{-- <p class="card-text">{{ ucfirst($head)}}...</p> --}}
                        {{-- <br>
                        <small class="text-muted">{{$sql_distance}}</small></p> --}}
                      </div>
                    </div>
                    </div>
                  </a>
                </div>
                  {{-- <a href = "/properties/{{$p->id}}"><img style="width:100%"src="/storage/cover_images/{{$file->filename}}"></a> --}}
                      @break
                  @endif
              @endforeach
          @endif 
        @endforeach
    @endif
</div>
@endsection

<script>
  function validateForm() {
    function isEmptyOrSpaces(str){
    return str === null || str.match(/^ *$/) !== null;
}
  var x = document.forms["myForm"]["searchTextField"].value;

  if (isEmptyOrSpaces(x)) {
    alert("Please Enter a Location");
    return false;
  }
}
  </script>
  
{{-- <script>
  var autosubmit = false;
  if(autosubmit == true)
        window.onload = function(){
      document.forms['locationform'].submit();
      var autosubmit = false;
    }
</script> --}}