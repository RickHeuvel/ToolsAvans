@extends('layouts.master')
@section('title')
    <title>ToolHub - {{$tool->name}}</title>
@endsection

@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('tools')}}">Tools</a></li>
                <li class="breadcrumb-item active">{{$tool->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <img id="toolLogo" src="{{ route('tool.image', ['filename' => $tool->logo_filename]) }}" class="img-responsive float-left">
                        <div class="tool-view">
                            <h1>{{$tool->name}}</h1>
                            <p class="mb-0"><Strong>Gepost door {{$tool->user->nickname}} op {{$tool->created_at->format('d-m-Y')}}</Strong></p>
                            <a href={{$tool->URL}}>{{$tool->URL}}</a>
                            <p class="align-right-top"><span class="badge badge-primary">{{$tool->category->name}}</span></p>
                            <p class="mt-4">{{$tool->description}}</p>
                        </div>
                    </div>
                    <div class="align-self-end">
                       {{-- <a id="btnReport" class="btn" role="button">Fout melden</a>--}}
                    </div>
                </div>

                <hr class="mb-4">

                <div class="container">

                    <div id="carouselToolPics" class="carousel slide" data-ride="carousel">
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

                    {{--questions commented out for first sprint--}}
                    {{--      <div class="container">
                              <h1>Vragen</h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer et ultrices
                                  augue. Nam sit amet
                                  convallis diam,
                                  sed auctor tellus. Fusce at diam vitae ipsum ornare placerat. Class aptent
                                  taciti sociosqu ad
                                  litora torquent per
                                  conubia nostra, per inceptos himenaeos. Phasellus augue elit, cursus sit amet
                                  porta vitae,
                                  eleifend eget diam. Ut
                                  ut purus a purus laoreet imperdiet sed eget ante. Sed pellentesque ullamcorper
                                  commodo. Interdum
                                  et malesuada fames
                                  ac ante ipsum primis in faucibus.
                              </p>
                          </div>--}}
                </div>
            </div>

            <div id="reactions" class="col-md-3">
                <p>
                </p>
            </div>
        </div>
    </div>
@endsection
