@extends('layouts.master')
@section('title')
    <title>{{$tool->name}} | ToolHub</title>
@endsection
@section('js')
    <script>$('.owl-carousel').owlCarousel({
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });</script>
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
                    <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}"
                       class="btn btn-danger btn-avans btn-center-vertical">Aanpassen</a>
                @endif
            </div>
        </div>
        <hr class="mt-0">
        <div class="row">
            <div class="col-12">
                <div class="tool-view mt-4 mb-4">
                    <div class="row">
                        <div class=" tool-logo col-12 col-md-3">
                            <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}"
                                 class="img-fluid tool-image">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li><a href="#info">Informatie</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#specificaties">Specificaties</a></li>
                    <li><a href="#vragen">Vragen</a></li>
                </ul>
            </div>
        </div>
        <hr class="mt-0">
        <div class="row">
                <div class="owl-carousel owl-theme col-12">
                    @for ($i = 0; $i < count($tool->images); $i++)
                        <div>
                            <img src="{{ route('tools.image', ['filename' => $tool->images[$i]->image_filename]) }}"
                                 class="img-fluid">
                        </div>
                    @endfor
                </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-info col-12">
                <h2 id="info">Informatie</h2>
                <p class="mt-3">{{$tool->description}}</p>

            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-reviews container-fluid col-12">
                <h2 id=reviews>Reviews</h2>
                <div class="owl-carousel owl-theme col-12">
                    <div class="col-6">
                        <p>Username</p>
                        <p>sterren</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed blandit
                            tortor. Nunc non nisl vitae diam blandit sollicitudin.
                            Duis velit ante, pretium in mattis a, pharetra sit amet mauris. Proin
                            vitae turpis est. Pellentesque ut turpis id </p>
                    </div>

                    <div class="col-6">
                        <p>Username</p>
                        <p>sterren</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed blandit
                            tortor. Nunc non nisl vitae diam blandit sollicitudin.
                            Duis velit ante, pretium in mattis a, pharetra sit amet mauris. Proin
                            vitae turpis est. Pellentesque ut turpis id </p>
                    </div>
                    <div class="col-6">
                        <p>Username</p>
                        <p>sterren</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed blandit
                            tortor. Nunc non nisl vitae diam blandit sollicitudin.
                            Duis velit ante, pretium in mattis a, pharetra sit amet mauris. Proin
                            vitae turpis est. Pellentesque ut turpis id </p>
                    </div>

                    <div class="col-6">
                        <p>Username</p>
                        <p>sterren</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed blandit
                            tortor. Nunc non nisl vitae diam blandit sollicitudin.
                            Duis velit ante, pretium in mattis a, pharetra sit amet mauris. Proin
                            vitae turpis est. Pellentesque ut turpis id </p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-questions col-12">
                <h2 id="vragen">Vragen</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed blandit
                    tortor. Nunc non nisl vitae diam blandit sollicitudin.
                    Duis velit ante, pretium in mattis a, pharetra sit amet mauris. Proin
                    vitae turpis est. Pellentesque ut turpis id </p>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-specs col-12">
                <h2 id="specificaties">Specificaties</h2>
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row">Categorie:</th>
                        <td>{{$tool->category->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Avans tool:</th>
                        <td>Ja</td>
                    </tr>
                    <tr>
                        <th scope="row">Webtool:</th>
                        <td>Nee</td>
                    </tr>
                    <tr>
                        <th scope="row">Download:</th>
                        <td>Ja</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
