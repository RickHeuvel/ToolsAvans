@extends('layouts.master')
@section('title')
    <title>Tag categorie aanpassen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tag categorie aanpassen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">            
                <h2 class="mb-0"><strong>Tag categorie aanpassen</strong></h2>
            </div>
        </div>

        <hr>

        <div class="alert alert-warning" role="alert">
            <strong>Let op!</strong> Bij het aanpassen van een tag categorie worden automatisch alle tags bijgewerkt naar de nieuwe tag categorie.
        </div>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($tagCategory, ['route' => ['tagcategories.update', $tagCategory->slug], 'method' => 'PUT']) }}
               
        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{ Form::label('name', 'Naam  *') }}
                </div>
                <div class="col" align="right">
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Voer hier de nieuwe tag categorie naam in.">?</span>
                </div>
            </div>
            {{ Form::text('name', $tagCategory->name, ['class' => 'form-control']) }}
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal', '#tagcategories') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Aanpassen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
