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
 <div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Details')" id="defaultOpen"><b>Property Details</b></button>
  <button class="tablinks" onclick="openTab(event, 'Map')"><b>Property on the map</b></button>
  <button class="tablinks" onclick="openTab(event, 'contact')"><b>Contact LandLord</b></button>
</div>
   <div class="card mb-3">
      <div id="Details" class="tabcontent">
          <div class="card-header">
            <div class ="row justify-content-between">
              <div class = "column ">
                <a href = "/properties/{{$properties->id}}/Sendemail" class="btn btn-dark">Email Landlord</a>
              </div>
              <div class = "column ">
                  <a href="#" class="btn btn-secondary">
                      <i style='font-size:24px' class='fas'>&#xf3c5;</i> {{$properties->region}}
                    </a>                                   
              </div>
          </div>
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
                   <li class="list-group-item">{{$features}}</li>
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

              <hr>
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
      <div class="card mb-3">
      <div id="contact" class="tabcontent">
        <div class="row ">
          <div class="col-md-8">
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
        <br>
        <div class="col-md-4">
     
            <div class="row">
                        <div class="col-sm-6">
                            <div class="card mb-3" >
                              <a href = "/profile/{{$properties->user['id']}}"><img class="rounded" style="width:100% " src="/storage/cover_images/{{$properties->user['profile_picture']}}" alt="profile image "></a>
                            </div> 
                            <b><a href = "/profile/{{$properties->user['id']}}">{{ucwords($properties->user['name'])}}</a>   </b>
                       </div> 
            </div>
            {{-- <div class="card">
                <div class="card-header">Send an sms to landlord</div>
                <div class="card-body">
                  {!! Form::open(['action' => 'smsController@store', 'method'=> 'POST']) !!}
                          <div class="form-group">
                            {{ Form::label('title', 'Name') }}
                            {{ Form::text('name','',['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                         </div>                   
                          <div class="form-group">
                              {{ Form::label('title', 'Mobile Number') }}
                              {{ Form::text('number','',['class' => 'form-control', 'placeholder' => 'e.g 0123456789'] )}}
                        </div>
                        <input type="hidden" id="my-field" name="landlord" value={{ $properties->user->name}} />

                        <div class="form-group">
                            {{ Form::label('Title', 'Enter your message') }}
                            {{ Form::textarea('message','',['class' => 'form-control',  'placeholder' => 'e.g Is the property still available?.'] )}}
                        </div>
            
                    {{Form::submit('Send ', ['class'=>'btn btn-secondary'])}}           
                
                {!! Form::close() !!}
                    
                </div>
            </div> --}}
        </div>

       </div>
      </div>
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