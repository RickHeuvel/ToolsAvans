@extends('layouts.master')
@section('title')
    <title>Tools | ToolHub</title>
@endsection

@section('content')
    <div class="container pt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tools</li>
            </ol>
        </nav>

        <hr class="mt-0">
        @include('partials.alert')

        <div class="row">
            <div class="col-3">
                <h2 class="mb-0"><strong>Tools</strong></h2>
            </div>
            <div class="col-9 my-2 my-lg-0 justify-content-right">
                <div class="input-group">
                    <input class="form-control" name="searchQuery" type="search" placeholder="Zoek" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
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
                            <div class="form-check mb-1">
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

                <!--<div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Specificaties</strong></p>
                        @foreach($specifications as $specification)
                            <div class="form-check mb-1">
                                @if (!empty($selectedSpecifications))
                                    <input class="form-check-input" name="spec[]" type="checkbox" value="{{$specification->slug}}" id="spec{{$specification->id}}" {{ in_array($specification->slug, $selectedSpecifications) ? "checked" : "" }}>
                                @else
                                    <input class="form-check-input" name="spec[]" type="checkbox" value="{{$specification->slug}}" id="spec{{$specification->id}}">
                                @endif
                                <label class="form-check-label" for="spec{{$specification->id}}">
                                    {{$specification->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>-->
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
    <script type="text/javascript">
        $(function() {
            // Listeners
            // Category checkboxes
            $('input[name="cat[]"]').on('change', function (e) {
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

            function generateURL() {
                var categories = [];
                $('input[name="cat[]"]:checked').each(function() {
                    categories.push($(this).val());
                });
                searchQuery = $('input[name="searchQuery"]').val();

                var urlParams = new URLSearchParams();
                if (categories.length > 0)
                    urlParams.append('categories', categories.join(","));
                if (searchQuery)
                    urlParams.append('searchQuery', searchQuery);

                return $(location).attr('pathname') + (categories.length > 0 || searchQuery) ? "?" + urlParams.toString() : "";
            }
            function getTools(url) {
                $('.tools').html('<div class="mt-5 mx-auto loader"></div>');
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.tools').html(data);
                    window.history.pushState("", "", url);
                }).fail(function () {
                    alert('Tools could not be loaded.');
                });
            }
        });
    </script>
@endsection
