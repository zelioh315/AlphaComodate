@extends('layouts.app')

@section('content')

    <h1>Properties For Rent</h1>
    @if(count($propertiesForRent)> 0)
        @foreach ( $propertiesForRent as $p )
        <div class="card  mb-3" >
            <div class="card-body">          
                <div class="row">
                    <div class="col-sm-3">
                        <div class="well">
                         <img style="width:100%"src="/storage/cover_images/{{$p->cover_image}}">
                        </div>
                      </div>
                      <div class="col-sm-9">
                        <div class="well">
                            <h3><a href = "/properties/{{$p->id}}"> {{$p->header}}</a></h3>
                            <small> Written on {{$p->created_at}} by {{$p->user['name']}}</small>
                            <p>{!!$p->body !!}</p>
                        </div>
                      </div>
                    </div>
                </div>       
            </div>    
        </div>   
    
        @endforeach
    @else 
        <p>No Properties to display</p>
    @endif         
@endsection