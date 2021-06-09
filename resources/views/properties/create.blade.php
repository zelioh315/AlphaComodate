@extends('layouts.app')

@section('content')
<br>

    <h1>Create your Listing</h1>
    {!! Form::open(['action' => 'PropertyController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
             {{ Form::label('title', 'Header') }}
             {{ Form::text('header','',['class' => 'form-control', 'placeholder' => 'e.g 2 bedroom house for rent in walsall'] )}}
        </div>

        <div class="form-group">
            {{ Form::label('title', 'Address') }}
            {{ Form::text('address','',['class' => 'form-control', 'placeholder' => 'e.g bloxwich highstreet'] )}}
       </div>

       <div class="form-group">
            {{ Form::label('title', 'Post Code') }}
            {{ Form::text('post_code','',['class' => 'form-control', 'placeholder' => 'e.g ws3 1rp'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('title', 'City') }}
            {{ Form::text('City','',['class' => 'form-control', 'placeholder' => 'e.g london'] )}}
        </div>
            <div class="row justify-content-around">
                <div class="form-group">
                    {{ Form::label('title', 'Property Type') }}
                    {{Form::select('property_type',[
                         'Flat/Apartment' => 'Flat/Apartment',
                         'Studio' => 'Studio', 
                         'House' => 'House',
                         'Student-lets ' => 'Student lets',
                        ])}}
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Number of Rooms') }}
                    {{Form::selectRange('number_of_rooms', 1, 20)}}
         
                </div>
                <div class="form-group">
                    {{ Form::label('title', 'Number of Bathrooms') }}
                    {{Form::selectRange('number_of_baths', 1, 20)}}
                </div>
            </div>
       

        {{-- <div class="form-group">
            {{ Form::label('title', 'Type of Listing') }}
            {{Form::select('listing_type',[
                 'students' => 'Students',
                 'rentings' => 'Rentings', 
                 'shared' => 'Shared House',
                 'serviced' => 'Serviced accomodations',
                ])}}
        </div> --}}
        <h2>Facilities</h2>
        <div class="row justify-content-around">
            <div class="column">
                <div class="form-group">
                    <ul style="list-style-type:none;">
                        <li>{{Form::checkbox('parking', 'Parking')}}
                            {{ Form::label('title', 'Parking') }}</li>
                            <li>{{Form::checkbox('garden', 'Garden')}}
                            {{ Form::label('title', 'Garden') }}</li>    
                    </ul>
                </div>
            </div>    
            <div class="column">
                <div class="form-group">
                    <ul style="list-style-type:none;">
                        <li>{{Form::checkbox('Washing_machine', 'Washine Machine')}}
                            {{ Form::label('title', 'Washine Machine') }}</li>
                            <li>{{Form::checkbox('Furnished', 'Furnished')}}
                            {{ Form::label('title', 'Furnished') }}</li>
                            <li>{{Form::checkbox('Cooker', 'Cooker')}}
                            {{ Form::label('title', 'Cooker') }}</li> 
                    </ul>
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <ul style="list-style-type:none;">
                        <li>{{Form::checkbox('dryer', 'Dryer')}}
                            {{ Form::label('title', 'Dryer') }}</li>
                            <li>{{Form::checkbox('fridge', 'Fridge')}}
                            {{ Form::label('title', 'Fridge') }}</li>
                            <li>{{Form::checkbox('unfurnished', 'Unfurnished')}}
                            {{ Form::label('title', 'Un-Furnished') }}</li>
                            <li>{{Form::checkbox('fireplace', 'Fireplace')}}
                            {{ Form::label('title', 'Fireplace') }}</li> 
                    </ul>
                </div>
            </div>       
        </div>
                

        <div class="form-group">
            {{ Form::label('Description', 'Description') }}
            {{ Form::textarea('Description','',['class' => 'form-control',  'placeholder' => 'e.g The property is well presented with extension to rear producing good size kitchen/diner and comprises of entrance porch leading to lounge. Adjacent is the large kitchen diner with sky lights to give plenty of light. Upstairs features three bedrooms and modern bathroom finished to a very high standard with double glazing through out.'] )}}
        </div>
        <div class="form-group">
            {{ Form::label('title', 'Monthly Price') }}
            {{ Form::number('price', 'value')}}
        </div>
        {{Form::submit('Save', ['class'=>'btn btn-secondary'])}}
    {!! Form::close() !!}


        
@endsection
