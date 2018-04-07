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
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('tools.index')}}">Tools</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$tool->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-7 text-right">
                @if (Auth::check() && ((Auth::user()->isAdmin() || Auth::user()->isEmployee()) || Auth::user()->id == $tool->uploader_id))
                    <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}"
                       class="btn btn-danger btn-avans btn-center-vertical">Aanpassen</a>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ URL::to('tools/' . $tool->slug . '/approve') }}" class="btn btn-danger btn-avans">Goedkeuren</a>
                        @if ($tool->feedback == null || $tool->feedback->fixed)
                            <a data-toggle="modal" data-target="#{{$tool->slug}}RequestChangesModal" class="btn btn-danger btn-avans">Wijzingen aanvragen</a>
                            @include('partials.modals.requesttoolchanges')
                        @endif
                        <a data-toggle="modal" data-target="#{{$tool->slug}}DenyModal" class="btn btn-danger btn-avans">Afkeuren</a>
                    @endif
                @endif
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <hr class="mt-0">
        @if ($tool->feedback != null && !$tool->feedback->fixed)
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
                                <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}"
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
                                <div class="tool-rating">
                                    <div id="stars" class="starrr" data-toggle="tooltip" data-placement="right" title="Klik op een ster om een rating achter te laten!"></div>
                                    @include('partials.addreviewmodal')
                                </div>
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
            <div class="row justify-content-center">
                <div class="col-12">
                    @for ($i = 0; $i < count($tool->images); $i++)
                    <a href="{{ route('tools.image', ['filename' => $tool->images[$i]->image_filename]) }}" data-lightbox="lightbox" class="col-sm-4">
                        <img src="{{ route('tools.image', ['filename' => $tool->images[$i]->image_filename]) }}" class="img-fluid" height="150px" width="150px">
                    </a>
                    @endfor
                </div>
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
                <div class="owl-carousel owl-theme">
                    @foreach($tool->reviews as $review)
                        <p>{{ $review->username }}</p>
                        <p><b>{{ $review->title }}</b></p>
                        <p class="tool-rating">
                            @for($x = 0; $x < $review->rating; $x++)
                                <span class="fa-stack" style="width:2em">
                                    <i class="fas fa-star fa-stack-2x"></i>
                                </span>
                            @endfor
                        </p>
                        <p>{{ $review->description }}</p>
                    @endforeach
                        @foreach($tool->reviews as $review)
                            <div class="col-12">
                                <p>{{ $review->username }}</p>
                                <p><b>{{ $review->title }}</b></p>
                                <p class="tool-rating">
                                    @for($x = 0; $x < $review->rating; $x++)
                                        <span class="fa-stack" style="width:2em">
                                        <i class="fas fa-star fa-stack-2x"></i>
                                    </span>
                                    @endfor
                                </p>
                                <p>{{ $review->description }}</p>
                            </div>
                        @endforeach
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
                    @foreach($toolspecifications as $toolspecification)
                        <tr>
                            <th scope="row">{{ $toolspecification->specification()->first()->name }}</th>
                            <td>{{ $toolspecification->value }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.owl-carousel').owlCarousel({
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
        });

        $( document ).ready(function() {
            
            @if (!empty($tool->reviews))
                $('.starrr').starrr({
                    rating: {{$tool->reviews->avg('rating')}}
                });
            @else
                $('.starrr').starrr();
            @endif

            $('.starrr').on('starrr:change', function(e, value) {
                $.ajax({
                    url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                    type: 'GET',
                    data: { rating: value },
                }).done(function (data) {
                    $('#reviewmodal').modal('show');
                }).fail(function () {
                    alert('Review kon niet worden geplaatst.');
                });
            })

            setTimeout(function() {
                $('#stars').tooltip('show')
            }, 2000);
            $('#stars').mouseover(function() {
                $('#stars').tooltip('hide')
            });
        });
    </script>
@endsection