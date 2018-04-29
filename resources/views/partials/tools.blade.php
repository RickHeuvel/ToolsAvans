
@if (Route::currentRouteName() == "tools.index" || Route::currentRouteName() == "portal")
    <div class="row">
        <div class="col-12">
            @if (!empty($selectedCategories) && count($selectedCategories) > 0)
                <h8>Actieve filters:</h8>
                <br>
                @foreach($categories as $category)
                    @if (in_array($category->slug,$selectedCategories))
                        <button type="button" id="btn{{$category->slug}}" data-slug="{{$category->slug}}" class="btn  filter-button">{{ in_array($category->slug, $selectedCategories) ? $category->slug : ""}} <span class="badge">X</span></button>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

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
                                    <div class="tool-rating mb-2">
                                        <div id="stars-{{$tool->slug}}" class="starrr"></div>
                                    </div>
                                    <p class="rating">{{ $tool->reviews->count() }} keer gereviewed</p>
                                    @section('js')
                                        @parent
                                        <script>
                                            $('#stars-{{$tool->slug}}').starrr({
                                                rating: {{$tool->reviews->avg('rating')}},
                                                readOnly: true
                                            });
                                            $('#stars-{{$tool->slug}}').addClass('readOnly');
                                        </script>
                                    @endsection
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
                                    @if (Auth::check() && empty($tool->reviews->where('user_id', Auth::id())->first()))
                                        <a target="_blank" id="url-{{$tool->slug}}" href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                        @include('partials.modals.review-with-rating', ['id' => 'review-with-rating-' . $tool->slug])
                                        @include('partials.modals.review-without-rating', ['id' => 'review-without-rating-' . $tool->slug])
                                        @section('js')
                                            @parent
                                            <script>
                                                setModal('{{$tool->slug}}', '{{route("tools.createrating", ["slug" => $tool->slug])}}');
                                            </script>
                                        @endsection
                                    @else
                                        <a target="_blank" href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                    @endif
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