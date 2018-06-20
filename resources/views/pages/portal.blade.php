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
            <div class="col-12 col-md-6 text-center text-md-left">
                <h2>
                    <strong>
                        {{ auth()->user()->nickname }}
                        @if (Auth::user()->isAdmin())
                            <span class="badge badge-secondary ml-3">Beheerder</span>
                        @endif
                    </strong>
                </h2>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right mt-4 mt-md-0">
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
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Mijn Profiel</a>
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
                <li class="nav-item">
                    <a class="nav-link" id="graphs-tab" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">Statistieken</a>
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
                    <p>U heeft nog geen tools toegevoegd, voeg uw eerste tool toe door <a href="{{route('tools.create')}}">hier</a> te klikken.</p>
                    <p>Of help de ToolHub community door tools die je al kent sterren te geven op de <a href="{{route('tools.index')}}">tools</a> pagina!</p>
                @endif
            </div>

            <div class="tab-pane pt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-academy-tab" data-toggle="pill" href="#academy" role="tab" aria-controls="v-pills-academy" aria-selected="true">Academie</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="academy" role="tabpanel" aria-labelledby="v-pills-academy">
                                {{ Form::open(['route' => 'users.updateacademy', 'method' => 'PUT']) }}
                                <div class="form-group row">
                                    {{ Form::label('useracademy', 'Jouw academie', ['class' => 'col-3']) }}
                                    <div class="col-9">
                                        {{ Form::select('useracademy', $academies->pluck('name', 'slug'),
                                        (!empty(Auth::user()->academy_slug)) ? Auth::user()->academy_slug : null,
                                    ['class' => 'select2', 'placeholder' => 'Geen academie', 'autocomplete' => 'off']) }}
                                    </div>
                                </div>
                                {{ Form::submit('Opslaan', ['class' => 'btn btn-danger btn-avans']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
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
                                                <input class="form-check-input" name="status[]" type="checkbox" value="{{$status->slug}}" id="status{{$status->slug}}" {{ in_array($status->slug, $selectedStatuses) ? "checked" : "" }}>
                                            @else
                                                <input class="form-check-input" name="status[]" type="checkbox" value="{{$status->slug}}" id="status{{$status->slug}}">
                                            @endif
                                            <label class="form-check-label" for="status{{$status->slug}}">
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
                                                <div class="row">
                                                    <h2>Categorieën</h2>
                                                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Hier kan je de beschikbare categorieën instellen.">?</span>
                                                </div>
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
                                            <div class="row">
                                                <h2>Tags</h2>
                                                <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Hier kan worden ingesteld welke tags er aan een tool toegevoegd kunnen worden">?</span>
                                            </div>
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
                                            <div class="row">
                                                <h2>Tag categorieën</h2>
                                                <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Een tag categorie is een verzameling van tags die passen in dezelfde context. De tag categorie kan bijvoorbeeld “Prijs” zijn. In de prijs categorie kunnen de tags “betaald”, “gratis” en “abonnement” staan.">?</span>
                                            </div>
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
                                <a class="nav-link active" id="v-pills-admins-tab" data-toggle="pill" href="#admins" role="tab" aria-controls="v-pills-admins" aria-selected="true">Beheerders</a>
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
                                                {{ Form::select('settings[homepagecategory]', $categories->pluck('name', 'slug'), (!empty($settings->has('homepagecategory'))) ? $settings->get('homepagecategory')->val : null, ['class' => 'select2', 'placeholder' => 'Kies een categorie...']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            {{ Form::label('homepagetag', 'Featured tag *', ['class' => 'col-3']) }}
                                            <div class="col-9">
                                                {{ Form::select('settings[homepagetag]', $tags->pluck('name', 'slug'), (!empty($settings->has('homepagetag'))) ? $settings->get('homepagetag')->val : null, ['class' => 'select2', 'placeholder' => 'Kies een tag...']) }}
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

            <div class="tab-pane pt-4" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                <div class="row pt-1">
                    <div class="col-12 col-md-3">
                        <div class="row mb-2">
                            <div class="input-group">
                                <input class="form-control" name="searchQuery" type="search" placeholder="Zoeken naar tools..." aria-label="Search">
                                <div class="input-group-append">
                                    <button id="searchButton" class="btn btn-outline-dark px-3" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="graph-tools">
                        </div>
                    </div>
                    <div id="chart" class="col-12 col-md-9 chart">
                        <div class="row">
                            <div class="col-6">
                            </div>
                            <div class="col-3 btn-group chart-type-dropdown">
                                <button id="current-chart-type" type="button" class="btn btn-outline-dark w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Lijngrafiek
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" data-chart-type="line" type="button">Lijngrafiek</button>
                                        <button class="dropdown-item" data-chart-type="bar" type="button">Staafgrafiek</button>
                                </div>
                            </div>
                            <div class="col-3 btn-group interval-dropdown">
                                <button id="current-interval" type="button" class="btn btn-outline-dark w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Deze maand
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                        <button class="dropdown-item" data-interval="year" type="button">Dit jaar</button>
                                        <button class="dropdown-item" data-interval="month" type="button">Deze maand</button>
                                </div>
                            </div>
                        </div>
                        <div id="loader-container">
                        </div>
                        <canvas id="chart-canvas" class="my-3"></canvas>
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-4">
                                <button id="alltools-button" type="button" class="btn btn-avans w-100">
                                    Bekijk alle tool statistieken
                                </button>
                            </div>
                            <div class="col-4">
                                <button id="pages-button" type="button" class="btn btn-avans w-100">
                                    Bekijk pagina statistieken
                                </button>
                            </div>
                            <div class="col-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $('.select2').select2({
            theme: "bootstrap4",
        });

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
        // Statistics/graph JS
        let loaderHTML = '<div class="mt-2 mx-auto loader"></div>';
        let chart = null;
        let chartType = 'line';
        let interval = 'month';
        let title = 'Pagina\'s';
        let mode = 'pages'
        let tool = '';
        let searchQuery = '';
        let page = '1';
        let xAxisLabel = 'Dag';
        function createChart() {
            $('#loader-container').html(loaderHTML);
            if (chart)
                chart.destroy();
            $.ajax({
                url : '{{ route('graph.getData') }}',
                data: {
                    'mode': mode,
                    'interval': interval,
                    'tool': tool
                },
                success: function (data) {
                    console.log(data);
                    let chartConfig = {
                        type: chartType,
                        data: {
                            labels: data.labels,
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Aantal"
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: xAxisLabel
                                    }
                                }]
                            },
                            title: {
                                display: true,
                                text: title,
                                fontSize: 14
                            }
                        }
                    };
                    if (mode == 'alltools' || mode == 'tool') {
                        chartConfig.data.datasets = [{
                                label: "Weergaven",
                                data: data.views,
                                fill: false,
                                borderColor: "rgb(45,176,162)",
                                backgroundColor: "rgb(45,176,162)",
                                lineTension: 0.1,
                                borderWidth: 3,
                            }, {
                                label: "Reviews",
                                data: data.reviews,
                                fill: false,
                                borderColor: "rgb(252,154,29)",
                                backgroundColor: "rgb(252,154,29)",
                                lineTension:0.1,
                                borderWidth: 3
                            }, {
                                label: "Vragen",
                                data: data.questions,
                                fill: false,
                                borderColor: "rgb(254,93,85)",
                                backgroundColor: "rgb(254,93,85)",
                                lineTension:0.1,
                                borderWidth: 3
                            }, {
                                label: "Antwoorden",
                                data: data.answers,
                                fill: false,
                                borderColor: "rgb(206,52,114)",
                                backgroundColor: "rgb(206,52,114)",
                                lineTension:0.1,
                                borderWidth: 3
                            }
                        ];
                    } else {
                        chartConfig.data.datasets = [{
                                label: "Home",
                                data: data.home,
                                fill: false,
                                borderColor: "rgb(206,52,114)",
                                backgroundColor: "rgb(206,52,114)",
                                lineTension:0.1,
                                borderWidth: 3
                            }, {
                                label: "Tools",
                                data: data.tools,
                                fill: false,
                                borderColor: "rgb(252,154,29)",
                                backgroundColor: "rgb(252,154,29)",
                                lineTension:0.1,
                                borderWidth: 3
                            }, {
                                label: "Portaal",
                                data: data.portal,
                                fill: false,
                                borderColor: "rgb(254,93,85)",
                                backgroundColor: "rgb(254,93,85)",
                                lineTension:0.1,
                                borderWidth: 3
                            }, {
                                label: "Contact",
                                data: data.contact,
                                fill: false,
                                borderColor: "rgb(206,52,114)",
                                backgroundColor: "rgb(206,52,114)",
                                lineTension:0.1,
                                borderWidth: 3
                            }
                        ];
                    }
                    $('#loader-container').html('');
                    chart = new Chart($('#chart-canvas'), chartConfig);
                },
                fail: function (textStatus, errorThrown) {
                    console.log(textStatus);
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        }
        function getTools() {
            $('.graph-tools').html(loaderHTML);

            let searchQuery = $('input[name="searchQuery"]').val();
            $.ajax({
                url : '{{ route('graph.getTools') }}',
                data: {
                    'searchQuery': searchQuery,
                    'page': page
                },
                success: function (data) {
                    $('.graph-tools').html(data);
                },
                fail: function (textStatus, errorThrown) {
                    console.log(textStatus);
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                }
            });
        }

        // Sort button clicked
        $('.interval-dropdown .dropdown-item').on('click', function (e) {
            e.preventDefault();
            interval = $(this).data('interval');
            $('#current-interval').text($(this).text());
            if (interval == 'month')
                xAxisLabel = 'Dag';
            else
                xAxisLabel = 'Maand';

            createChart();
        });
        $('.chart-type-dropdown .dropdown-item').on('click', function (e) {
            e.preventDefault();
            chartType = $(this).data('chart-type');
            $('#current-chart-type').text($(this).text());

            createChart();
        });
        $('.graph-tools').on('click', 'button', function (e) {
            e.preventDefault();
            tool = $(this).data('tool');
            title = tool;
            mode = 'tool';

            createChart();
        });
        $('#alltools-button').on('click', function (e) {
            e.preventDefault();
            tool = '';
            title = 'Alle tools';
            mode = 'alltools';

            createChart();
        });
        $('#pages-button').on('click', function (e) {
            e.preventDefault();
            tool = '';
            title = 'Pagina\'s';
            mode = 'pages';

            createChart();
        });
        // Search input field
        $('input[name="searchQuery"]').on('change', function (e) {
            e.preventDefault();

            getTools();
        });

        $('#searchButton').on('click', function (e) {
            e.preventDefault();

            getTools();
        });

        // Pagination buttons
        $('.graph-tools').on('click', '.pagination a', function(e) {
            e.preventDefault();

            paginationData = $(this).text();
            if (paginationData == '›')
                ++page;
            else if (paginationData == '‹')
                --page;
            else
                page = paginationData;

            getTools();
        });

        // Before tab switches, change buttons and add hash to url
        $('a[data-toggle="tab"]').on("show.bs.tab", function(e) {
            var hash = $(e.target).attr("href");
            if(hash == "#filters"){
                changedTabButtons("#" + $('a[data-toggle="pill"].active').attr('id').replace('v-pills-','').replace('-tab', ''));
            } else {
                changedTabButtons($(this).attr('href'));
            }
            if (hash == '#statistics' && chart == null) {
                createChart();
                getTools();
            }
            history.pushState(null, null, hash);
        });
        $( window ).on( 'hashchange', function( e ) {
            navigateToHash();
        } );

        // On pageload check for current tab, otherwise load mytools tab
        function navigateToHash() {
            let hash = (window.location.hash) ? window.location.hash : '#mytools';
            if(hash == "#categories" || hash == "#tags" || hash == "#tagcategories"){
                $('#tabs a[href="#filters"]').tab('show');
                $('#filters a[href="' + hash + '"').click();
            } else if(hash == "#mail" || hash == "#admins" || hash == "#homepage"){
                $('#tabs a[href="#adminpanel"]').tab('show');
                $('#adminpanel a[href="' + hash + '"').click();
            } else{
                $('#tabs a[href="' + hash + '"]').tab('show');
            }
            if (hash == '#statistics' && chart == null) {
                createChart();
                getTools();
            }
        }
        navigateToHash();
    </script>
@endsection
