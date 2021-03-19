@extends('layouts.app')

@section('content')
    <br>
    @php
        $x = 0
    @endphp
    @if(count($properties)> 0)
        @foreach ( $properties as $p )
                @if($p->listing_type == "students")
                        @php
                            $x+=1
                        @endphp
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
                        </div>  
                     @endif    
        @endforeach
    @else 
        @if($x == 0)
            <p>No Listings atm</p>
        @endif
    @endif         
@endsection