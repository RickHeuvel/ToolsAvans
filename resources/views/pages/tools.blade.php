@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Tools</h1>

        @foreach($tools as $tool)
            Name: {{$tool->name}}<br>
            Category: {{$tool->category}}<br>
            Description: {{$tool->description}}<br>
            URL: {{$tool->url}}<br>
            Username: {{$tool->user->name}}<br>
            <a href="{{ URL::to('tools/' . $tool->id) }}">Bekijk tool</a>
        @endforeach
    </div> 
@endsection
