@extends('layouts.app')

@section('content')
    <div class = "container-fluid">
        <div class="row">
            <div class="col-md-4">
                <br>
                <div class="card">  
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach ($users as $user)
                        <li class="user" id="{{ $user->id }}">
                                <span class="pending"></span>
                                    <div class="media">
                                            <div class="media-left">
                                                <img style="width:30%"src="/storage/cover_images/avatar.jpg">
                                            </div>
                                            <div class="media-body"> 
                                                <p class="name">{{$user->name}}</p>
                                                <p class="email">{{$user->email}}</p>
                                            </div>
                                    </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
             </div>
            </div>
            <div class="col-md-8" id="message">
            </div>
        </div>
    </div>
@endsection