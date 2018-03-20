@if (Route::currentRouteName() == "tools.index")
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
                                <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9 pl-0">
                        <div class="tool-body">
                            <h2>{{$tool->name}}</h2>
                            <p class="tool-description">{{$tool->description}}</p>
                            <div class="right-bottom">
                                <!-- Print crud buttons if page is portal else print show buttons -->
                                @if (Route::currentRouteName() == "portal")
                                    @if ($tool->status->isInactive())
                                        <a href="{{ URL::to('tools/' . $tool->slug . '/activate') }}" class="btn btn-danger btn-avans">Terugzetten</a>
                                    @elseif ($tool->status->isActive())
                                        <a data-toggle="modal" data-target="#{{$tool->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                        @include('partials.removetoolmodal')
                                    @endif

                                    @if($tool->status->isActive() || $tool->status->isInactive())
                                        <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                        <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                                    @elseif(Route::currentRouteName() == "portal" && $tool->status->isConcept())
                                        <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                                        <a href="{{ URL::to('tools/' . $tool->slug . '/approve') }}" class="btn btn-danger btn-avans">Goedkeuren</a>
                                        <a data-toggle="modal" data-target="#{{$tool->slug}}Modal" class="btn btn-danger btn-avans">Afkeuren</a>
                                        @include('partials.denytoolmodal')
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