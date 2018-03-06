@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-12 col-md-3">
                <p><strong>Categorieën</strong></p>
                @foreach($categories as $category)
                    <div class="form-check">
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
                    @include('partials.tools')
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