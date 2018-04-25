@extends('layouts.master')
@section('title')
    <title>{{$tool->name}} | ToolHub</title>
@endsection
@section('content')
    <div class="container mt-4">
        @include('partials.alert')

        <div class="row">
            <div class="col-12 col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tools.index') }}">Tools</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$tool->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-7 text-right">
                @if (Auth::check() && ((Auth::user()->isAdmin()) || ($tool->status->isConcept() && Auth::user()->isStudent() && Auth::user()->id == $tool->uploader_id) || (!$tool->status->isConcept() && Auth::user()->isEmployee())))
                    <a href="{{ route('tools.edit', $tool->slug) }}" class="btn btn-danger btn-avans btn-center-vertical">Aanpassen</a>
                    @if (Auth::user()->isAdmin())
                        @if ($tool->status->isConcept())
                            <a href="{{ route('tools.approveTool', $tool->slug) }}" class="btn btn-danger btn-avans">Goedkeuren</a>
                            @if ($tool->feedback == null || $tool->feedback->fixed)
                                <a data-toggle="modal" data-target="#{{$tool->slug}}RequestChangesModal" class="btn btn-danger btn-avans">Wijzingen aanvragen</a>
                                @include('partials.modals.requesttoolchanges')
                            @endif
                            <a data-toggle="modal" data-target="#{{$tool->slug}}DenyModal" class="btn btn-danger btn-avans">Afkeuren</a>
                        @endif
                        @if ($tool->status->isActive())
                            <a data-toggle="modal" data-target="#{{$tool->slug}}DeactivateModal" class="btn btn-danger btn-avans">Deactiveren</a>
                            @include('partials.modals.deactivatetool')
                        @elseif ($tool->status->isInactive())
                            <a href="{{ route('tools.activate', $tool->slug) }}" class="btn btn-danger btn-avans">Terugzetten</a>
                        @endif
                    @endif
                @endif
            </div>
        </div>

        <hr class="mt-0">
        @if ($tool->status->isConcept() && $tool->feedback != null && !$tool->feedback->fixed)
            <div class="alert alert-info" role="alert">
                 <h5 class="alert-heading">Je hebt feedback ontvangen op je tool</h5>
                 <p>Update de tool met de feedback verwerkt om hem opnieuw op te sturen voor keuring</p>
                 <hr>
                <h5>Feedback:</h5>
                {{ $tool->feedback->feedback }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="tool-view mt-4 mb-4">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="tool-logo">
                                <img src="{{ route('tools.image', $tool->logo_filename) }}"
                                 class="img-fluid tool-logo">
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tool-body">
                                <div class="align-right-top concept-warning">
                                    @if ($tool->status->isConcept() && ($tool->feedback != null && !$tool->feedback->fixed))
                                        <h6>Concept met onverwerkte feedback</h6>
                                    @elseif ($tool->status->isConcept() && ($tool->feedback == null || ($tool->feedback != null && $tool->feedback->fixed)))
                                        <h6>Concept opgestuurd voor keuring</h6>
                                    @elseif ($tool->status->isConcept())
                                        <h6>Concept</h6>
                                    @endif
                                </div>
                                <h1>{{$tool->name}}</h1>
                                <p class="tool-category">in {{$tool->category->name}}</p>
                                <div class="tool-rating" id="toolRating">
                                    <div id="starRating">
                                        @if (!Auth::check())
                                            <div id="stars" class="starrr" data-toggle="tooltip" data-placement="right" title="Login om een rating achter te laten!"></div>
                                        @elseif (empty($curUserReview))
                                            <div id="stars" class="starrr" data-toggle="tooltip" data-placement="right" title="Klik op een ster om een rating achter te laten!"></div>
                                        @else
                                            <div id="stars" class="starrr"></div>
                                        @endif
                                    </div>
                                    @include('partials.modals.review-with-rating')
                                    @include('partials.modals.review-without-rating')
                                </div>
                                <p class="tool-uploaded">Geplaatst op {{$tool->created_at->format('d F Y')}} door {{$tool->user->nickname}}</p>
                                <hr>
                                @if (Auth::check() && empty($curUserReview))
                                    <a id="url" target="_blank" href={{$tool->url}}>{{$tool->url}}</a>
                                @else
                                    <a target="_blank" href={{$tool->url}}>{{$tool->url}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#screenshots">Screenshots</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#info">Informatie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#specificaties">Specificaties</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 id="screenshots">Screenshots</h2>
                <div class="owl-carousel screenshots owl-theme mt-4">
                    @foreach ($tool->images as $screenshot)
                        <div class="item">
                            <a href="{{ route('tools.image', $screenshot->image_filename) }}" data-lightbox="lightbox">
                                <img src="{{ route('tools.image', $screenshot->image_filename) }}" class="img-fluid">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-info col-12">
                <h2 id="info">Informatie</h2>
                <p class="mt-4 mb-4">{{$tool->description}}</p>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-reviews container-fluid col-12">
                <h2 id="reviews">Reviews</h2>
                <div class="owl-carousel reviews owl-theme mt-4">
                    @foreach($tool->reviews->sortByDesc('created_at') as $review)
                        <div class="item">
                            <blockquote class="blockquote text-center">
                                <p class="mb-2"><b>{{ $review->title }}</b></p>
                                <p class="mb-2">{{ $review->description }}</p>
                                <p class="review-rating">
                                    @for($x = 0; $x < $review->rating; $x++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </p>
                                <div class="blockquote-footer">{{ $review->user->nickname }}</div>
                            </blockquote>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="mt-4">
        <div class="row pb-5">
            <div class="tool-specs col-12">
                <h2 id="specificaties" class="mb-4">Specificaties</h2>
                @if (count($toolspecifications) > 0)
                    <table class="table table-striped">
                        <tbody>
                            @foreach($toolspecifications as $toolspecification)
                                <tr>
                                    <th scope="row">{{ $toolspecification->specification()->first()->name }}</th>
                                    <td>{{ $toolspecification->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Deze tool heeft nog geen specificaties!</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        var tooltip = true;
        $('.owl-carousel.screenshots').owlCarousel({
            margin: 30,
            nav: false,
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
        });

        $('.owl-carousel.reviews').owlCarousel({
            margin: 30,
            nav: false,
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
        });

        $( document ).ready(function() {
            @if (!empty($curUserReview))
                $('#stars').starrr({
                    rating: {{$curUserReview->rating}},
                    readOnly: true
                });
                $('#stars').addClass('readOnly');
            @elseif (!$tool->reviews->isEmpty() && Auth::check())
                $('#stars').starrr({
                    rating: {{$tool->reviews->avg('rating')}}
                });
                enableReviewModal();
                enableTooltip();
            @elseif (!$tool->reviews->isEmpty() && !Auth::check())
                $('#stars').starrr({
                    rating: {{$tool->reviews->avg('rating')}},
                }).click(function(){
                    location.href = '{{route("login")}}'
                });
                enableTooltip();
            @elseif ($tool->reviews->isEmpty() && !Auth::check())
                $('.tool-rating').hide();
            @else
                $('#stars').starrr();
                enableReviewModal();
                enableTooltip();
            @endif

            function enableReviewModal() {
                $('#stars').on('starrr:change', function(e, value) {
                    @if(Auth::check())
                        $.ajax({
                            url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                            type: 'GET',
                            data: { rating: value },
                        }).done(function (data) {
                            $('#review-with-rating .ratingreview').starrr({
                                rating: value,
                            });
                            disableTooltip();
                            $('#review-with-rating').modal('show');
                        }).fail(function () {
                            alert('Rating kon niet worden geplaatst.');
                        });
                    @else
                        window.location.href = '{{route("login")}}';
                    @endif
                })
            }

            $('#review-with-rating .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                    type : 'GET',
                    data: { rating: value },
                }).done(function (date) {
                    setMainRating(value);
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });

            $('#review-without-rating .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                    type : 'GET',
                    data: { rating: value },
                }).done(function (date) {
                    setMainRating(value);
                    $('#review-with-rating .ratingreview').starrr({
                        rating: value,
                    });
                    disableTooltip();
                    $('#review-without-rating').modal('hide');
                    $('#review-with-rating').modal('show');
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });
            
            $('#url').click(function() {
                disableTooltip();
                $('#review-without-rating .ratingreview').starrr();
                $('#review-without-rating').modal('show');
            });

            function setMainRating(value) {
                $('#starRating').empty();
                $('#starRating').append('<div id="stars" class="starrr"></div>');
                $('#stars').starrr({
                    rating: parseInt(value)
                });
            }

            function enableTooltip() {
                setTimeout(function() {
                    if (tooltip)
                        $('#stars').tooltip('show')
                }, 1000);
                $('#stars').mouseover(function() {
                    $('#stars').tooltip('hide');
                });
            }
        
            function disableTooltip() {
                tooltip = false;
                $('#stars').tooltip('hide');
            }
        });
   </script>
@endsection
