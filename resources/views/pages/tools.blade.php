@extends('layouts.master')
@section('title')
    <title>Tools | ToolHub</title>
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tools</li>
                        </ol>
                    </nav>
            </div>
            <div class="col text-right py-1">
                <a href="{{ route('tools.create') }}" class="btn btn-avans tool-add">Tool toevoegen</a>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <div class="container pt-5">
        @include('partials.alert')

        <div class="row">
            <div class="col-12 col-lg-3">
                <h2 class="mb-0"><strong>Tools</strong></h2>
            </div>
            <div class="col-12 col-lg-9 my-2 my-lg-0 justify-content-right">
                <div class="row">
                    <div class="col-12 col-sm-7 col-md-8 col-lg-8 col-xl-8">
                        <div class="input-group">
                            <input class="form-control" name="searchQuery" type="search" placeholder="Zoeken naar tools..." aria-label="Search">
                            <div class="input-group-append">
                                <button id="searchButton" class="btn btn-outline-dark px-3" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4">
                        <section class="sorting float-right">
                            @include('partials.sorting')
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12 col-md-3">
                <div class="row mb-3">
                    <div class="col-6 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-2"><strong>Categorieën</strong></p>
                                @foreach($categories as $category)
                                    <div class="form-check mb-1" name="input">
                                        @if (!empty($selectedCategories))
                                            <input class="form-check-input" name="cat[]" type="checkbox" value="{{$category->slug}}" id="cat{{$category->slug}}" {{ in_array($category->slug, $selectedCategories) ? "checked" : "" }}>
                                        @else
                                            <input class="form-check-input" name="cat[]" type="checkbox" value="{{$category->slug}}" id="cat{{$category->slug}}">
                                        @endif
                                        <label class="form-check-label" for="cat{{$category->slug}}">
                                            {{$category->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-2"><strong>Academies</strong></p>
                                @foreach($academies as $academy)
                                    <div class="form-check mb-1">
                                        @if (!empty($selectedAcademies))
                                            <input class="form-check-input" name="aca[]" type="checkbox" value="{{$academy->slug}}" id="aca{{$academy->slug}}" {{ in_array($academy->slug, $selectedAcademies) ? "checked" : "" }}>
                                        @else
                                            <input class="form-check-input" name="aca[]" type="checkbox" value="{{$academy->slug}}" id="aca{{$academy->slug}}">
                                        @endif
                                        <label class="form-check-label" for="aca{{$academy->slug}}">
                                            {{$academy->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <p class="mb-2"><strong>Gepinde tags</strong></p>
                        @foreach($pinnedTags as $tag)
                            <div class="form-check mb-1">
                                @if (!empty($selectedTags))
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}" {{ in_array($tag->slug, $selectedTags) ? "checked" : "" }}>
                                @else
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}">
                                @endif
                                <label class="form-check-label" for="tag{{$tag->slug}}">
                                    {{$tag->name}}
                                </label>
                             </div>
                         @endforeach
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-12">
                        <p class="mb-2"><strong>Overige tags</strong></p>
                        @foreach($tagCategories as $tagCategory)
                            <div class="d-block mb-1">
                            @if($tagCategory->toolTags->where('category_slug', '!=', 'academie')->count())
                                <a data-toggle="collapse" data-target="#{{ $tagCategory->slug }}" aria-expanded="false" class="mb-2 collapsed tag-list"><i class="fa fa-chevron-right chevron"></i> {{ $tagCategory->name }}</a>
                                <div id="{{ $tagCategory->slug }}" class="pl-4 collapse">
                                    @foreach($tagCategory->toolTags as $tag)
                                        <div id="{{ $tag->id }}" class="form-check mb-1">
                                            @if (!empty($selectedTags))
                                                <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}" {{ in_array($tag->slug, $selectedTags) ? "checked" : "" }}>
                                            @else
                                                <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}">
                                            @endif
                                            <label class="form-check-label" for="tag{{$tag->slug}}">
                                                {{$tag->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            </div>
                        @endforeach
                        @foreach($tagsWithoutCategory as $tag)
                            <div class="form-check mb-1">
                                @if (!empty($selectedTags))
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}" {{ in_array($tag->slug, $selectedTags) ? "checked" : "" }}>
                                @else
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->slug}}" id="tag{{$tag->slug}}">
                                @endif
                                <label class="form-check-label" for="tag{{$tag->slug}}">
                                    {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <section class="tools">
                    @include('partials.tools', ['route' => 'tools'])
                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            /* Variables */
            let sortType = '{{ $selectedSortType }}'
                sortDirection = '{{ $selectedSortDirection }}'

            /* Listeners */
            // Category checkboxes
            $('input[name="cat[]"]').on('change', function (e) {
                e.preventDefault();
                getTools(generateURL());
            });

            // Tag checkboxes
            $('input[name="tag[]"]').on('change', function (e) {
                e.preventDefault();
                getTools(generateURL());
            });
            
            // Academy checkboxes
            $('input[name="aca[]"]').on('change', function (e) {
                e.preventDefault();
                getTools(generateURL());
            });


            // Search input field
            $('input[name="searchQuery"]').on('change', function (e) {
                e.preventDefault();

                getTools(generateURL());
            });

            $('#searchButton').on('click', function (e) {
                e.preventDefault();

                getTools(generateURL());
            });

            // Pagination buttons
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getTools(url);
            });

            $(".tag-list").click(function(){
                $(this).children().toggleClass("down"); 
            });

            function setFilterListeners() {
                $('.filter-button').on('click', function(e) {
                    var slug = $(this).data('slug');
                    uncheckItem(slug);
                    getTools(generateURL());
                });
            }
            setFilterListeners();

            function setSortListeners() {
                // Sort button clicked
                $('#sort-type .dropdown-item').on('click', function (e) {
                    e.preventDefault();

                    sortType = $(this).data('sort-type');
                    getTools(generateURL());
                });
                $('#sort-direction .dropdown-item').on('click', function (e) {
                    e.preventDefault();

                    sortDirection = $(this).data('sort-direction');
                    getTools(generateURL());
                });

            }
            setSortListeners();

            /* Functions */
            function generateURL() {
                var categories = [];
                var tags = [];
                var academies = [];
                $('input[name="cat[]"]:checked').each(function() {
                    categories.push($(this).val());
                });

                $('input[name="tag[]"]:checked').each(function() {
                    tags.push($(this).val());
                });
                
                $('input[name="aca[]"]:checked').each(function() {
                    academies.push($(this).val());
                });

                searchQuery = $('input[name="searchQuery"]').val();

                var urlParams = new URLSearchParams();
                if (categories.length > 0)
                    urlParams.append('categories', categories.join("+"));
                if (tags.length > 0)
                    urlParams.append('tags', tags.join("+"));
                if (academies.length > 0)
                    urlParams.append('academies', academies.join("+"));
                if (searchQuery)
                    urlParams.append('searchQuery', searchQuery);
                if (sortType)
                    urlParams.append('sortType', sortType);
                if (sortDirection)
                    urlParams.append('sortDirection', sortDirection);

                return $(location).attr('pathname') + (categories.length > 0 || tags.length > 0 || searchQuery) ? "?" + urlParams.toString() : "";
            }

            function getTools(url) {
                $('.tools').html('<div class="mt-5 mx-auto loader"></div>');
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('section.sorting').html(data['sorting']);
                    $('section.tools').html(data['tools']);

                    // Set sort listeners again because html was replaces
                    setSortListeners();
                    setFilterListeners();
                    window.history.pushState("", "", url);
                }).fail(function() {
                    alert('Tools could not be loaded.');
                });
            }

            function uncheckItem(slug) {
                var uncheck = document.getElementsByTagName('input');
                var button = document.getElementById('btn' + slug);

                button.remove();
                for (var i = 0; i < uncheck.length; i++) {
                    if (uncheck[i].value == slug) {
                        uncheck[i].checked = false;
                    }
                }
            }
        });

        function setModal(stars, slug, route, defaultValue) {
            $(stars + '.' + slug).on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type: 'GET',
                    data: { rating: value, multiple: true },
                }).done(function (data) {
                    disableUrl(slug);
                    $('#review-with-rating-' + slug + ' .tool-rating').empty();
                    $('#review-with-rating-' + slug + ' .tool-rating').append('<div class="starrr mb-4"></div>');
                    $('#review-with-rating-' + slug + ' .starrr').starrr({
                        rating: (value !== undefined) ? value : defaultValue,
                        readOnly: true
                    });
                    $('#review-with-rating-' + slug + ' .starrr').addClass('readOnly');
                    $('#review-with-rating-' + slug).modal('show');
                    $(stars + '.' + slug).parent().html(data);
                }).fail(function () {
                    alert('Rating kon niet worden geplaatst.');
                });
            });
        }

        function setURLModal(slug, route) {
            $('#url-' + slug).click(function() {
                if ($('#url-' + slug).data('enabled') == true) {
                    $('#review-without-rating-' + slug + ' .starrr').starrr();
                    $('#review-without-rating-' + slug).modal('show');
                }
            });

            $('#review-without-rating-' + slug + ' .starrr').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value, multiple: true },
                }).done(function (data) {
                    $('#review-with-rating-' + slug + ' .starrr').starrr({
                        rating: value,
                    });
                    $('#review-without-rating-' + slug).modal('hide');
                    $('#review-with-rating-' + slug).modal('show');

                    disableUrl(slug);
                    $('.tool-rating.' + slug).html(data);

                    $('#review-with-rating-' + slug + ' .tool-rating').empty();
                    $('#review-with-rating-' + slug + ' .tool-rating').append('<div class="starrr mb-4"></div>');
                    $('#review-with-rating-' + slug + ' .starrr').starrr({
                        rating: value,
                        readOnly: true
                    });
                    $('#review-with-rating-' + slug + ' .starrr').addClass('readOnly');

                    $('#review-without-rating-' + slug).modal('hide');
                    $('#review-with-rating-' + slug).modal('show');
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });
        }

        function disableUrl(slug) {
            $('#url-' + slug).data('enabled', false);
        }
    </script>
@endsection
