@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Tool</h1>

        Name: {{$tool->name}}<br>
        Category: {{$tool->category}}<br>
        Description: {{$tool->description}}<br>
        URL: {{$tool->url}}<br>
        Username: {{$tool->user->name}}
    </div> 
@endsection