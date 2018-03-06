@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Mijn Portaal</h1>
        
        <p><strong>Gebruikersnaam:</strong> {{auth()->user()->name}}</p>
        <p><strong>Email:</strong> {{auth()->user()->email}}</p>
        <p><strong>Volledige naam:</strong> {{auth()->user()->nickname}}</p>
        <p><strong>Voornaam:</strong> {{auth()->user()->firstName}}</p>
        <p><strong>Achternaam:</strong> {{auth()->user()->lastName}}</p>
        <p><strong>Rol:</strong> {{auth()->user()->role}}</p>
        <p><strong>Locatie:</strong> {{auth()->user()->location}}</p>
    </div> 
@endsection
