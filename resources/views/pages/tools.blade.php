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

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Tools</strong></h2>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12 col-md-3">
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
            <div class="col-12 col-md-9">
                <section class="tools">
                    @include('partials.pagination')
                    @include('partials.tools')
                    @include('partials.pagination')
                </section>
            </div>
        </div>
    </div> 
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            var categories = [];

            // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
            $('input[name="cat[]"]').on('change', function (e) {
                e.preventDefault();
                categories = []; // reset 

                $('input[name="cat[]"]:checked').each(function() {
                    categories.push($(this).val());
                });

                var urlParams = new URLSearchParams();
                if (categories.length > 0) {
                    urlParams.append('categories', categories.join(","));
                }
                
                var url = $(location).attr('pathname') + (categories.length > 0) ? "?" + urlParams.toString() : "";
                getTools(url);
                window.history.pushState("", "", url);
            });

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');
                getTools(url);
                window.history.pushState("", "", url);
            });

            function getTools(url) {
                $.ajax({
                    url : url
                }).done(function (data) {
                    $('.tools').html(data);
                }).fail(function () {
                    alert('Tools could not be loaded.');
                });
            }
        });
    </script>
@endsection
