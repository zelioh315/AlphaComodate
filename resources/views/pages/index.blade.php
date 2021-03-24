@extends('layouts.app')
   
</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <div class="searchbar">
    <form method="post" action="">
        <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
        <input type="hidden" id="city2" name="city2" />
        <input type="hidden" id="cityLat" name="cityLat" />
        <input type="hidden" id="cityLng" name="cityLng" />
        <input type="submit" name="searchSubmit" value="Search" />
    </form>
</div> --}}
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
      background-image: url("/storage/cover_images/alpha.jpg" );
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
      left: 25%;
      margin: 20px;
      max-width: 650px;
      max-height: 1000px;
      padding: 16px;
      /* background-color: #f7f7ab; */
      background: rgba(230, 225, 241, 0.35);
     
      
    }
    
    /* Full-width input fields */
    input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
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
 
 
    
    {{-- <h2>Form on Hero Image</h2> --}}
    <div class="bg-img">
        <br><br><br>
        
        <form method="get"  novalidate="novalidate" class="homepage" action="{{url('/properties/radius/cityLng/cityLat')}}">
            <h1> Search Properties for Rent around you</h1>
            @csrf
            <div class="form-row align-items-center">
              <div class="col-md-8 offset-md-0">
                {{-- <label class="sr-only" for="inlineFormInput">place</label> --}}
                <b><label for="location">Location</label></b>
                 <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf124;</i></div>
                    </div>
                {{-- <input type="text" class="form-control" id="inlineFormInput" placeholder="Jane Doe"> --}}
                <input class="form-control @error('searchTextField') is-invalid @enderror" id="searchTextField" name="searchTextField" type="text"  placeholder="eg. luton, peckham or se25" autocomplete="on" runat="server" required autocomplete="searchTextField"/>  
                                 @error('searchTextField')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                <input type="hidden" id="city2" name="city2" />
                <input type="hidden" id="cityLat" name="cityLat" />
                <input type="hidden" id="cityLng" name="cityLng" />
              </div>
              </div>
              <div class="col-md-3 offset-md-0">
                <b><label for="Radius">Search radius</label></b>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf4d7;</i></div>
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
              <div class="col-md-3 offset-md-0">
                <b><label for="min_price">Minimum Price</label></b>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf154;</i></div>
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
              <div class="col-md-3 offset-md-0">
                <b><label for="max_price">Maximum Price</label></b>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf154;</i></div>
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
              </div>
              <div class="form-row align-items-center">

                <div class="col-md-3 offset-md-0">
                  <b><label for="num_beds">Bedrooms</label></b>
                  {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i style="font-size:20px" class="fas">&#xf236;</i></div>
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
                
              
              
              <div class="col-md-3 offset-md-0">
                <b><label for="property_type">Property Type</label></b>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf015;</i></div>
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
              <button type="submit" class="btn btn-info btn-lg" >Search</button>
            </div>
              
            </div>
          </form>    
    </div>
    
@section('content')


@endsection
        
