@extends('layouts.app')

@section('content')
<br>

<div class="container">
    <div class="row ">
        {{-- <div class="row justify-content-right">    --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send an Email') }}</div>
                <div class="card-body">
                    {!! Form::open(['action' => 'emailController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                         {{ Form::label('title', 'Name') }}
                         {{ Form::text('name','',['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                    </div>
            
                    <div class="form-group">
                        {{ Form::label('title', 'Mobile Number') }}
                        {{ Form::text('number','',['class' => 'form-control', 'placeholder' => 'e.g 0123456789'] )}}
                   </div>

                   <div class="form-group">
                    {{ Form::label('title', 'Email Address') }}
                    {{ Form::text('email','',['class' => 'form-control', 'placeholder' => 'e.g name@yahoo.com'] )}}
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
            <div class="card">
                <div class="card-header">{{ $properties->header}}</div>
                <div class="card-body">
                    @foreach ( $properties->photos as $file )
                                    @if($file->properties_id== $properties->id)
                                        <img class="card-img-top" src="/storage/cover_images/{{$file->filename}}" alt="Property image ">
                                        {{-- <img style="width:100%"src="/storage/cover_images/"> --}}
                                        @break
                                    @endif
                                @endforeach
                </div>
                <div class="card-footer">Listed on {{ $properties->created_at}}</div>
            </div>

            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">my map will go here</div>
                    <div class="card-body">
                        <div id="map" style="width:100%;height:400px;"></div> 
                        <script>
                            let marker;    
                            function initMap() {
                              const map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 16,
                                center: { lat: 51.4781982, lng: 0.0762053 },
                              });
                              marker = new google.maps.Marker({
                                map,
                                draggable: true,
                                animation: google.maps.Animation.DROP,
                                position: { lat: 51.4781982, lng: 0.0762053 },
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
            </div>
        </div>
    </div>
</div>

 

        
@endsection
