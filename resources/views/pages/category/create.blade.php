@extends('layouts.master')
@section('title')
    <title>Categorie toevoegen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
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

        {{ Form::open(['route' => 'categories.store']) }}

        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{ Form::label('name', 'Naam  *') }}
                </div>
                <div class="col" align="right">
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Voer hier de naam van de nieuwe categorie in.">?</span>
                </div>
            </div>
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{route('portal', '#categories')}}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
