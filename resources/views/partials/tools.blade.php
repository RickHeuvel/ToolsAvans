
@if (Route::currentRouteName() == "tools.index" || Route::currentRouteName() == "portal")
    @include('partials.pagination')
@endif
@foreach($tools as $tool)
    <div class="row">
        <div class="col-12">
            <div class="tool mb-4">
                <div class="row">
                    <div class="col-12 col-md-3">
                        @if (!empty($tool->logo_filename))
                            <div class="p-3">
                                <a href="{{ route('tools.show', $tool->slug) }}">
                                    <img src="{{ route('tools.image', $tool->logo_filename) }}" class="img-fluid" />
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9 pl-0">
                        <div class="tool-body">
                            <div class="row">
                                <div class="col-8">
                                    <a class="tool-name-link" href="{{ route('tools.show', $tool->slug) }}">
                                        <h2>{{$tool->name}}</h2>
                                    </a>
                                <p class="tool-views">{{ number_format($tool->views->count()) }} weergaven</p>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="tool-rating marginright">
                                        <div class="review-rating starrr">
                                            @for($x =0; $x < round($tool->reviews->avg('rating')); $x++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            @if(round($tool->reviews->avg('rating')) < 5)
                                                @for($i = 0; $i < 5 - round($tool->reviews->avg('rating')); $i++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                            @endif
                                        </div>
                                    </div>
                                    <p class="rating">{{ $tool->reviews->count() }} keer gereviewed</p>
                                </div>
                            </div>           
                            <p class="tool-description">{{$tool->description}}</p>
                            <div class="row">
                                @if(Route::currentRouteName() == "portal")
                                    @if ($tool->status->isConcept())
                                        <div class="col concept-warning">
                                            @if ($tool->feedback != null && !$tool->feedback->fixed)
                                                <h6>Concept met onverwerkte feedback</h6>
                                            @else
                                                <h6>Concept opgestuurd voor keuring</h6>
                                            @endif
                                        </div>
                                    @else
                                        <div class="col concept-warning">
                                            <h6>{{ $tool->status->name }}</h6>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="right-bottom">
                                <!-- Print crud buttons if page is portal else print show buttons -->
                                @if (Route::currentRouteName() == "portal")

                                    <a href="{{ route('tools.edit', $tool->slug) }}" class="btn btn-danger btn-avans">Aanpassen</a>

                                    @if(Route::currentRouteName() == "portal" && $tool->status->isConcept() && Auth::user()->isAdmin())

                                        <a href="{{ route('tools.approveTool', $tool->slug) }}" class="btn btn-danger btn-avans">Goedkeuren</a>

                                        @if($tool->feedback == null || ($tool->feedback && $tool->feedback->fixed))
                                            <a data-toggle="modal" data-target="#{{$tool->slug}}RequestChangesModal" class="btn btn-danger btn-avans">Wijzingen aanvragen</a>
                                            @include('partials.modals.requesttoolchanges')
                                        @endif

                                        <a data-toggle="modal" data-target="#{{$tool->slug}}DenyModal" class="btn btn-danger btn-avans">Afkeuren</a>
                                        @include('partials.modals.denytool')

                                    @endif

                                    @if ($tool->status->isInactive())
                                        <a href="{{ route('tools.activate', $tool->slug) }}" class="btn btn-danger btn-avans">Terugzetten</a>
                                    @elseif ($tool->status->isActive())
                                        <a data-toggle="modal" data-target="#{{$tool->slug}}DeactivateModal" class="btn btn-danger btn-avans">Deactiveren</a>
                                        @include('partials.modals.deactivatetool')
                                    @endif

                                @else
                                    <a href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                    <a href="{{ route('tools.show', $tool->slug) }}" class="btn btn-danger btn-avans">Meer informatie</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if (Route::currentRouteName() == "tools.index" || Route::currentRouteName() == "portal")
    @include('partials.pagination')
@endif