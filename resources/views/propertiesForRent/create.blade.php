@extends('layouts.app')

@section('content')

    <h1>For Rentings</h1>
    {!! Form::open(['action' => 'PropertyForRentController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
             {{ Form::label('title', 'Header') }}
             {{ Form::text('header','',['class' => 'form-control', 'placeholder' => 'e.g 2 bedroom Apartment for rent in walsall'] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Address') }}
            {{ Form::text('address','',['class' => 'form-control', 'placeholder' => 'e.g peckham highstreet'] )}}
       </div>

       <div class="form-group">
            {{ Form::label('title', 'Post Code') }}
            {{ Form::text('post_code','',['class' => 'form-control', 'placeholder' => 'e.g se15 2tz'] )}}
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
            {{ Form::textarea('Description','',['class' => 'form-control', 'id'=>"summary-ckeditor", 'placeholder' => 'e.g The property is well presented with extension to rear producing good size kitchen/diner and comprises of entrance porch leading to lounge. Adjacent is the large kitchen diner with sky lights to give plenty of light. Upstairs features three bedrooms and modern bathroom finished to a very high standard with double glazing through out.'] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Monthly Price') }}
            {{ Form::number('monthly_price', 'value')}}
        </div>

        {{Form::submit('Save', ['class'=>'btn btn-secondary'])}}
    
    {!! Form::close() !!}


    

        
@endsection
