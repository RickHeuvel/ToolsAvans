@extends('layouts.master')
@section('title')
    <title>Homepage | ToolHub</title>
@endsection

@section('body-class')
home
@endsection

@section('content')
    <div class="container">
        <div class="owl-carousel hero owl-theme">
            @foreach($heroTools as $heroTool)
                <div class="hero-item text-white" style="background: url('{{ route('tools.image', $heroTool->images->random()->image_filename) }}') no-repeat center center / cover;">
                    <div class="inner pt-5 pb-5">
                        <div class="row justify-content-center mt-3">
                            <div class="col-12 col-md-10">
                                <div class="row">
                                    <div class="col-12 col-md-3 col-lg-2">
                                        <div class="tool-logo">
                                            <img src="{{ route('tools.image', $heroTool->logo_filename) }}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-9 col-lg-10">
                                        <div class="row">
                                            <div class="col-8">
                                                <h1>{{ $heroTool->name }}</h1>
                                            </div>
                                            <div class="col-4 text-right">
                                                <div class="tool-rating">
                                                    <div class="starrr readOnly">
                                                        {{ $stars = ($heroTool->reviews->count() > 0) ? $heroTool->reviews->avg('rating') : 0 }}
                                                        @for($i = 1; $i < 6; $i++)
                                                            <a href="#" class="fa {{ ($i > $stars) ? "fa-star-o" : "fa-star" }}"></a>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row">
                                            <div class="col-12">
                                                <p>{{ str_limit($heroTool->description, 150) }}</p>
                                                <a href="{{ route('tools.show', $heroTool->slug) }}" class="btn btn-danger btn-avans"> Bekijk tool &rarr;</a>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container-fluid px-md-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="top-list">
                        <h4>Nieuwste tools</h4>
                        <hr>
                        @foreach($newTools as $newTool)
                            <div class="top-tool @if(!$loop->last) mb-3 @endif">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="tool-logo">
                                            <a href="{{ route('tools.show', $newTool->slug) }}">
                                                <img src="{{ route('tools.image', $newTool->logo_filename) }}" class="img-fluid" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>{{ $newTool->name }}</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="tool-rating">
                                                    <div class="starrr readOnly">
                                                        {{ $stars = ($heroTool->reviews->count() > 0) ? $heroTool->reviews->avg('rating') : 0 }}
                                                        @for($i = 1; $i < 6; $i++)
                                                            <a href="#" class="fa {{ ($i > $stars) ? "fa-star-o" : "fa-star" }}"></a>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>{{ str_limit($newTool->description, 80) }}</p>
                                                <a href="{{ route('tools.show', $newTool->slug) }}">Bekijk tool &rarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last) <hr> @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="top-list">
                        <h4>Populaire tools</h4>
                        <hr>
                        @foreach($popularTools as $popularTool)
                            <div class="top-tool @if(!$loop->last) mb-3 @endif">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="tool-logo">
                                            <a href="{{ route('tools.show', $popularTool->slug) }}">
                                                <img src="{{ route('tools.image', $popularTool->logo_filename) }}" class="img-fluid" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4>{{ $popularTool->name }}</h4>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="tool-rating">
                                                    <div class="starrr readOnly">
                                                        {{ $stars = ($heroTool->reviews->count() > 0) ? $heroTool->reviews->avg('rating') : 0 }}
                                                        @for($i = 1; $i < 6; $i++)
                                                            <a href="#" class="fa {{ ($i > $stars) ? "fa-star-o" : "fa-star" }}"></a>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>{{ str_limit($popularTool->description, 70) }}</p>
                                                <a href="{{ route('tools.show', $popularTool->slug) }}">Bekijk tool &rarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last) <hr> @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white py-3 px-4 mt-5 d-flex">
            <h4 class="mb-0 align-middle py-1 d-inline-block">Bekijk ons volledige aanbod aan tools!</h4>
            <a href="{{ route('tools.index') }}" class="btn btn-danger btn-avans ml-auto">Ga naar tools</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.owl-carousel.hero').owlCarousel({
            margin: 0,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            },
            autoplay: true,
            autoplayTimeout: 6000,
            loop: true
        });
    </script>
@endsection
