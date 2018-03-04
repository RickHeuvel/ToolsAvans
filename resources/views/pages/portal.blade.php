@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
            <h1>Mijn Portaal</h1>
            <hr></hr>
            </div>
            <div class="col-12 col-md-6">
                <h2><strong>{{auth()->user()->nickname}}</strong></h2>
            </div>
            <div class="col-12 col-md-6 text-right">
                <button type="button" class="btn btn-danger">Nieuwe tool toevoegen</button>
            </div>
        </div>
        
        @foreach ($tools as $tool)

        <div class="container" style="background-color:#bcbcbc">
            <div class="row">
                <div class="col-sm-3">
                <img alt="Tool logo" src="{{ asset('img/toolhub-logo.png') }}" class="img-thumbnail">
                </div>
                <div class="col-9">
                <div class="row">
                    <p>id: {{$tool->id}}, 
                    naam: {{$tool->name}}</p>
                </div>
                <div class="row">
                    <a>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id risus aliquet, dapibus sapien non, aliquet ex. Mauris lacinia, lectus a eleifend tincidunt, tellus lacus aliquet nulla, sed venenatis lacus erat at erat. Donec vitae eleifend libero, in accumsan tortor. Fusce auctor aliquam massa ac consectetur. Nullam elementum aliquet justo sagittis fermentum. Duis sit amet sodales lacus. Praesent odio odio, ornare id semper at, eleifend non arcu.</a>
                </div>
                <div class="row margin-bottom">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-danger">Aanpassen</button>
                    <button type="button" class="btn btn-danger">Bekijken</button>
                </div>
                </div>
                </div>
            </div>
        </div>
        <br>
        @endforeach

        {{ $tools->render() }}

        <!--<p><strong>Gebruikersnaam:</strong> {{auth()->user()->name}}</p>
        <p><strong>Email:</strong> {{auth()->user()->email}}</p>
        <p><strong>Volledige naam:</strong> {{auth()->user()->nickname}}</p>
        <p><strong>Voornaam:</strong> {{auth()->user()->firstName}}</p>
        <p><strong>Achternaam:</strong> {{auth()->user()->lastName}}</p>
        <p><strong>Rol:</strong> {{auth()->user()->role}}</p>
        <p><strong>Locatie:</strong> {{auth()->user()->location}}</p>-->
    </div> 
@endsection
