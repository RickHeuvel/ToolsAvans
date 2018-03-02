@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <h1>Tools</h1>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @foreach($tools as $tool)
            @if (!empty($tool->thumbnail))
                <img class="img-fluid" src="{{ route('tool.image', ['filename' => $tool->thumbnail]) }}" /><br>
            @endif
            Name: {{$tool->name}}<br>
            Category: {{$tool->category}}<br>
            Description: {{$tool->description}}<br>
            URL: {{$tool->url}}<br>
            Username: {{$tool->user->name}}<br>
            <a href="{{ URL::to('tools/' . $tool->id) }}">Bekijk tool</a>
            <hr>
        @endforeach
    </div> 
@endsection
