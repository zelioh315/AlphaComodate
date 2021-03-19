@extends('layouts.app')

@section('content')

    <h1>Edit Listing </h1>
    {!! Form::open(['action' => ['PropertyForRentController@update', $propertiesForRent->id], 'method'=> 'PUT']) !!}
        <div class="form-group">
             {{ Form::label('title', 'Header') }}
             {{ Form::text('header',$propertiesForRent->header,['class' => 'form-control', 'placeholder' => 'e.g 2 bedroom house for sale in walsall'] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Address') }}
            {{ Form::text('address',$propertiesForRent->address,['class' => 'form-control', 'placeholder' => 'e.g bloxwich highstreet'] )}}
       </div>

       <div class="form-group">
            {{ Form::label('title', 'Post Code') }}
            {{ Form::text('post_code',$propertiesForRent->post_code,['class' => 'form-control', 'placeholder' => 'e.g ws3 1rp'] )}}
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
            {{Form::selectRange('number_of_rooms', 1, 10)}}
 
            {{ Form::label('title', 'Number of Bathrooms') }}
            {{Form::selectRange('number_of_baths', 1, 5)}}
        </div>

        <div class="form-group">
            {{ Form::label('Description', 'Description') }}
            {{ Form::textarea('Description',$propertiesForRent->Description,['class' => 'form-control', 'id'=>"summary-ckeditor", 'placeholder' => 'e.g The property is well presented with extension to rear producing good size kitchen/diner and comprises of entrance porch leading to lounge. '] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Monthly Price') }}
            {{ Form::number('monthly_price','value')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-secondary'])}}

    {!! Form::close() !!}

        
@endsection