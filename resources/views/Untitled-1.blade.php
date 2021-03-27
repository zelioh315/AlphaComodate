<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>alphacomodate</title>

    </head>
    @include('inc.navbar')
    <body>
    <div class="container">
        @include('inc.messages')
        @yield('content')

    </div>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script >
            CKEDITOR.replace('summary-ckeditor');
    </script>
    </body>
</html>


@if(count($properties) > 0)
@foreach ($properties as $post)
<div class="card" style="width: 18rem;">
<img class="card-img-top" src="..." alt="Card image cap">
<div class="card-body">
    <h5 class="card-title">{{$post->header}}</h5>
<p class="card-text">{!! $post->Description !!}</p>

{!! Form::open(['action' => ['PropertyController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
{!! Form::close() !!}</th>
<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>

@endforeach 
@else
    <small>you have no post</small>
@endif 


@if(count($propertiesForRent) > 0)
<table class ="table table-striped">
<tr>
    <th>Title</th>
    <th>Date Created</th>
    <th></th> 
</tr>
    @foreach ($propertiesForRent as $post)
        <tr>
            <th>{{$post->title}}</th>
            <th>{{$post->created_at}}</th>
            <th><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</th>
            <th> {!! Form::open(['action' => ['PropertyForRentController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete', ['class' => "btn btn-danger"])}}
            {!! Form::close() !!}</th>
        </tr>     
    @endforeach 
@else
        <small>you have no post</small>
@endif      

<div class="thumbnails-mini owl-carousel thumbnails clearfix">

    <div class="property-thumb">
        <div class="thumbnail" style="background-image: url(//d36pgh4m67wnlt.cloudfront.net/listings/272882/o_1bnq0catu1p15udh1siat94fdaa.JPG_t.JPG);" alt="" width="133" height="100"></div>
    </div>
    <div class="property-thumb">
        <div class="thumbnail" style="background-image: url(//d36pgh4m67wnlt.cloudfront.net/listings/913296/o_1ertmukbl1127i2r1bnp6sb1h2l10270.JPG_t.JPG);" alt="" width="133" height="100"></div>
    </div>
    <div class="property-thumb">
        <div class="thumbnail" style="background-image: url(//d36pgh4m67wnlt.cloudfront.net/listings/913296/o_1ertmukblji914tps40166bfrc11.JPG_t.JPG);" alt="" width="133" height="100"></div>
    </div>
    <div class="property-thumb">
        <div class="thumbnail" style="background-image: url(//d36pgh4m67wnlt.cloudfront.net/listings/913296/o_1ertmukbl15777a012apmva1jj412270.JPG_t.JPG);" alt="" width="133" height="100"></div>
    </div>

</div>


</div>



<div class="container">

    <ul class="nav nav-pills nav-stacked">
      <li><a href="#lightbox" data-toggle="modal">Open Lightbox</a></li>
      <li><a href="#lightbox" data-toggle="modal" data-slide-to="1">2nd Image</a></li>
      <li><a href="#lightbox" data-toggle="modal" data-slide-to="2">3rd Image</a></li>
      <li><a href="#lightbox" data-toggle="modal" data-slide-to="15">Open non existing Image</a></li>
    </ul>
    
    <div class="modal fade and carousel slide" id="lightbox">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <ol class="carousel-indicators">
              <li data-target="#lightbox" data-slide-to="0" class="active"></li>
              <li data-target="#lightbox" data-slide-to="1"></li>
              <li data-target="#lightbox" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="/storage/cover_images/{{$properties->cover_image}}" alt="First slide">
              </div>
              <div class="item">
                <img src="/storage/cover_images/{{$properties->cover_image1}}" alt="Second slide">
              </div>
              <div class="item">
                <img src="/storage/cover_images/{{$properties->cover_image2}}" alt="Third slide">
                {{-- <div class="carousel-caption"><p>even with captions...</p></div> --}}
              </div>
            </div><!-- /.carousel-inner -->
            <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  
  </div><!-- /.container -->

  <div class="container">

    <ul class="nav nav-pills nav-stacked">
      <a href="#lightbox" data-toggle="modal"><img src="/storage/cover_images/{{$properties->cover_image}}" alt="First slide" style="width:50%"></a>
      <a href="#lightbox" data-toggle="modal" data-slide-to="1"><img src="/storage/cover_images/{{$properties->cover_image1}}" alt="First slide" style="width:50%"></a>
      <a href="#lightbox" data-toggle="modal" data-slide-to="2"><img src="/storage/cover_images/{{$properties->cover_image2}}" alt="First slide" style="width:50%"></a>
      <a href="#lightbox" data-toggle="modal" data-slide-to="15"><img src="/storage/cover_images/{{$properties->cover_image3}}" alt="First slide" style="width:50%"></a>
    </ul>
    
    <div class="modal fade and carousel slide" id="lightbox">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <ol class="carousel-indicators">
              <li data-target="#lightbox" data-slide-to="0" class="active"></li>
              <li data-target="#lightbox" data-slide-to="1"></li>
              <li data-target="#lightbox" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="/storage/cover_images/{{$properties->cover_image}}" alt="First slide">
              </div>
              <div class="item">
                <img src="/storage/cover_images/{{$properties->cover_image1}}" alt="Second slide">
              </div>
              <div class="item">
                <img src="/storage/cover_images/{{$properties->cover_image2}}" alt="Third slide">
                {{-- <div class="carousel-caption"><p>even with captions...</p></div> --}}
              </div>
            </div><!-- /.carousel-inner -->
            <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  
  </div><!-- /.container -->
    
    </div>


    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Send an Email') }}</div>
                <div class="card-body">
                    {!! Form::open(['action' => 'PropertyForRentController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                         {{ Form::label('title', 'Name') }}
                         {{ Form::text('name','',['class' => 'form-control', 'placeholder' => 'e.g john smith'] )}}
                    </div>
            
                    <div class="form-group">
                        {{ Form::label('title', 'Mobile Number') }}
                        {{ Form::text('number','',['class' => 'form-control', 'placeholder' => 'e.g peckham highstreet'] )}}
                   </div>
            
                   {{-- <div class="form-group">
                        {{ Form::label('title', 'Post Code') }}
                        {{ Form::text('post_code','',['class' => 'form-control', 'placeholder' => 'e.g se15 2tz'] )}}
                    </div> --}}
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

    client id: 910162589322-6v2aqa088k1b199889kedgoj3riorief.apps.googleusercontent.com
    client secret:lm7hvCR5x-rHPCeEfKyDchgy



     {{-- <div id="Map" class="tabcontent">
        <div class="card mb-3">
          <div id="googleMap" style="width:100%;height:400px;"></div>
          <script>
                  function myMap() {
                        var mapProp= {
                        center:new google.maps.LatLng({{$address['lat']}},{{$address['lng']}}),
                        zoom:17,
                        };
                        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                        new google.maps.Marker({
                        position:myCenter,
                        
                        });

                        marker.setMap(map);
                      }
                      
                      </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvxoZdoTf5GcBFXLOWKVI_jElP7mlU-28&callback=myMap"></script> --}}

          {{-- <div id="map"></div> --}}
  
      <!-- Async script executes immediately and must be after any DOM elements used in callback. -->


      {{-- for multiple markers --}}
  <script type="text/javascript">
    var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>


{{-- 
search bar --}}


{{-- body --}}
<br>
        <div class="col-md-8">
            @if(count($properties)> 0)
                @foreach ( $properties as $p )
                        <div class="card  mb-3" >
                            <div class="card-body">          
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="well">
                                            @if(count($p->photos)> 0)
                                                @foreach ( $p->photos as $file )
                                                    @if($file->properties_id== $p->id)
                                                        <img style="width:100%"src="/storage/cover_images/{{$file->filename}}">
                                                        @break
                                                    @endif
                                                @endforeach
                                        @endif 
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="well">
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
                                            <h3><a href = "/properties/{{$p->id}}"> {{$p->header}}</a></h3>
                                            {{-- <p>{!! $p->Description!!}</p> --}}
                                            <div class ="row justify-content-around">
                                                <h5><i style='font-size:24px' class='fas'>&#xf015;</i> {{$p->property_type}}</h5>
                                                <h5><i style='font-size:24px' class='fas'>&#xf236;</i> {{$p->number_of_rooms}}</h5>
                                                <h5><i style='font-size:24px' class='fas'>&#xf2cd;</i> {{$p->number_of_baths}}</h5>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <small>Listed on {{$p->created_at}} by {{$p->user['name']}}</small>
                                            </div>
                                    
                                        </div>
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
        </div>  


        <div class="col-sm-9">
          <div class="well">
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
              <h3><a href = "/properties/{{$p->id}}"> {{$p->header}}</a></h3>
              {{-- <p>{!! $p->Description!!}</p> --}}
              <div class ="row justify-content-around">
                  <h5><i style='font-size:24px' class='fas'>&#xf015;</i> {{$p->property_type}}</h5>
                  <h5><i style='font-size:24px' class='fas'>&#xf236;</i> {{$p->number_of_rooms}}</h5>
                  <h5><i style='font-size:24px' class='fas'>&#xf2cd;</i> {{$p->number_of_baths}}</h5>
              </div>
              <div class="card-footer text-muted">
                  <small>Listed on {{$p->created_at}} by {{$p->user['name']}}</small>
              </div>
      
          </div>
        </div>
      </div>

      <div class="col-sm-9">
        <div class="well">
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
            <h3><a href = "/properties/{{$p->id}}"> {{$p->header}}</a></h3>
            <p>{!! $p->Description!!}</p>
            <div class ="row justify-content-around">
                <h5><i style='font-size:24px' class='fas'>&#xf015;</i> {{$p->property_type}}</h5>
                <h5><i style='font-size:24px' class='fas'>&#xf236;</i> {{$p->number_of_rooms}}</h5>
                <h5><i style='font-size:24px' class='fas'>&#xf2cd;</i> {{$p->number_of_baths}}</h5>
            </div>
            <div class="card-footer text-muted">
                <small>Listed on {{$p->created_at}} by {{$p->user['name']}}</small>
            </div>
            {{-- <small> Written on {{$p->created_at}} by {{$p->user['name']}} </small>
                <p>{!!$p->body !!}</p> --}}
        </div>
      </div>
    </div>
</div>       
</div>  




<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlphaComodate') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <link href="css/bootstrap.min.css" rel="stylesheet">

     <!-- Icons -->
     <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

     <style>
         /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #575555;
            color:white;
        }
        .sent {
            background: #3a068f;
            float: right;
            text-align: right;
            color:white;
        }
        .message p {
            margin: 5px 0;
        }
        .date {
            color: #777777;
            font-size: 12px;
        }
        /* .active {
            background: #eeeeee;
        } */
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
     </style>

    
</head>
<body>
    <div id="app">
       
        <main class="py-4">
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
            @yield('content')
        </main>
    </div>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script >
        CKEDITOR.replace('summary-ckeditor');
</script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('7c785cb5029cb77df072', {
            cluster: 'eu',
            
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
            //alert(JSON.stringify(data));
            if (my_id == data.user_id){
                alert('sender')
            }else if(my_id == data.reciever_id){
                if (receiver_id == data.user_id) {
                    // if receiver is selected, reload the selected user ...
                    $('#' + data.user_id).click();
                } else {
                    // if receiver is not seleted, add notification for that user
                    var pending = parseInt($('#' + data.user_id).find('.pending').html());
                    if (pending) {
                        $('#' + data.user_id).find('.pending').html(pending + 1);
                    } else {
                        $('#' + data.user_id).append('<span class="pending">1</span>');
                    }
                }
            }

            
            });

        $('.user').click(function(){
            $('.user').removeClass('active');
            $(this).addClass('active');

            receiver_id = $(this).attr('id');
            // alert(receiver_id);
            $.ajax({
                type: "get",
                url: "message/" + receiver_id,//create route
                data:"",
                cache: false,
                success: function (data){
                    $('#message').html(data);
                    // alert(data);
                }
            });
        });

        $(document).on('keyup', '.input-text input', function (e){
            var message = $(this).val();
            if(e.keyCode == 13 && message != '' && receiver_id !=''){
                $(this).val('');
                // alert(message);
                var datastr = "receiver_id=" + receiver_id + "&message="+message;
                $.ajax({
                    type: "post",
                    url: "message",
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
              //  alert(datastr);
            }
        })
   
   
    });

    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }
        // ajax setup form csrf token

</script>
</body>
</html>



@if(count($properties)> 0)
@foreach ( $properties as $p )
@php
    $descrip = $p->Description;
    $description = substr($descrip,0,250)
@endphp
<div class="card "style="width:800px" >
    <div class="card-body">          
        <div class="row">
            <div class="col-sm-3">
                <div class="well">
                    @if(count($p->photos)> 0)
                        @foreach ( $p->photos as $file )
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
        <small>Listed on {{$p->created_at}} by {{$p->user['name']}}</small>
    </div>            
</div> 
<br> 
@endforeach
@else 
<p>No Properties to display</p>
@endif 


{{-- searchbar --}}

<form method="get" action="{{url('/properties/radius/cityLng/cityLat')}}">
    @csrf
    <ul class="list-group list-group-horizontal">

            <div class="form-group row">
                <div class="searchbar">
                      <br><br>
                    {{-- <label for="location">location</label> --}}
                    <input id="searchTextField" type="text" size="50" placeholder="eg. luton, peckham or se25" autocomplete="on" runat="server" />  
                    <input type="hidden" id="city2" name="city2" />
                    <input type="hidden" id="cityLat" name="cityLat" />
                    <input type="hidden" id="cityLng" name="cityLng" />
                    
                </div>
                <li>
                <div class="searchcard">
                    <br><br>
                    <input type="number" id="radius" name="radius" step="0.5" placeholder="radius"min="0"  >
                </div>
                </li>
                <li >
                <div class="searchcard ">
                    {{-- <label for="min_price">minprice</label> --}}
                    <br><br>
                    <input type="number" id="min_price" name="min_price" placeholder="min price" step="100" min="100" >
                </div>
                </li>
                <li>
                <div class="searchcard ">
                    {{-- <label for="max_price">maxprice</label> --}}
                    <br><br>
                    <input type="number" id="max_price" name="max_price" placeholder="max price" step="200" min="300" >
                </div>
                </li>
                <li>
                    <div class="searchcard ">
                        <br><br>
                        <select id="property_type" name="property_type" form="carform">
                            <option value="studio">Studio</option>
                            <option value="Flat">Flat</option>
                            <option value="Detached">Detached</option>
                            <option value="semi-detached">Semi-detached</option>
                          </select>
                        {{-- <input type="number" id="max_price" name="max_price" placeholder="max price" step="200" min="300" > --}}
                        
                    </div>
                    </li>
                <li>
                <div class="searchcard ">
                    {{-- <label for="max_price">maxprice</label> --}}
                    <br><br>
                    <input type="number" id="rooms" name="rooms" placeholder="Rooms" step="1" min="1" >
                </div>
                </li>
                <li >
                <div class="form-group row mb-0">
                    <div class="col-md-6 ">
                        <br><br>
                        <button type="submit" class="btn btn-secondary">
                            {{ __('Search') }}
                        </button>
                    </div>
                </div>
                </li>
            </div>
    </ul>
</form> 


<ul class="nav nav-tabs">
    <li class="nav-item">
      <button class="btn btn-secondary" onclick="openTab(event, 'Details')" id="defaultOpen"><b>Property Details</b></button>
    </li>
    <li class="nav-item">
      <button class="btn btn-secondary" onclick="openTab(event, 'Map')"><b>Property on the map</b></button>
    </li>
    <li class="nav-item">
      <button class="btn btn-secondary" onclick="openTab(event, 'contact')"><b>Contact LandLord</b></button>
    </li>
  </ul>
   {{-- <div class="tab">
    
    
    
  </div> --}}
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
        </div>
  