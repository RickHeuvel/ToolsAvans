@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Tool</h1>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'tools','enctype' => 'multipart/form-data')) }}

            <div class="form-group">
                {{ Form::label('name', 'Naam') }}
                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Beschrijving') }}
                {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('url', 'Url') }}
                {{ Form::text('url', Input::old('url'), array('class' => 'form-control')) }}
            </div>

            {{ Form::file('thumbnail', array('class' => 'image')) }}

            {{ Form::submit('Toevoegen', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div> 
@endsection