@extends('layouts.master')
@section('title')
    <title>Tag toevoegen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tag toevoegen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Tag toevoegen</strong></h2>
            </div>
        </div>

        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(['route' => 'tags.store', 'class' => 'form-horizontal']) }}

        <div class="form-group">
            {{ Form::label('name', 'Naam  *') }}
            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('category', 'Tag categorie') }}
            {{ Form::select('category', $tagCategories,old('category'),['placeholder' => 'Selecteer een tag categorie...','class' => 'custom-select form-control']) }}
        </div>

        <div class="form-check">
            {{ Form::checkbox('pinned', null, false, ['class' => 'form-check-input']) }}
            {{ Form::label('pinned', 'Pinned tag, deze tag komt op de pagina met alle tools boven aan te staan. Dit is handig voor de wat belangrijkere tags als je wilt zoeken.') }}
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal', '#tags') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
