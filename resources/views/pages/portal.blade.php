@extends('layouts.master')
@section('title')
    <title>Mijn portaal | ToolHub</title>
@endsection

@section('content')
<div class="container pt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mijn portaal</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row mb-4">
            <div class="col-12 col-md-6">            
                <h2><strong>{{auth()->user()->nickname}}</strong></h2>
            </div>
            <div class="col-12 col-md-6 text-right">
                <div class="tab-buttons">
                    <a href="{{ route('tools.create') }}" class="btn btn-danger btn-avans" id="mytools-button">Nieuwe tool toevoegen</a>
                    <a href="{{ route('categories.create') }}" class="btn btn-danger btn-avans" id="categories-button">Nieuwe categorie toevoegen</a>
                    <a href="{{ route('specifications.create') }}" class="btn btn-danger btn-avans" id="specifications-button">Nieuwe specificatie toevoegen</a>
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
                    <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categorieën</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">Specificaties</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="activetools-tab" data-toggle="tab" href="#activetools" role="tab" aria-controls="activetools" aria-selected="false">Actieve tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inactivetools-tab" data-toggle="tab" href="#inactivetools" role="tab" aria-controls="inactivetools" aria-selected="false">Inactieve tools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="judgetools-tab" data-toggle="tab" href="#judgetools" role="tab" aria-controls="judgetools" aria-selected="false">Tools keuren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="rejectedtools-tab" data-toggle="tab" href="#rejectedtools" role="tab" aria-controls="rejectedtools" aria-selected="false">Afgekeurde tools</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" id="myconcepttools-tab" data-toggle="tab" href="#myconcepttools" role="tab" aria-controls="myconcepttools" aria-selected="false">Mijn Concept tools</a>
                </li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane pt-4" id="mytools" role="tabpanel" aria-labelledby="mytools-tab">
                @if(count($myTools) > 0)
                    @include('partials.pagination', ['tools' => $myTools])
                    @include('partials.tools', ['tools' => $myTools])
                    @include('partials.pagination', ['tools' => $myTools])
                @else
                    <p>U heeft nog geen tools toegevoegd, voeg uw eerste tool toe door <a href="{{route('tools.create')}}">hier</a> te klikken!</p>
                @endif
            </div>

            @if (auth()->user()->isAdmin())
                <div class="tab-pane pt-4" id="categories" role="tabpanel" aria-labelledby="categories-tab">
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
                                            <a href="{{ URL::to('categories/' . $category->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                            @include('partials.removecategorymodal')
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

                <div class="tab-pane pt-4" id="specifications" role="tabpanel" aria-labelledby="categories-tab">
                    @foreach($specifications as $specification)
                        <div class="row">
                            <div class="col-12">
                                <div class="specification">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <p class="specification-name">{{$specification->name}}</p>
                                        </div>
                                        <div class="col-12 col-md-6 text-right">
                                            <a data-toggle="modal" data-target="#{{$specification->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                            <a href="{{ URL::to('specifications/' . $specification->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                            @include('partials.removespecificationmodal')
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
                <div class="tab-pane pt-4" id="activetools" role="tabpanel" aria-labelledby="activetools-tab">
                    @include('partials.tools', ['tools' => $activeTools])
                </div>
                <div class="tab-pane pt-4" id="inactivetools" role="tabpanel" aria-labelledby="inactivetools-tab">
                    @include('partials.tools', ['tools' => $inactiveTools])
                </div>
                <div class="tab-pane pt-4" id="judgetools" role="tabpanel" aria-labelledby="judgetools-tab">
                    @include('partials.tools', ['tools' => $unjudgedTools])
                </div>
                <div class="tab-pane pt-4" id="rejectedtools" role="tabpanel" aria-labelledby="rejectedtools-tab">
                    @include('partials.tools', ['tools' => $rejectedTools])
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

        // Before tab switches, change buttons and add hash to url
        $('a[data-toggle="tab"]').on("show.bs.tab", function(e) {
            changedTabButtons($(this).attr('href'));
            var hash = $(e.target).attr("href");
            if (history.pushState) {
                history.pushState(null, null, hash);
            } else {
                location.hash = hash;
            }
        });

        // On pageload check for current tab, otherwise load mytools tab
        var hash = (window.location.hash) ? window.location.hash : '#mytools';
        changedTabButtons(hash);
        $('#tabs a[href="' + hash + '"]').tab('show');
    </script>
@endsection
