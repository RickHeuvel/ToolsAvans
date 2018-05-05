@extends('layouts.master')
@section('title')
    <title>{{$tool->name}} | Vragen | ToolHub</title>
@endsection

@section('content')
    <div class="container pt-4">
        <div class="row">            
            <div class="col-12 col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tools.index') }}">Tools</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tools.show', $tool->slug) }}">{{ $tool->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vragen</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-1 question-logo">            
                <img src="{{ route('tools.image', $tool->logo_filename) }}" class="img-fluid question-tool-logo">
            </div> 
            <div class="col question-question text-left">
                <h1> {{ $tool->name }} vragen </h1>              
            </div>
            <div class="col">                   
                <a data-toggle="modal" data-target="#{{$tool->slug}}addquestion" class="btn btn-danger btn-avans float-right">Vraag stellen</a>            
                @include('partials.modals.addquestion')   
            </div>
        </div>
        <hr>
        @include('partials.questions')
    </div>    
@endsection