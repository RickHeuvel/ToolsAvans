@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
<div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Mijn portaal</li>
            </ol>
        </nav>
    </div>
    <hr>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 col-md-6">            
            <h2><strong>{{auth()->user()->nickname}}</strong></h2>
            </div>
            <div class="col-12 col-md-6 text-right">
                <button type="button" href="{{ url('/tools/create') }}" class="btn btn-danger">Nieuwe tool toevoegen</button>
            </div>
        </div>
        @foreach ($tools as $tool)
        <div class="container" style="background-color:#bcbcbc">
            <div class="row">
                <div class="col-sm-3">
                <img alt="Tool logo" src="{{ route('tool.image', ['filename' => $tool->thumbnail]) }}" class="img-thumbnail">
                </div>
                <div class="col-9">
                <div class="row">
                    <p><strong>{{$tool->name}}</strong></p>
                </div>
                <div class="row">
                    <a>{{$tool->description}}</a>
                </div>
                <div class="row bottom">
                <div class="col-12">
                    <button type="button" href="{{ url('tool/' . $tool->slug . '/edit' }}" class="btn btn-danger">Aanpassen</button>
                    <button type="button" href="{{ url('tool/' . $tool->slug }}" class="btn btn-danger">Bekijken</button>
                </div>
                </div>
                </div>
            </div>
        </div>
        <br>
        @endforeach

        {{ $tools->render() }}

    </div> 
@endsection
