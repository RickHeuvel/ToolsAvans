@extends('layouts.master')
@section('title')
    <title>Homepage | ToolHub</title>
@endsection

@section('body-class')
home
@endsection

@section('content')
<div class="container">
        <div class="bg-white px-3 py-2 my-2">
            <div class="row">
                <div class="col-5">
                    <div class="input-group">
                        <input class="form-control" name="searchQuery" type="search" placeholder="Zoeken naar tools..." aria-label="Search">
                        <div class="input-group-append">
                            <button id="searchButton" class="btn btn-outline-dark" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-7 pl-0 text-right">
                    <h4 class="mb-2 mb-md-0 py-1 d-block d-lg-inline-block">Bekijk tools in:</h4>
                    @foreach($categories as $category)
                        <a href="{{ route('tools.index') }}?categories={{ $category->slug }}" class="btn btn-white btn-avans ml-2 mb-2 mb-md-0">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @if($heroTools->count() > 0)
            <div class="owl-carousel hero owl-theme">
                @foreach($heroTools as $heroTool)
                    <div class="hero-item text-white" style="background: url('{{ route('tools.image', $heroTool->images->random()->image_filename) }}') no-repeat center center / cover;">
                        <div class="inner pt-5 pb-5">
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 col-md-10">
                                    <div class="mx-4 mx-md-0">
                                        <div class="row">
                                            <div class="col-12 col-md-3 col-lg-2">
                                                <div class="tool-logo d-none d-md-block">
                                                    <img src="{{ route('tools.image', $heroTool->logo_filename) }}" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9 col-lg-10 text-center text-md-left">
                                                <div class="row">
                                                    <div class="col-12 col-md-8 ">
                                                        <h1>{{ $heroTool->name }}</h1>
                                                    </div>
                                                    <div class="col-12 col-md-4 text-center text-md-right mb-3 mb-md-0">
                                                        <div class="tool-rating">
                                                            <div class="starrr readOnly">
                                                                {{ $stars = $heroTool->rating() }}
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
                    </div>
                @endforeach
            </div>
        @endif

        @if($newTools->count() > 0 && $popularTools->count() > 0)
            <div class="container-fluid px-md-4">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="top-list">
                            <h4>Nieuwste tools</h4>
                            <hr>
                            @foreach($newTools as $newTool)
                                <div class="top-tool @if(!$loop->last) mb-3 @endif">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="tool-logo">
                                                <a href="{{ route('tools.show', $newTool->slug) }}">
                                                    <img src="{{ route('tools.image', $newTool->logo_filename) }}" class="img-fluid" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 mt-2 mt-md-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4>{{ $newTool->name }}</h4>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="tool-rating">
                                                        <div class="starrr readOnly">
                                                            {{ $stars = $heroTool->rating() }}
                                                            @for($i = 1; $i < 6; $i++)
                                                                <a href="#" class="fa {{ ($i > $stars) ? "fa-star-o" : "fa-star" }}"></a>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>{{ str_limit($newTool->description, 70) }}</p>
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
                                        <div class="col-12 col-md-3">
                                            <div class="tool-logo">
                                                <a href="{{ route('tools.show', $popularTool->slug) }}">
                                                    <img src="{{ route('tools.image', $popularTool->logo_filename) }}" class="img-fluid" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-9 mt-2 mt-md-0">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4>{{ $popularTool->name }}</h4>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="tool-rating">
                                                        <div class="starrr readOnly">
                                                            {{ $stars = $heroTool->rating() }}
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
        @endif

        @if(!empty($homepageCategoryTools) && $homepageCategoryTools->count() > 0)
            <div class="pt-5">
                <h3 class="mb-3">Featured categorie - {{ $homepageCategory->name }}</h3>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel featured owl-theme">
                            @foreach($homepageCategoryTools as $homepageCategoryTool)
                                <a href="{{ route('tools.show', $homepageCategoryTool->slug) }}">
                                    <div class="featured-item text-white" style="background: url('{{ route('tools.image', $homepageCategoryTool->images->random()->image_filename) }}') no-repeat center center / cover;">
                                        <div class="inner pt-5 pb-5">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <div class="tool-logo d-inline-block">
                                                        <img src="{{ route('tools.image', $homepageCategoryTool->logo_filename) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <h4>{{ $homepageCategoryTool->name }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($homepageTagTools) && $homepageTagTools->count() > 0)
            <div class="pt-5">
                <h3 class="mb-3">Featured tag - {{ $homepageTag->name }}</h3>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel featured owl-theme">
                            @foreach($homepageTagTools as $homepageTagTool)
                                <a href="{{ route('tools.show', $homepageTagTool->slug) }}">
                                    <div class="featured-item text-white" style="background: url('{{ route('tools.image', $homepageTagTool->images->random()->image_filename) }}') no-repeat center center / cover;">
                                        <div class="inner pt-5 pb-5">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <div class="tool-logo d-inline-block">
                                                        <img src="{{ route('tools.image', $homepageTagTool->logo_filename) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <h4>{{ $homepageTagTool->name }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="bg-white py-3 px-4 mt-5 d-block w-100 d-md-flex text-md-left text-center">
            <h4 class="mb-0 align-middle py-1 d-inline-block">Bekijk ons volledige aanbod aan tools!</h4>
            <a href="{{ route('tools.index') }}" class="btn btn-danger btn-avans ml-auto mt-3 mt-md-0">Ga naar tools</a>
        </div>
    </div>
@endsection

@section('js-includes')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
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
            pullDrag: false,
            touchDrag: false,
            mouseDrag: false,
            dots: false,
        });

        $('.owl-carousel.featured').owlCarousel({
            margin: 15,
            nav: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            },
            loop:true,
            pullDrag: false,
            touchDrag: false,
            mouseDrag: false,
            dots: false,
        });
        $('#searchButton').on('click', function (e) {
            e.preventDefault();
            window.location = '{{ route('tools.index') }}' + '?searchQuery=' +
                $('input[name="searchQuery"]').val();
        });
        // Doesn't work, idk why
        $('input[name="searchQuery"]').on('change', function (e) {
            e.preventDefault();
            window.location = '{{ route('tools.index') }}' + '?searchQuery=' +
                $('input[name="searchQuery"]').val();
        });
    </script>
@endsection
