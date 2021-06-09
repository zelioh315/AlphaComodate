@extends('layouts.app')
@section('content')
<br>
<div class="row ">
    <div class="col-md-6">
      <div class="card">
          <div class="card-header">{{ __('Send an Email') }}</div>
          <div class="card-body">
              {!! Form::open(['action' => 'emailController@contact_us', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
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

         {{-- <input type="hidden" id="my-field" name="property_id" value={{ $properties->user_id}} /> --}}
      
              <div class="form-group">
                  {{ Form::label('Title', 'Enter your message') }}
                  {{ Form::textarea('message','',['class' => 'form-control',  'placeholder' => 'your message here'] )}}
              </div>
      
              {{Form::submit('Send ', ['class'=>'btn btn-secondary'])}}           
          
          {!! Form::close() !!}
              
          </div>
      </div>
  </div>
  <br>
  <div class="col-md-4">
    <div class="card">
        <div class="card-header">Address</div>
        <div class="card-body">
        <p> Flat A7.2 </br> Culwell Street </br>Wolverhampton </br> WV10 0JT</p>
        </div>
        {{-- <div class="card-footer">Listed on </div> --}}
    </div>
  </div>
  {{-- <div class="col-md-4">
    <br>
      
                  <div class="col-sm-6">
                      <div class="card mb-3" >
                        <a href = "/profile/{{$properties->user['id']}}"><img class="rounded" style="width:100% " src="/storage/cover_images/{{$properties->user['profile_picture']}}" alt="profile image "></a>
                      </div> 
                      <b><a href = "/profile/{{$properties->user['id']}}">{{ucwords($properties->user['name'])}}</a>   </b>
       
  </div>

 </div> --}}
</div>
@endsection