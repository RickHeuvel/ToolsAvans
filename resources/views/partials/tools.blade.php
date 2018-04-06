@foreach($tools as $tool)
    <div class="row">
        <div class="col-12">
            <div class="tool mb-4">
                <div class="row">
                    <div class="col-12 col-md-3">
                        @if (!empty($tool->logo_filename))
                            <div class="p-3">
                                <a href="{{ URL::to('tools/' . $tool->slug) }}">
                                    <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9 pl-0">
                        <div class="tool-body">
                            <div class="row">
                                <div class="col">
                                    <a class="tool-name-link" href="{{ URL::to('tools/' . $tool->slug) }}">
                                        <h2>{{$tool->name}}</h2>
                                    </a>
                                </div>
                                @if ($tool->status->isConcept())
                                    <div class="col text-right concept-warning">
                                        @if ($tool->feedback != null && !$tool->feedback->fixed)
                                            <h6>Concept met onverwerkte feedback</h6>
                                        @else
                                            <h6>Concept opgestuurd voor keuring</h6>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <p class="tool-description">{{$tool->description}}</p>
                            <div class="right-bottom">
                                <!-- Print crud buttons if page is portal else print show buttons -->
                                @if (Route::currentRouteName() == "portal")
                                    <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                                    <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                    @if(Route::currentRouteName() == "portal" && $tool->status->isConcept() && Auth::user()->isAdmin())
                                        <a href="{{ URL::to('tools/' . $tool->slug . '/approve') }}" class="btn btn-danger btn-avans">Goedkeuren</a>
                                        @if($tool->feedback == null || ($tool->feedback && $tool->feedback->fixed))
                                            <a data-toggle="modal" data-target="#{{$tool->slug}}RequestChangesModal" class="btn btn-danger btn-avans">Wijzingen aanvragen</a>
                                            @include('partials.modals.requesttoolchanges')
                                        @endif
                                        <a data-toggle="modal" data-target="#{{$tool->slug}}DenyModal" class="btn btn-danger btn-avans">Afkeuren</a>
                                        @include('partials.denytoolmodal')
                                    @endif
                                    @if ($tool->status->isInactive())
                                        <a href="{{ URL::to('tools/' . $tool->slug . '/activate') }}" class="btn btn-danger btn-avans">Terugzetten</a>
                                    @elseif ($tool->status->isActive())
                                        <a data-toggle="modal" data-target="#{{$tool->slug}}DeactivateModal" class="btn btn-danger btn-avans">Deactieveren</a>
                                        @include('partials.deactivatetoolmodal')
                                    @endif
                                @else
                                    <a href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                    <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Meer informatie</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
