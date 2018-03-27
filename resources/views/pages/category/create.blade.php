@extends('layouts.master')
@section('title')
    <title>Categorie toevoegen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('portal') }}">Mijn Portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categorie toevoegen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">            
                <h2 class="mb-0"><strong>Categorie toevoegen</strong></h2>
            </div>
        </div>
        
        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(array('url' => 'categories')) }}
               
        <div class="form-group">
            {{ Form::label('name', 'Naam  *') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{route('portal')}}" class="btn btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', array('class' => 'btn btn-danger btn-avans')) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection