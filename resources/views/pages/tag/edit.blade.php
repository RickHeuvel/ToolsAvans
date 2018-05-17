@extends('layouts.master')
@section('title')
    <title>Tag aanpassen | ToolHub</title>
@endsection

@section('content')
  <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tag aanpassen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">            
                <h2 class="mb-0"><strong>Tag aanpassen</strong></h2>
            </div>
        </div>
        
        <hr>

        <div class="alert alert-warning" role="alert">
            <strong>Let op!</strong> Bij het aanpassen van een tag worden automatisch alle tools bijgewerkt naar de nieuwe tag.
        </div>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($tag, ['route' => ['tags.update', $tag->slug], 'method' => 'PUT']) }}
               

        <div class="form-group">
            {{ Form::label('name', 'Naam  *') }}
            {{ Form::text('name', $tag->name, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('category', 'Tag categorie  *') }}
            {{ Form::select('category', $tagCategories,old('category'),['placeholder' => 'Selecteer een tag categorie...','class' => 'custom-select form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('default', 'Pinned tag, deze tag komt boven alle andere tags bij de andere pinned tags.') }}
            {{ Form::checkbox('pinned', null, $tag->pinned,  ['class' => 'form-check']) }}  
        </div>
        
        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal', '#tags') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Aanpassen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
