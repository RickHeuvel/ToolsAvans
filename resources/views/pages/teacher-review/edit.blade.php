@extends('layouts.master')
@section('title')
    <title>Review aanpassen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Review aanpassen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Review aanpassen</strong></h2>
            </div>
        </div>

        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($teacherReview, ['route' => ['tools.teacherreview.store', $tool->slug]]) }}

        <div class="form-group">
            {{ Form::label('title', 'Titel') }}
            {{ Form::text('title', old('preview'), ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('preview', 'Korte beschrijving') }}
            {{ Form::textarea('preview', old('preview'), ['class' => 'form-control', 'rows' => '3']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Uitgebreide beschrijving') }}
            {{ Form::textarea('description', old('description'), ['class' => 'teacher-description', 'rows' => '5']) }}
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('positives', 'Pluspunten') }}
                    <select name="positives[]" class="select2 w-100" multiple="multiple">
                        @foreach ((!is_null(old('positives'))) ? old('positives') : $teacherReview->positives->pluck('title') as $positive)
                            <option selected="selected">{{ $positive }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    {{ Form::label('negatives', 'Minpunten') }}
                    <select name="negatives[]" class="select2 w-100" multiple="multiple">
                        @foreach ((!is_null(old('negatives'))) ? old('negatives') : $teacherReview->negatives->pluck('title') as $negative)
                            <option selected="selected">{{ $negative }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-check mb-4">
            {{ Form::checkbox('recommended', old('recommended'), null, ['class' => 'form-check-input']) }}
            {{ Form::label('recommended', 'Deze tool aanbevelen') }}
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ URL::previous() }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Aanpassen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection

@section('js-includes')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('js')
    <script>
        $('.select2').select2({
            theme: "bootstrap4",
            multiple: true,
            tags: true
        });

        tinymce.init({
            selector: 'textarea.teacher-description'
        });
    </script>
@endsection
