@extends('layouts.app')

@section('content')
<br>

    <h1>Edit Listing </h1>
    {!! Form::open(['action' => ['PropertyController@update', $properties->id], 'method'=> 'PUT']) !!}
        <div class="form-group">
             {{ Form::label('title', 'Header') }}
             {{ Form::text('header',$properties->header,['class' => 'form-control', 'placeholder' => 'e.g 2 bedroom house for sale in walsall'] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Address') }}
            {{ Form::text('address',$properties->address,['class' => 'form-control', 'placeholder' => 'e.g bloxwich highstreet'] )}}
       </div>

       <div class="form-group">
            {{ Form::label('title', 'Post Code') }}
            {{ Form::text('post_code',$properties->post_code,['class' => 'form-control', 'placeholder' => 'e.g ws3 1rp'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('title', 'Property Type') }}
            {{Form::select('property_type',[
                 'apartments' => 'Apartments',
                 'detached' => 'Detached', 
                 'semi-detached' => 'Semi-detached',
                 'houses' => 'Houses',
                ])}}

            {{ Form::label('title', 'Number of Rooms') }}
            {{ Form::number('number_of_rooms',$properties->number_of_rooms)}}


            {{ Form::label('title', 'Number of Bathrooms') }}
            {{ Form::number('number_of_baths',$properties->number_of_baths)}}

        </div>

        <div class="form-group">
            {{ Form::label('Description', 'Description') }}
            {{ Form::textarea('Description',$properties->Description,['class' => 'form-control', 'placeholder' => 'e.g The property is well presented with extension to rear producing good size kitchen/diner and comprises of entrance porch leading to lounge. '] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Price') }}
            {{ Form::number('price',$properties->price)}}
        </div>


       <b> {{ Form::label('title', 'would you like to update the pictures?') }}</b>
        {{Form::select('editphoto',[
             'yes' => 'Yes',
             'no' => 'No', 
            ])}}

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-secondary'])}}

    {!! Form::close() !!}

        
@endsection