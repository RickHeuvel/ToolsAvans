@extends('layouts.master')
@section('title')
    <title>{{$tool->name}} | ToolHub</title>
@endsection
@section('content')
    <div class="container mt-4">
        @include('partials.alert')

        <div class="row">
            <div class="col-12 col-md-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tools.index') }}">Tools</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$tool->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-8 text-right">
                @if (Auth::check())
                    @if ($tool->status->isActive())
                        @include('partials.modals.reporttooloutdated')
                        <a data-toggle="modal" data-target="#ReportToolOutdatedModal" class="btn btn-danger btn-avans">Meld als verouderd</a>
                    @endif
                    @if ((( Auth::user()->id == $tool->owner_id || Auth::user()->isAdmin()) || ($tool->status->isConcept() && Auth::user()->isStudent() && Auth::user()->id == $tool->owner_id) || (!$tool->status->isConcept() && Auth::user()->isEmployee())))
                        <a href="{{ route('tools.edit', $tool->slug) }}" class="btn btn-danger btn-avans btn-center-vertical">Aanpassen</a>
                        @if (Auth::user()->isAdmin())
                            @if ($tool->status->isConcept())
                                <a href="{{ route('tools.approveTool', $tool->slug) }}" class="btn btn-danger btn-avans">Goedkeuren</a>
                                @if ($tool->feedback == null || $tool->feedback->fixed)
                                    <a data-toggle="modal" data-target="#{{$tool->slug}}RequestChangesModal" class="btn btn-danger btn-avans">Wijzingen aanvragen</a>
                                    @include('partials.modals.requesttoolchanges')
                                @endif
                                <a data-toggle="modal" data-target="#{{$tool->slug}}DenyModal" class="btn btn-danger btn-avans">Afkeuren</a>
                            @elseif ($tool->status->isActive())
                                <a data-toggle="modal" data-target="#{{$tool->slug}}DeactivateModal" class="btn btn-danger btn-avans">Deactiveren</a>
                                @include('partials.modals.deactivatetool')
                            @elseif ($tool->status->isInactive())
                                <a href="{{ route('tools.activate', $tool->slug) }}" class="btn btn-danger btn-avans">Terugzetten</a>
                            @endif
                        @endif
                    @endif
                @endif
            </div>
        </div>

        <hr class="mt-0">
        @if ($tool->status->isConcept() && $tool->feedback != null && !$tool->feedback->fixed)
            <div class="alert alert-info" role="alert">
                @if (auth()->user()->isStudent())
                    <h5 class="alert-heading">Je hebt feedback ontvangen op je tool</h5>
                @else
                    <h5 class="alert-heading">Er staat onverwerkte feedback open op deze tool</h5>
                @endif
                <p>Pas de tool aan met de feedback verwerkt om hem opnieuw op te sturen voor keuring</p>
                <hr>
                <h5>Feedback:</h5>
                {{ $tool->feedback->feedback }}
            </div>
        @elseif($tool->status->isOutdated())
            <div class="alert alert-warning" role="alert">
                @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id == $tool->owner_id))
                    <h5 class="alert-heading">Deze tool is door {{ $tool->outdatedReport->user->nickname }} als verouderd gemeld</h5>
                    <p>Pas de tool aan met de feedback verwerkt om de verouderd status te weg te halen</p>
                    <hr>
                    <h5>Feedback:</h5>
                    {{ $tool->outdatedReport->feedback }}
                @else
                    <h5 class="alert-heading">Opgepast! Deze tool is door een andere student als verouderd gemeld</h5>
                    <p>De tool eigenaar en de beheerder is er op de hoogste van gesteld dat deze tool verouderd is</p>
                @endif
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="tool-view mt-4 mb-4">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="tool-logo">
                                <img src="{{ route('tools.image', (!empty($tool->logo_filename)) ? $tool->logo_filename : 'placeholder.jpg') }}" class="img-fluid" />
                            </div>
                            <div class="concept-warning text-center pt-2">
                                @if ($tool->status->isConcept() && ($tool->feedback != null && !$tool->feedback->fixed))
                                    <h6>Concept met onverwerkte feedback</h6>
                                @elseif ($tool->status->isConcept() && ($tool->feedback == null || ($tool->feedback != null && $tool->feedback->fixed)))
                                    <h6>Concept opgestuurd voor keuring</h6>
                                @elseif ($tool->status->isConcept())
                                    <h6>Concept</h6>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tool-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-8 text-center text-md-left mt-4 mt-md-0">
                                        <h1 class="d-inline-block align-middle">{{$tool->name}}</h1>{!! ($tool->teacherReviews->where('recommended', true)->count() > 0) ? '<div class="d-inline-block align-middle recommended"><i class="fa fa-certificate align-middle" data-toggle="tooltip" data-placement="right" title="Aanbevolen door een docent!"></i></div>' : '' !!}
                                        <p class="tool-views mt-2">{{ number_format($tool->views->count()) }} weergaven</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 text-center text-md-right">
                                        <div class="tool-rating main-rating">
                                            @include('partials.stars-single')
                                        </div>
                                        <p class="rating mt-2">{{ $tool->reviews->count() }} keer gereviewed</p>
                                        @include('partials.modals.review-with-rating', ['id' => 'review-with-rating'])
                                        @include('partials.modals.review-without-rating', ['id' => 'review-without-rating'])
                                    </div>
                                </div>
                                <p>{{$tool->description}}</p>
                                <p class="tool-uploaded mb-0">Geplaatst op {{$tool->created_at->format('d F Y H:i')}}</p>
                                <hr>
                                @if (auth()->check() && !auth()->user()->isEmployee() && empty($userReview))
                                    <a id="url" target="_blank" href={{$tool->url}}>{{$tool->url}}</a>
                                @else
                                    <a target="_blank" href={{$tool->url}}>{{$tool->url}}</a>
                                @endif
                                <p class="tool-uploaded mb-0">Geplaatst op {{$tool->created_at->format('d F Y H:i')}}</p>
                                <hr>
                                @if (count($tool->tags) > 0)
                                    @foreach($tool->tags as $toolTag)
                                        <a href="{{ route('tools.index') }}?tags={{ $toolTag->slug }}"><span class="badge badge-light mb-1">{{ $toolTag->name }}</span></a>
                                    @endforeach
                                @else
                                    <p class="text-muted">Deze tool heeft geen tags :(</p>
                                @endif
                                @if (count($tool->academies) > 0)
                                   @foreach($tool->academies as $academy)
                                      <a href="{{ route('tools.index') }}?academies={{ $academy->slug }}" class="badge badge-light mb-1">{{ $academy->name }}</a>
                                   @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-1">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#screenshots">Screenshots</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#teacherreviews">Docenten reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                     <li>
                       <a class="nav-link" href="#alternative-tools">Alternative tools</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vragen">Vragen</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="mt-1">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 id="screenshots" class="mb-4">Screenshots</h2>
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
            <div class="tool-reviews container-fluid col-12">
                <h2 id="teacherreviews" class="mb-4">Docenten reviews</h2>
                @if ($tool->teacherReviews->isEmpty())
                    <p class="text-muted">Er zijn nog geen reviews :(</p>
                @else
                    <div class="owl-carousel teacherreviews owl-theme mt-4">
                        @foreach($tool->teacherReviews->sortByDesc('created_at') as $teacherReview)
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-10">
                                        <blockquote class="blockquote text-center">
                                            <p class="mb-2"><b>{{ $teacherReview->title }}</b></p>
                                            <p class="mb-2">{{ $teacherReview->preview }}</p>
                                            @if(!empty($teacherReview->description))
                                                <div class="collapse teacherreview-collapse-{{$teacherReview->id }}">
                                                    <p class="mb-2">{!! $teacherReview->description !!}</p>
                                                </div>
                                                <div aria-expanded="true" data-toggle="collapse" class="teacherreview-collapse-button tag-list pb-3" href=".teacherreview-collapse-{{$teacherReview->id}}" title="Laat uitgebreide beschrijving zien">
                                                    <u>Laat meer zien</u>
                                                    <u class="d-none">Laat minder zien</u>
                                                </div>
                                            @endif
                                            <div class="row justify-content-center mb-4">
                                                <div class="col-auto text-left">
                                                    <ul class="positives">
                                                        @foreach($teacherReview->positives as $positive)
                                                            <li><i class="fa fa-plus"></i> {{ $positive->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-auto text-left">
                                                    <ul class="negatives">
                                                        @foreach($teacherReview->negatives as $negative)
                                                            <li><i class="fa fa-minus"></i> {{ $negative->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="review-rating">
                                                @for($x = 0; $x < $teacherReview->rating; $x++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </p>
                                            <div class="blockquote-footer">{{ $teacherReview->user->nickname }}</div>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-reviews container-fluid col-12">
                <h2 id="reviews" class="mb-4">Reviews</h2>
                @if ($tool->reviews->isEmpty())
                    <p class="text-muted">Er zijn nog geen reviews :(</p>
                @else
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
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                       <a data-toggle="modal" data-target="#removeReview{{$review->id}}Modal" class="btn btn-danger btn-avans mt-2">
                                          <i class="fa fa-trash" aria-hidden="true"></i>
                                       </a>
                                    @endif
                                </blockquote>
                            </div>
                        @endforeach
                    </div>
                     @if (Auth::check() && Auth::user()->isAdmin())
                        @foreach($tool->reviews->sortByDesc('created_at') as $review)
                           @include('partials.modals.removereview')
                        @endforeach
                     @endif
                @endif
            </div>
        </div>
        <hr class="mt-4">
        <div class="row">
            <div class="tool-specs col-12">
                <h2 id="alternative-tools" class="mb-4">Alternatieve tools</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel alternative owl-theme">
                            @foreach($alternativeTools as $alternativeTool)
                                <a href="{{ route('tools.show', $alternativeTool->slug) }}">
                                    <div class="alternative-item text-white" style="background: url('{{ route('tools.image', $alternativeTool->images->random()->image_filename) }}') no-repeat center center / cover;">
                                        <div class="inner pt-5 pb-5">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <div class="tool-logo d-inline-block">
                                                        <img src="{{ route('tools.image', $alternativeTool->logo_filename) }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col text-center">
                                                    <h4 class="m-0">{{ str_limit($alternativeTool->name, 20) }}</h4>
                                                    <div class="review-rating">
                                                        @for($x = 0; $x < floor($alternativeTool->reviews->avg('rating')); $x++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </div>
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
        </div>
        <hr class="mt-4">
        <div class="row pb-5">
            <div class="tool-specs col-12">
                <h2 id="vragen" class="mb-4">Vragen</h2>
                @include('partials.questions')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        var url = true,
            tooltip = true;
        $('.owl-carousel.alternative').owlCarousel({
            margin: 15,
            nav: false,
            pullDrag: false,
            touchDrag: false,
            mouseDrag: false,
            dots: false,
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
            loop: true
        });
        
        $('.owl-carousel.screenshots').owlCarousel({
            margin: 30,
            nav: true,
            navText: ['<div class="carousel-arrow"></div>', '<div class="carousel-arrow"></div>'],
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
            autoplay: true,
            loop: true,
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

        $('.owl-carousel.teacherreviews').owlCarousel({
            margin: 30,
            autoplay: false,
            loop: true,
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
            }
        });

        $('#review-without-rating .starrr').on('starrr:change', function(e, value) {
            $.ajax({
                url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                type : 'GET',
                data: { rating: value },
            }).done(function (data) {
                disableUrl();
                $('.tool-rating.main-rating').html(data);

                $('#review-with-rating .tool-rating').empty();
                $('#review-with-rating .tool-rating').append('<div class="starrr mb-4"></div>');
                $('#review-with-rating .starrr').starrr({
                    rating: value,
                    readOnly: true
                });
                $('#review-with-rating .starrr').addClass('readOnly');

                disableTooltip();
                $('#review-without-rating').modal('hide');
                $('#review-with-rating').modal('show');
            }).fail(function () {
                alert('Rating kon niet geplaatst worden.');
            });
        });

        $('#url').click(function() {
            if (url) {
                disableTooltip();
                $('#review-without-rating .starrr').starrr();
                $('#review-without-rating').modal('show');
            }
        });

        function enableTooltip() {
            setTimeout(function() {
                if (tooltip)
                    $('.starrr').tooltip('show')
            }, 1000);
            $('.starrr').mouseover(function() {
                $('.starrr').tooltip('hide');
            });
        }

        function disableTooltip() {
            tooltip = false;
            $('.starrr').tooltip('hide');
        }

        function disableUrl() {
            url = false;
        }

        $('.teacherreview-collapse-button').click(function(){
            $(this).children().toggleClass("d-none");
        });
   </script>
@endsection
