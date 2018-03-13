@extends('layouts.master')
@section('title')
    <title>ToolHub - {{$tool->name}}</title>
@endsection

@section('content')

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('tools.index')}}">Tools</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$tool->name}}</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <div class="tool-view mt-4 mb-4">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <img src="{{ route('tool.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid tool-image">
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tool-body">
                                <h1>{{$tool->name}}</h1>
                                <p class="tool-category">in {{$tool->category->name}}</p>
                                <p class="tool-uploaded">Geplaatst op {{$tool->created_at->format('d F Y')}} door {{$tool->user->nickname}}</p>
                                <hr>
                                <a href={{$tool->url}}>{{$tool->url}}</a>
                                <p class="mt-3">{{$tool->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0">Screenshots</h2>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row">
            <div class="col-12">
                <div id="carouselToolPics" class="carousel slide mb-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-indicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-indicators" data-slide-to="1"></li>
                        <li data-target="#carousel-indicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="http://placehold.it/200x100" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="http://placehold.it/200x100" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="http://placehold.it/200x100" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselToolPics" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselToolPics" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
