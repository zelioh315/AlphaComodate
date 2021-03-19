@extends('layouts.app')

@section('content')
<br>
<div class="container">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="col-sm-2">
                            <div class="card mb-3" >
                                    <img class="rounded" src="/storage/cover_images/{{$user['profile_picture']}}" alt="profile image ">
                            </div>    
                       </div> 
                       <div class="col-sm-6">
                        {{-- <div class="card mb-3" > --}}
                            <h3>{{$user['name']}}</h3>
                            @if($user['mobile'] !=null)
                                <h4>Mobile: {{$user['mobile']}} </h4>
                            @endif
                            <p>Total Listings: {{count($properties)}} </p>
                        {{-- </div>     --}}
                         </div> 
                         <div class="col-sm-4">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!Auth::guest())
                        @if(Auth::user()->id == $user["id"])
                            {{-- <a class="btn btn-dark" href="/propertiesForRent/create">New Listing for renting</a> --}}
                            <a class="btn btn-dark" href="/properties/create">Add a listing </a>
                        @endif
                        @endif   
                         </div> 
                    </div>
                
                    
                </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="listing-tab" data-toggle="tab" href="#listing" role="tab" aria-controls="listing" aria-selected="true">All Listings</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                </li>
                @if(!Auth::guest())
                @if(Auth::user()->id == $user["id"])
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit my details</a>
                    </li>
                @endif
                @endif
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="listing" role="tabpanel" aria-labelledby="listing-tab">
                    <div class = "row">
                        @if(count($properties) > 0)
                            @foreach ($properties as $post)
                            <div class="col-sm-4">
                            <div class="card mb-3" >
                                @foreach($post->photos as $file )
                                    @if($file->properties_id== $post->id)
                                    <img class="card-img-top" src="/storage/cover_images/{{$file->filename}}" alt="Property image ">
                                        @break
                                    @endif
                                @endforeach
                            <div class="card-body">
                                <h5><b>{{$post->header}}</b></h5>
                                <p class="card-text">
                                    <b>Property Id: {{$post->id}}</b>
                                    <li>{{$post->address}}</li>
                                    <li >{{$post->post_code}}</li>
                                    <li >£{{$post->price}}</li>
                                </p>
                                <h6>listed on {{$post->created_at}}</h6>
                                @if(!Auth::guest())
                                @if(Auth::user()->id == $post->user_id)
                                      <a href = "/properties/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                    
                                      {!! Form::open(['action' => ['PropertyController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
                                      {!! Form::close() !!}
                                  @endif    
                              @endif
                              
                            </div>
                        </div>
                            </div>
                    
                            @endforeach 
                        @else
                                <small>you have no post</small>
                        @endif
                           
                    </div>      
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col-md-16">
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
            
                           <input type="hidden" id="my-field" name="property_id" value={{ $user["id"]}} />
                        
                                <div class="form-group">
                                    {{ Form::label('Title', 'Enter your message') }}
                                    {{ Form::textarea('message','',['class' => 'form-control',  'placeholder' => 'e.g Is the property still available?.'] )}}
                                </div>
                        
                                {{Form::submit('Send ', ['class'=>'btn btn-secondary'])}}           
                            
                            {!! Form::close() !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-16">
                        <div class="card">
                            <div class="card-header">{{ __('Send an Email') }}</div>
                            <div class="card-body">
                                @if(!Auth::guest())
                                @if(Auth::user()->id == $user["id"])
                                {!! Form::open(['action' => ['profileController@update', $user["id"]],'method'=> 'PUT', 'enctype' => 'multipart/form-data']) !!}                                 
                                     <div class="form-group">
                                        {{ Form::label('title', 'Name') }}
                                        {{ Form::text('name',Auth::user()->name,['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                                     </div>
                                  
                                <div class="form-group">
                                    {{ Form::label('title', 'Mobile Number') }}
                                    {{ Form::text('number',Auth::user()->mobile,['class' => 'form-control', 'placeholder' => 'e.g 0123456789'] )}}
                               </div>
                               <h4>Upload a profile image</h4>
                               <div class ="form-group">
                                {{{Form::file('cover_image')}}}
                            </div>   
        
            
                           <input type="hidden" id="my-field" name="property_id" value={{ $user["id"]}} />

                                {{Form::hidden('_method', 'PUT')}}
                                {{Form::submit('submit ', ['class'=>'btn btn-secondary'])}}           
                            
                            {!! Form::close() !!}
                            @endif
                            @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            <br>
   
        {{-- </div> --}}


    </div>

      
  
    
@endsection
