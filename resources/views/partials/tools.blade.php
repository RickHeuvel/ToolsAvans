@if (Route::currentRouteName() == "tools.index" || Route::currentRouteName() == "portal")
    <div class="row mb-3">
        <div class="col-12">
            @if ((!empty($selectedCategories) && count($selectedCategories) > 0) || (!empty($selectedTags) && count($selectedTags) > 0) || !empty($selectedAcademies) && count($selectedAcademies) > 0)
                <p class="mb-2">Actieve filters:</p>
                @if(!empty($selectedCategories) && count($selectedCategories) > 0)
                    @foreach($categories as $category)
                        @if (in_array($category->slug, $selectedCategories))
                            <button type="button" id="btn{{$category->slug}}" data-slug="{{$category->slug}}" class="btn btn-light filter-button">{{ in_array($category->slug, $selectedCategories) ? $category->name : ""}} <span class="badge">X</span></button>
                        @endif
                    @endforeach
                @endif
                @if(!empty($selectedTags) && count($selectedTags) > 0)
                    @foreach($allTags as $tag)
                        @if (in_array($tag->slug, $selectedTags))
                            <button type="button" id="btn{{$tag->slug}}" data-slug="{{$tag->slug}}" class="btn btn-light filter-button">{{ in_array($tag->slug, $selectedTags) ? $tag->name : ""}} <span class="badge">X</span></button>
                        @endif
                    @endforeach
                @endif
                @if(!empty($selectedAcademies) && count($selectedAcademies) > 0)
                    @foreach($academies as $academy)
                        @if (in_array($academy->slug, $selectedAcademies))
                            <button type="button" id="btn{{$academy->slug}}" data-slug="{{$academy->slug}}" class="btn btn-light filter-button">{{ in_array($academy->slug, $selectedAcademies) ? $academy->name : ""}} <span class="badge">X</span></button>
                        @endif
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    @if (!$tools->isEmpty())
        @include('partials.pagination')
    @else
        <p>
            Geen tools gevonden :(<br>
        </p>
        <p>
            Staat een tool die je zoekt niet op ToolHub?<br>
            Voeg hem nu toe door <a href="{{ route('tools.create') }}">hier</a> te klikken!
        </p>
    @endif
@endif
@foreach($tools as $tool)
    @php($userReview = (Auth::check()) ? (Auth::user()->isEmployee()) ? $tool->teacherReviews->where('user_id', Auth::id())->first() : $tool->reviews->where('user_id', Auth::id())->first() : null)
    <div class="row">
        <div class="col-12">
            <div class="tool mb-4">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="p-3">
                            <div class="tool-logo">
                                <a href="{{ route('tools.show', $tool->slug) }}">
                                    <img src="{{ route('tools.image', (!empty($tool->logo_filename)) ? $tool->logo_filename : 'placeholder.jpg') }}" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                        @if(Route::currentRouteName() == "portal")
                            @if ($tool->status->isConcept())
                                <div class="concept-warning px-3 pb-3 text-center">
                                    @if ($tool->feedback != null && !$tool->feedback->fixed)
                                        <h6>Concept met onverwerkte feedback</h6>
                                    @else
                                        <h6>Concept opgestuurd voor keuring</h6>
                                    @endif
                                </div>
                            @else
                                <div class="concept-warning px-3 pb-3 text-center">
                                    <h6>{{ $tool->status->name }}</h6>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-12 col-md-8 col-lg-9 pl-md-0">
                        <div class="tool-body pl-3 pl-md-0">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-8 text-center text-md-left">
                                    <a class="tool-name-link mb-2 d-block" href="{{ route('tools.show', $tool->slug) }}">
                                        <h2 class="d-inline-block align-middle mb-0">{{$tool->name}}</h2>{!! ($tool->teacherReviews->where('recommended', true)->count() > 0) ? '<div class="d-inline-block align-middle recommended"><i class="fa fa-certificate align-middle" data-toggle="tooltip" data-placement="right" title="Aanbevolen door een docent!"></i></div>' : '' !!}
                                    </a>
                                    <p class="tool-views">{{ number_format($tool->views->count()) }} weergaven</p>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4 text-center text-md-right">
                                    <div class="tool-rating {{$tool->slug}} mb-2">
                                        @include('partials.stars-multiple')
                                    </div>
                                    <p class="rating">{{ $tool->reviews->count() }} keer gereviewed</p>
                                </div>
                            </div>
                            <p class="tool-description">{{ $tool->description }}</p>
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
                                    @if (auth()->check() && !auth()->user()->isEmployee() && $tool->reviews->where('user_id', Auth::id())->count() == 0)
                                        <a target="_blank" id="url-{{$tool->slug}}" data-enabled="true" href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                        @section('js')
                                            @parent
                                            <script>
                                                setURLModal('{{$tool->slug}}', '{{route("tools.createrating", ["slug" => $tool->slug])}}');
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
                @include('partials.modals.review-with-rating', ['id' => 'review-with-rating-' . $tool->slug])
                @include('partials.modals.review-without-rating', ['id' => 'review-without-rating-' . $tool->slug])
            </div>
        </div>
    </div>
@endforeach
@if (!$tools->isEmpty() && (Route::currentRouteName() == "tools.index" || Route::currentRouteName() == "portal"))
    @include('partials.pagination')
@endif
