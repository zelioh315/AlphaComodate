@extends('layouts.app')

@section('content')

    <h1>{{$propertiesForRent->header}}</h1>
        <div class="card mb-3">

            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <h3> {!!$propertiesForRent->Description!!}</h3>
               
              </blockquote>
            </div>
            <div class="card-footer text-muted">
                <small>posted on {{$propertiesForRent->created_at}}</small>

                <hr>
            @if(!Auth::guest())
              @if(Auth::user()->id == $post->user_id)
              <a href = "/propertiesForRent/{{$propertiesForRent->id}}/edit" class="btn btn-default">Edit</a>
                {!! Form::open(['action' => ['PropertyForRentController@destroy', $propertiesForRent->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                  {{Form::hidden('_method','DELETE')}}
                  {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
                {!! Form::close() !!}
              @endif    
            @endif       

                {{-- <a href = "/properties/{{$properties->id}}/delete" class="btn btn-default">Delete</a> --}}
            </div>
        </div>


        
                    
@endsection