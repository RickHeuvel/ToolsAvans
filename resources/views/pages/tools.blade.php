@extends('layouts.master')
@section('title')
    <title>Tools | ToolHub</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tools</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <div class="container pt-5">
        @include('partials.alert')

        <div class="row">
            <div class="col-3">
                <h2 class="mb-0"><strong>Tools</strong></h2>
            </div>
            <div class="col-9 my-2 my-lg-0 justify-content-right">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-9 col-lg-9">
                        <div class="input-group">
                            <input class="form-control" name="searchQuery" type="search" placeholder="Zoeken naar tools..." aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark px-3" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 col-lg-3">
                        <section class="sorting">
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
                    <div class="col-12">
                        <p><strong>Categorieën</strong></p>
                        @foreach($categories as $category)
                            <div class="form-check mb-1" name="input">
                                @if (!empty($selectedCategories))
                                    <input class="form-check-input" name="cat[]" type="checkbox" value="{{$category->slug}}" id="cat{{$category->id}}" {{ in_array($category->slug, $selectedCategories) ? "checked" : "" }}>
                                @else
                                    <input class="form-check-input" name="cat[]" type="checkbox" value="{{$category->slug}}" id="cat{{$category->id}}">
                                @endif
                                <label class="form-check-label" for="cat{{$category->id}}">
                                    {{$category->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Tags</strong></p>
                        @foreach($tags as $tag)
                            <div class="form-check mb-1">
                                @if (!empty($selectedTags))
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->tag_slug}}" id="tag{{$tag->id}}" {{ in_array($tag->tag_slug, $selectedTags) ? "checked" : "" }}>
                                @else
                                    <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->tag_slug}}" id="tag{{$tag->id}}">
                                @endif
                                <label class="form-check-label" for="tag{{$tag->id}}">
                                    {{$tag->tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <section class="tools">
                    @include('partials.tools')
                </section>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <div id="sort" data-sort-type="{{ explode('-', $selectedSortOptions)[0] }}" data-sort-direction="{{ explode('-', $selectedSortOptions)[1] }}"></div>
    <script type="text/javascript">
        $(function() {
            /* Variables */
            var sortType = $('#sort').data('sort-type'),
                sortDirection = $('#sort').data('sort-direction');

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

            // Search input field
            $('input[name="searchQuery"]').on('change', function (e) {
                e.preventDefault();

                getTools(generateURL());
            });

            // Pagination buttons
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getTools(url);
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
                $('.sort-dropdown .dropdown-item').on('click', function (e) {
                    e.preventDefault();

                    sortType = $(this).data('sort-type');
                    sortDirection = $(this).data('sort-direction');
                    getTools(generateURL());
                });
            }
            setSortListeners();

            /* Functions */
            function generateURL() {
                var categories = [];
                var tags = [];
                $('input[name="cat[]"]:checked').each(function() {
                    categories.push($(this).val());
                });

                $('input[name="tag[]"]:checked').each(function() {
                    tags.push($(this).val());
                });
                searchQuery = $('input[name="searchQuery"]').val();

                var urlParams = new URLSearchParams();
                if (categories.length > 0)
                    urlParams.append('categories', categories.join("+"));
                if (tags.length > 0)
                    urlParams.append('tags', tags.join("+"));
                if (searchQuery)
                    urlParams.append('searchQuery', searchQuery);
                if (sortType && sortDirection)
                    urlParams.append('sort', sortType + "-" + sortDirection);

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
                }).fail(function () {
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

        function setModal(slug, route) {
            $('#url-' + slug).click(function() {
                $('#review-without-rating-' + slug + ' .ratingreview').starrr();
                $('#review-without-rating-' + slug).modal('show');
            });
        
            $('#review-with-rating-' + slug + ' .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value },
                }).done(function (date) {
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });
        
            $('#review-without-rating-' + slug + ' .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value },
                }).done(function (date) {
                    $('#review-with-rating-' + slug + ' .ratingreview').starrr({
                        rating: value,
                    });
                    $('#review-without-rating-' + slug).modal('hide');
                    $('#review-with-rating-' + slug).modal('show');
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });
        }
    </script>
@endsection
