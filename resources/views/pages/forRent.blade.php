@extends('layouts.app')

@section('content')
<br>
<div class="col-sm-14">
    <div class="card bg-secondary text-white">
        <form method="get" action="{{url('/properties/radius/cityLng/cityLat')}}">
            @csrf
            <div class="form-row align-items-center">
              <div class="col-auto">
                {{-- <label class="sr-only" for="inlineFormInput">place</label> --}}
                <label for="location">Location</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf124;</i></div>
                    </div>
                {{-- <input type="text" class="form-control" id="inlineFormInput" placeholder="Jane Doe"> --}}
                {{-- <input class="form-control" id="searchTextField" name="address" value="{{$addr}}"type="text" size="25" placeholder="eg. luton, peckham or se25" autocomplete="off" runat="server" />   --}}
                <input class="form-control @error('searchTextField') is-invalid @enderror" id="searchTextField" name="searchTextField" type="text" size="25" placeholder="eg. luton, peckham or se25" autocomplete="off" runat="server" value = "{{$addr}}" required autocomplete="searchTextField"/>  
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
              <div class="col-auto">
                <label for="Radius">Search radius</label>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf4d7;</i></div>
                  </div>
                  {{-- <input type="text" class="form-control" name="radius" size="3" id="inlineFormInputGroup" placeholder="radius"> --}}
                  <select class="form-control" name="radius">
                    <option value="{{$radius}}">{{$radius}} miles</option>
                    <option value="1">1 mile</option>
                    <option value="3">3 miles</option>
                    <option value="5">5 miles</option>
                    <option value="7">7 miles</option>
                    <option value="9">9 mile</option>
                    <option value="11">11 miles</option>
                    <option value="13">13 miles</option>
                    <option value="15">15+ miles</option>
                  </select>
                </div>
              </div>
              <div class="col-auto">
                <label for="min_price">Minimum Price</label>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf154;</i></div>
                  </div>
                  {{-- <input type="text" class="form-control" name="min_price" size="5" id="inlineFormInputGroup" placeholder="min price"> --}}
                  <select class="form-control" name="min_price">
                    <option value="{{$min_price}}"  selected="selected">{{$min_price}} pcm</option>
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
              <div class="col-auto">
                <label for="max_price">Maximum Price</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf154;</i></div>
                </div>
                {{-- <input type="text" class="form-control" name="max_price" size="5" id="inlineFormInputGroup" placeholder="max price"> --}}
                <select class="form-control" name="max_price">
                  <option value="{{$max_price}}"  selected="selected">{{$max_price}} pcm</option>
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
              <div class="col-auto">
                <label for="num_beds">rooms</label>
                {{-- <label class="sr-only" for="inlineFormInputGroup">Username</label> --}}
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i style="font-size:20px" class="fas">&#xf236;</i></div>
                  </div>
                  {{-- <input type="text" class="form-control" name="beds" id="inlineFormInputGroup" size="3" placeholder="Beds"> --}}
                  <select class="form-control" name="bedrooms">
                    <option value="{{$rooms}}"  selected="selected">{{$rooms}}</option>
                    <option value="Any">Any</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                  </select>
                </div>
              </div>
              <div class="col-auto">
                <label for="property_type">Property Type</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i style='font-size:20px' class='fas'>&#xf015;</i></div>
                </div>
                {{-- <input type="text" class="form-control" name="property_type" size="5" id="inlineFormInputGroup" placeholder="property type"> --}}
                <select class="form-control" name="property_type">
                  <option value="{{$prop_type}}"  selected="selected">{{$prop_type}}</option>
                  <option value="flat/apartment" >Flat/Apartment</option>
                  <option value="student lets" >Student lets</option>
                  <option value="studio" >Studio</option>
                  <option value="house" >House</option>
                  <option value="show all">show all</option>
                  </select>
              </div>
            </div>
              <div class="col-auto" style='left: 50%;' >
                <button type="submit" class="btn btn-info btn-lg" >Search</button>
              </div>
            </div>
          </form>       
        </form>        
    </div>
</div>
    <br>

    @if(count($properties)> 0)
        @foreach ( $properties as $p )
        @php
            $descrip = $p->Description;
            $description = substr($descrip,0,250)
        @endphp
        <div class="card " >
            <div class="card-body">          
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                            @if(count($photos)> 0)
                                @foreach ( $photos as $file )
                                    @if($file->properties_id== $p->id)
                                        <img style="width:100%"src="/storage/cover_images/{{$file->filename}}">
                                        @break
                                    @endif
                                @endforeach
                            @endif 
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class ="row justify-content-between">
                            <div class = "column ">
                                <h2>£{{$p->price}} pcm</h2>
                            </div>
                            <div class = "column ">
                                <a href="#" class="btn btn-secondary">
                                    <i style='font-size:24px' class='fas'>&#xf3c5;</i> {{$p->region}}
                                  </a>                                   
                            </div>
                        </div>
                        <h3><a href = "/properties/{{$p->id}}">{{$p->header}}</a></h3>
                        <p>{!! $description!!}...</p>
                        <div class ="row justify-content-around">
                            <h5><i style='font-size:24px' class='fas'>&#xf015;</i> {{$p->property_type}}</h5>
                            <h5><i style='font-size:24px' class='fas'>&#xf236;</i> {{$p->number_of_rooms}}</h5>
                            <h5><i style='font-size:24px' class='fas'>&#xf2cd;</i> {{$p->number_of_baths}}</h5>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="card-footer">
                @foreach ( $user as $u )
                    @if($u->id== $p->user_id)
                        <small>Listed on {{$p->created_at }} by <a href = "/chat/{{$u->id}}">{{$u->name}}</a></small>
                    @endif
                @endforeach
            </div>            
        </div> 
        <br> 
        @endforeach
    @else 
        <h3>No listings found.Please refine your search and try again.<h3>
    @endif  
    <div class="d-flex justify-content-center">
      {{-- {!! $properties->render() !!} --}}
  </div>        
@endsection