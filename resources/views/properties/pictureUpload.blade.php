@extends('layouts.app')

@section('content')
<br>
    <div class="card mb-3">
        <div class="card-header">
            <h1>File Uploading</h1>
        </div>
        <div class="card-body">
            <h2> Please upload Pictures of your {{$properties->header}} here.</h2>
                {{-- <p> the property id is {{$properties->id}}</p> --}}
       
            {!! Form::open(['action' => 'PhotoController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}

                {{-- <h2>Upload images of your listing below</h2> --}}

                <input type="hidden" id="my-field" name="property_id" value={{$properties->id}}  />

                <div class="form-group">

                    {{ Form::file('filename[]',array('multiple'=>true)) }}
                    {{-- {{ Form::file('filename') }} --}}
                </div>



                {{Form::submit('Submit', ['class'=>'btn btn-secondary'])}}
            {!! Form::close() !!}
        </div>
        <div class="card-footer text-muted">
       
        </div>
    </div> 
@endsection
