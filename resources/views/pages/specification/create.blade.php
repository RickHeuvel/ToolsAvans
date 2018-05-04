@extends('layouts.master')
@section('title')
    <title>Specificatie toevoegen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Specificatie toevoegen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Specificatie toevoegen</strong></h2>
            </div>
        </div>

        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(['route' => 'specifications.store', 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('name', 'Naam  *') }}
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('category', 'Categorie *') }}
            {{ Form::select('category', $categories,old('category'),['placeholder' => 'Selecteer een categorie...','class' => 'custom-select form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('default', 'Standaard specificatie  *') }}
            {{ Form::checkbox('default', null, false) }}  
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
