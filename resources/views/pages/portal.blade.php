@extends('layouts.master')
@section('title')
    <title>Mijn portaal | ToolHub</title>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mijn portaal</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <hr class="m-0">

    <div class="container pt-5">

        <div class="row mb-4">
            <div class="col-12 col-md-6">
                <h2><strong>{{auth()->user()->nickname}}</strong></h2>
            </div>
            <div class="col-12 col-md-6 text-right">
                <div class="tab-buttons">
                    <a href="{{ route('tools.create') }}" class="btn btn-danger btn-avans" id="mytools-button">Nieuwe tool toevoegen</a>
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('categories.create') }}" class="btn btn-danger btn-avans" id="categories-button">Nieuwe categorie toevoegen</a>
                        <a href="{{ route('tags.create') }}" class="btn btn-danger btn-avans" id="tags-button">Nieuwe tag toevoegen</a>
                        <a href="{{ route('tagcategories.create') }}" class="btn btn-danger btn-avans" id="tagcategories-button">Nieuwe tag categorie toevoegen</a>
                    @endif
                </div>
            </div>
        </div>

        @if ($errors->isNotEmpty())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Html::ul($errors->all()) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @include('partials.alert')


        <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="mytools-tab" data-toggle="tab" href="#mytools" role="tab" aria-controls="mytools" aria-selected="true">Mijn tools</a>
            </li>

            @if (auth()->user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link" id="tools-tab" data-toggle="tab" href="#tools" role="tab" aria-controls="tools" aria-selected="false">Alle tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="unjudgedtools-tab" data-toggle="tab" href="#unjudgedtools" role="tab" aria-controls="unjudgedtools" aria-selected="false">Te keuren tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="filters-tab" data-toggle="tab" href="#filters" role="tab" aria-controls="filters" aria-selected="false">Filters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="adminpanel-tab" data-toggle="tab" href="#adminpanel" role="tab" aria-controls="adminpanel" aria-selected="false">Beheersinstellingen</a>
                </li>
            @elseif (auth()->user()->isStudent())
                <li class="nav-item">
                    <a class="nav-link" id="myconcepttools-tab" data-toggle="tab" href="#myconcepttools" role="tab" aria-controls="myconcepttools" aria-selected="false">Mijn concept tools</a>
                </li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane pt-4" id="mytools" role="tabpanel" aria-labelledby="mytools-tab">
                @if(count($myTools) > 0)
                    @include('partials.tools', ['tools' => $myTools])
                @else
                    <p>U heeft nog geen tools toegevoegd, voeg uw eerste tool toe door <a href="{{route('tools.create')}}">hier</a> te klikken!</p>
                @endif
            </div>

            @if (auth()->user()->isAdmin())
                <div class="tab-pane pt-4" id="tools" role="tabpanel" aria-labelledby="activetools-tab">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <p><strong>Tool status</strong></p>
                                    @foreach($statuses as $status)
                                        <div class="form-check mb-1">
                                            @if (!empty($selectedStatuses))
                                                <input class="form-check-input" name="status[]" type="checkbox" value="{{$status->slug}}" id="status{{$status->id}}" {{ in_array($status->slug, $selectedStatuses) ? "checked" : "" }}>
                                            @else
                                                <input class="form-check-input" name="status[]" type="checkbox" value="{{$status->slug}}" id="status{{$status->id}}">
                                            @endif
                                            <label class="form-check-label" for="status{{$status->id}}">
                                                {{$status->name}}
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

                <div class="tab-pane pt-4" id="unjudgedtools" role="tabpanel" aria-labelledby="unjudgedtools-tab">
                    @include('partials.tools', ['tools' => $unjudgedTools])
                </div>

                <div class="tab-pane pt-4" id="filters" role="tabpanel" aria-labelledby="filters-tab">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-categories-tab" data-toggle="pill" href="#categories" role="tab" aria-controls="v-pills-categories" aria-selected="true">Categorieën</a>
                                <a class="nav-link" id="v-pills-tags-tab" data-toggle="pill" href="#tags" role="tab" aria-controls="v-pills-tags" aria-selected="false">Tags</a>
                                <a class="nav-link" id="v-pills-tagcategories-tab" data-toggle="pill" href="#tagcategories" role="tab" aria-controls="v-pills-tagcategories" aria-selected="false">Tag categorieën</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="categories" role="tabpanel" aria-labelledby="v-pills-categories">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Categorieën</h2>
                                        </div>
                                    </div>
                                    @foreach($categories as $category)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="category">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <p class="category-name">{{$category->name}}</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 text-right">
                                                            <a data-toggle="modal" data-target="#{{$category->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                                            <a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                                            @include('partials.modals.removecategory')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="tags" role="tabpanel" aria-labelledby="v-pills-tags-tab">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Tags</h2>
                                        </div>
                                    </div>
                                    @foreach($tags as $tag)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="category">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <p class="category-name">{{$tag->name}}</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 text-right">
                                                            <a data-toggle="modal" data-target="#{{$tag->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                                            <a href="{{ route('tags.edit', $tag->slug) }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                                            @include('partials.modals.removetag')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="tagcategories" role="tabpanel" aria-labelledby="v-pills-tagcategories-tab">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Tag categorieën</h2>
                                        </div>
                                    </div>
                                    @foreach($tagCategories as $tagCategory)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="category">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <p class="category-name">{{$tagCategory->name}}</p>
                                                        </div>
                                                        <div class="col-12 col-md-6 text-right">
                                                            <a data-toggle="modal" data-target="#{{$tagCategory->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                                            <a href="{{ route('tagcategories.edit', $tagCategory->slug) }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                                            @include('partials.modals.removetagcategory')
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane pt-4" id="adminpanel" role="tabpanel" aria-labelledby="adminpanel-tab">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-admins-tab" data-toggle="pill" href="#admin" role="tab" aria-controls="v-pills-admins" aria-selected="true">Beheerders</a>
                                <a class="nav-link" id="v-pills-mail-tab" data-toggle="pill" href="#mail" role="tab" aria-controls="v-pills-mail" aria-selected="false">Mail</a>
                                <a class="nav-link" id="v-pills-homepage-tab" data-toggle="pill" href="#homepage" role="tab" aria-controls="v-pills-homepage" aria-selected="false">Homepagina</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="admins" role="tabpanel" aria-labelledby="v-pills-admins-tab">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Beheerders</h2>
                                        </div>
                                    </div>
                                    {{ Form::open(['route' => 'users.updateadmins', 'method' => 'PUT']) }}
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Naam</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Beheerder</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>{{ $user->nickname }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ Form::checkbox('admins[]', $user->id, $user->isAdmin()) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ Form::submit('Opslaan', ['class' => 'btn btn-danger btn-avans']) }}
                                    {{ Form::close() }}
                                </div>
                                <div class="tab-pane fade" id="mail" role="tabpanel" aria-labelledby="v-pills-mail-tab">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Mail</h2>
                                        </div>
                                    </div>
                                    {{ Form::open(['route' => 'settings.updatesettings', 'method' => 'PUT']) }}
                                        <div class="form-group row">
                                            {{ Form::label('conceptmailfrequence', 'Concept mailing frequentie *', ['class' => 'col-3']) }}
                                            <div class="col-9">
                                                {{ Form::select('settings[conceptmailfrequence]', [
                                                    'Monthly' => 'Elke maand', 
                                                    'Weekly' => 'Elke week',
                                                    'Daily' => 'Elke dag'
                                            ], (!empty($settings->has('conceptmailfrequence'))) ? $settings->get('conceptmailfrequence')->val : null, ['class' => 'form-control']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {{ Form::label('conceptmailday', 'Concept mailing dag *', ['class' => 'col-3']) }}
                                            <div class="col-9">
                                                {{ Form::select('settings[conceptmailday]', [
                                                    'Monday' => 'Maandag', 
                                                    'Tuesday' => 'Dinsdag',
                                                    'Wednesday' => 'Woensdag', 
                                                    'Thursday' => 'Donderdag', 
                                                    'Friday' => 'Vrijdag', 
                                                    'Saturday' => 'Zaterdag', 
                                                    'Sunday' => 'Zondag'
                                            ], (!empty($settings->has('conceptmailday'))) ? $settings->get('conceptmailday')->val : null, ['class' => 'form-control']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {{ Form::label('conceptmailtime', 'Concept mailing tijd *', ['class' => 'col-3 col-form-label']) }}
                                            <div class="col-9">
                                                <input class="form-control" type="time" value="{{ (!empty($settings->has('conceptmailtime'))) ? $settings->get('conceptmailtime')->val : '20:00:00' }}" name="settings[conceptmailtime]" id="conceptmailtime">
                                            </div>
                                        </div>

                                        {{ Form::submit('Opslaan', ['class' => 'btn btn-danger btn-avans']) }}
                                    {{ Form::close() }}
                                    <!--<a href="{{ route('sendmail') }}" class="btn btn-danger btn-avans">Verstuur de 'concept tools' mail</a>-->
                                </div>
                                <div class="tab-pane fade" id="homepage" role="tabpanel" aria-labelledby="v-pills-homepage-tab">
                                    <div class="row">
                                        <div class="col-12 pb-3">
                                            <h2>Homepagina</h2>
                                        </div>
                                    </div>
                                    {{ Form::open(['route' => 'settings.updatesettings', 'method' => 'PUT']) }}
                                        <div class="form-group row">
                                            {{ Form::label('homepagecategory', 'Featured categorie *', ['class' => 'col-3']) }}
                                            <div class="col-9">
                                                {{ Form::select('settings[homepagecategory]', $categories->pluck('name', 'slug'), (!empty($settings->has('homepagecategory'))) ? $settings->get('homepagecategory')->val : null, ['class' => 'form-control', 'placeholder' => 'Kies een categorie...']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {{ Form::label('homepagetag', 'Featured tag *', ['class' => 'col-3']) }}
                                            <div class="col-9">
                                                {{ Form::select('settings[homepagetag]', $tags->pluck('name', 'slug'), (!empty($settings->has('homepagetag'))) ? $settings->get('homepagetag')->val : null, ['class' => 'form-control', 'placeholder' => 'Kies een tag...']) }}
                                            </div>
                                        </div>

                                        {{ Form::submit('Opslaan', ['class' => 'btn btn-danger btn-avans']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="tab-pane pt-4" id="myconcepttools" role="tabpanel" aria-labelledby="myconcepttools-tab">
                    @include('partials.tools', ['tools' => $myConceptTools])
                </div>
            @endif

        </div>
    </div> 
@endsection

@section('js')
    <script type="text/javascript">
        function changedTabButtons(element) {
            $(".tab-buttons").children().each(function(e) {
                $(this).removeClass('active');
            })
            $(element + '-button').addClass('active');
        }

        // Before pill switches, change buttons and add hash to url
        $('a[data-toggle="pill"]').on("show.bs.tab", function(e) {
            changedTabButtons($(this).attr('href'));
            var hash = $(e.target).attr("href");
            history.pushState(null, null, hash);
        });

        // Before tab switches, change buttons and add hash to url
        $('a[data-toggle="tab"]').on("show.bs.tab", function(e) {
            var hash = $(e.target).attr("href");
            if(hash == "#filters"){
                changedTabButtons("#" + $('a[data-toggle="pill"].active').attr('id').replace('v-pills-','').replace('-tab', ''));
            } else {
                changedTabButtons($(this).attr('href'));
            }
            history.pushState(null, null, hash);
        });

        // On pageload check for current tab, otherwise load mytools tab
        var hash = (window.location.hash) ? window.location.hash : '#mytools';
        if(hash == "#categories" || hash == "#tags" || hash == "#tagcategories"){
            $('#tabs a[href="#filters"]').tab('show');
            $('#filters a[href="' + hash + '"').click();
        } else if(hash == "#mail" || hash == "#admins" || hash == "#homepage"){
            $('#tabs a[href="#adminpanel"]').tab('show');
            $('#adminpanel a[href="' + hash + '"').click();
        } else{
            $('#tabs a[href="' + hash + '"]').tab('show');
        }

        $(function() {
            var statuses = [];

            // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
            $('input[name="status[]"]').on('change', function (e) {
                e.preventDefault();
                statuses = []; // reset 

                $('input[name="status[]"]:checked').each(function() {
                    statuses.push($(this).val());
                });

                var urlParams = new URLSearchParams();
                if (statuses.length > 0) {
                    urlParams.append('statuses', statuses.join(","));
                }

                var url = $(location).attr('pathname') + (statuses.length > 0) ? "?" + urlParams.toString() : "";
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

        function setModal(slug, route) {
            $('.starrr.' + slug).on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type: 'GET',
                    data: { rating: value },
                }).done(function (data) {
                    $('#review-with-rating-' + slug + ' .ratingreview').starrr({
                        rating: value,
                    });
                    $('#review-with-rating-' + slug).modal('show');
                }).fail(function () {
                    alert('Rating kon niet worden geplaatst.');
                });
            });

            $('#review-with-rating-' + slug + ' .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value },
                }).done(function (data) {
                    $('.tool-rating.' + slug).empty();
                    $('.tool-rating.' + slug).append('<div class="starrr ' + slug + '"></div>');
                    $('.starrr.' + slug).starrr({
                        rating: parseInt(value)
                    });
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });
        }

        function setURLModal(slug, route) {
            $('#url-' + slug).click(function() {
                $('#review-without-rating-' + slug + ' .ratingreview').starrr();
                $('#review-without-rating-' + slug).modal('show');
            });

            $('#review-with-rating-' + slug + ' .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value },
                }).done(function (data) {
                }).fail(function () { 
                    alert('Rating kon niet geplaatst worden.');
                });
            });

            $('#review-without-rating-' + slug + ' .ratingreview').on('starrr:change', function(e, value) {
                $.ajax({
                    url : route,
                    type : 'GET',
                    data: { rating: value },
                }).done(function (data) {
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
