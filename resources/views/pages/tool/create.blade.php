@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Tool</h1>

        {{ HTML::ul($errors->all()) }}

        {{ Form::open(array('url' => 'tools')) }}

            <div class="form-group">
                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Toevoegen', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div> 
@endsection