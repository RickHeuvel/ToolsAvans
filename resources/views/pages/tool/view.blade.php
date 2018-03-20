@extends('layouts.master')
@section('title')
    <title>{{$tool->name}} | ToolHub</title>
@endsection

@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('tools.index')}}">Tools</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$tool->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-4 text-right">
                @if (Auth::check() && $tool->uploader_id == auth()->user()->id)
                    <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}" class="btn btn-danger btn-avans btn-center-vertical">Aanpassen</a>
                @endif
            </div>
        </div>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <div class="tool-view mt-4 mb-4">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid tool-image">
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tool-body">
                                <h1>{{$tool->name}}</h1>
                                <p class="tool-category">in {{$tool->category->name}}</p>
                                <p class="tool-rating">
                                    @php $rating = $tool->Reviews()->avg('rating') @endphp
                                    @for($x = 0; $x < 5; $x++)
                                        @if($rating > 0)
                                            <span class="fa-stack" style="width:2em">
                                                <i class="fas fa-star fa-stack-2x"></i>
                                            </span>
                                        @endif
                                        @php $rating-- @endphp
                                    @endfor
                                </p>
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

        @if(count($tool->images) > 0)
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
                        @for ($i = 0; $i < count($tool->images); $i++)
                            <li data-target="#carousel-indicators" data-slide-to="{{$i}}" @if ($i == 1) class="active" @endif></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        @for ($i = 0; $i < count($tool->images); $i++)
                            <div class="carousel-item @if ($i == 1) active @endif">
                                <img src="{{ route('tools.image', ['filename' => $tool->images[$i]->image_filename]) }}" class="d-block w-100">
                            </div>
                        @endfor
                    </div>
                    <a class="carousel-control-prev" href="#carouselToolPics" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Vorige</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselToolPics" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Volgende</span>
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection
