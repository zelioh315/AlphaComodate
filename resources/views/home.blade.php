@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!Auth::guest())
                        {{-- <a class="btn btn-dark" href="/propertiesForRent/create">New Listing for renting</a> --}}
                        <a class="btn btn-dark" href="/properties/create">Add a new listing </a>
                    @endif   
                    
                </div>
            </div>
        </div>
    </div>
    <br>
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

        {!! Form::open(['action' => ['PropertyController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
        {!! Form::close() !!}</th>
        <a href = "/properties/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
        {{-- <a href="#" class="btn btn-primary">Edit</a> --}}
        </div>
    </div>
        </div>

        @endforeach 
    @else
            <small>you have no post</small>
    @endif
       
</div>      

@endsection
