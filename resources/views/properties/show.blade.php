@extends('layouts.app')

@section('content')
 <br>
 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @php
    $i = 0
    @endphp
    @foreach ( $properties->photos as $file )
      @if($file->properties_id== $properties->id)
          <li data-target="#carouselExampleIndicators" data-slide-to= "{{$i}}"></li>
          @php
          $i+=1
          @endphp
      @endif
    @endforeach
    <li data-target="#carouselExampleIndicators" data-slide-to= "{{$i}}"></li>
  </ol>
  <div class="carousel-inner">
    @if(count($properties->photos)> 0)
      @foreach ( $properties->photos as $file )
          @if($file->properties_id== $properties->id)
            <div class="carousel-item active">
              <img class="d-block w-100" src="/storage/cover_images/{{$file->filename}}" alt="Image">
            </div>
            @break
          @endif
      @endforeach
      @php
          $sum = 0
      @endphp
      @foreach ( $properties->photos as $file )
          @if($file->properties_id== $properties->id)
              @php
                  $sum+=1
              @endphp
              @if($sum > 1)
                <div class="carousel-item ">
                  <img class="d-block w-100" src="/storage/cover_images/{{$file->filename}}" alt="Image">
                </div>
              @endif  
          @endif
      @endforeach
    @endif 
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
 </div>
 <br>
 <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About Property</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="view-tab" data-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="false">View Property on Map</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact LandLord</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
    
    <div class="card mb-3">
      <div id="Details" class="tabcontent">
          <div class="card-header">
            <div class ="row justify-content-between">
              <div class = "column ">
                <a href = "/properties/{{$properties->id}}/Sendemail" class="btn btn-dark">Email Landlord</a>
              </div>
              <div class = "column ">
                {{-- <a href="/properties/propertyonmap/{{$p->id}}" >
                  <i style='font-size:24px' class='fas'>&#xf3c5;</i> {{$p->region}}
                </a>  --}}
                  <a href="/properties/propertyonmap/{{$properties->id}}"  class="btn btn-secondary">
                      <i style='font-size:24px' class='fas'>&#xf3c5;</i> {{$properties->region}}
                    </a>                                   
              </div>
          </div>
          </div>
          <div class="card-body">
            <h3>{{ucwords($properties->header)  }} (£{{$properties->price}} pcm)</h3>
          
            {{-- <blockquote class="blockquote mb-0"> --}}
              <p> {{ucfirst($properties->Description)}}</p>
              @php
                  $feat = $properties->features;
                  $pieces = explode("  ", $feat);
              @endphp
              <h2>Features</h2>
              <ul class="list-unstyled">
                @foreach ($pieces as $features)
                    @if ($features != null)
                    <li class="list-group-item">{{$features}}</li>
                    @endif
                   
                @endforeach
              </ul>  
              {{-- <p>{{$pieces[2]}}</p> --}}
             <br>
              <p id="facilities"></p>
                          <div class ="row justify-content-around">
                              <h5>Property Type <i style='font-size:24px' class='fas'>&#xf015;</i> : {{$properties->property_type}}</h5>
                              <h5>Bedrooms <i style='font-size:24px' class='fas'>&#xf236;</i> : {{$properties->number_of_rooms}}</h5>
                              <h5>Bathrooms <i style='font-size:24px' class='fas'>&#xf2cd;</i> : {{$properties->number_of_baths}}</h5>
                          </div>
            {{-- </blockquote> --}}
          </div>
          <div class="card-footer text-muted">
              @php
                  $now = time();
                  $created = strtotime($properties->created_at);
                  $diff = $now - $created;
                  $days = round($diff/(60*60*24));
              @endphp
              <small>Listed {{$days}} days ago</small>

           
          @if(!Auth::guest())
            @if(Auth::user()->id == $properties->user_id)
                  <a href = "/properties/{{$properties->id}}/edit" class="btn btn-default">Edit</a>

                  {!! Form::open(['action' => ['PropertyController@destroy', $properties->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
                  {!! Form::close() !!}
              @endif    
          @endif         
          </div>
        </div>
      </div>
  </div>
  <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">
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
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="card mb-3">
        <div id="contact" class="tabcontent">
          <div class="row ">
            <div class="col-md-6">
              <div class="card">
                  <div class="card-header">{{ __('Send an Email') }}</div>
                  <div class="card-body">
                      {!! Form::open(['action' => 'emailController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
                      @if(!Auth::guest())
                            
                           <div class="form-group">
                              {{ Form::label('title', 'Name') }}
                              {{ Form::text('name',Auth::user()->name,['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                           </div>
                        
                            <div class="form-group">
                              {{ Form::label('title', 'Email Address') }}
                              {{ Form::text('email',Auth::user()->email,['class' => 'form-control', 'placeholder' => 'e.g name@yahoo.com'] )}}
                            </div>
                      @else 
                             
                            <div class="form-group">
                              {{ Form::label('title', 'Name') }}
                              {{ Form::text('name','',['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                           </div>
  
                            <div class="form-group">
                              {{ Form::label('title', 'Email Address') }}
                              {{ Form::text('email','',['class' => 'form-control', 'placeholder' => 'e.g name@yahoo.com'] )}}
                            </div>
  
                      @endif
                      
                      <div class="form-group">
                          {{ Form::label('title', 'Mobile Number') }}
                          {{ Form::text('number','',['class' => 'form-control', 'placeholder' => 'e.g 0123456789'] )}}
                     </div>
  
                 <input type="hidden" id="my-field" name="property_id" value={{ $properties->user_id}} />
              
                      <div class="form-group">
                          {{ Form::label('Title', 'Enter your message') }}
                          {{ Form::textarea('message','',['class' => 'form-control',  'placeholder' => 'e.g Is the property still available?.'] )}}
                      </div>
              
                      {{Form::submit('Send ', ['class'=>'btn btn-secondary'])}}           
                  
                  {!! Form::close() !!}
                      
                  </div>
              </div>
          </div>
          <div class="col-md-4">
            <br>
              
                          <div class="col-sm-6">
                              <div class="card mb-3" >
                                <a href = "/profile/{{$properties->user['id']}}"><img class="rounded" style="width:100% " src="/storage/cover_images/{{$properties->user['profile_picture']}}" alt="profile image "></a>
                              </div> 
                              <b><a href = "/profile/{{$properties->user['id']}}">{{ucwords($properties->user['name'])}}</a>   </b>
               
          </div>
  
         </div>
        </div>
        </div>   
    </div>
</div>
</div>
@endsection