@extends('layouts.master')
@section('title')
    <title>Profiel aanmaken | ToolHub</title>
@endsection

@section('body-class')
Profiel aanmaken
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profiel aanmaken</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <hr class="m-0">
    
    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Welkom op ToolHub {{ Auth::user()->firstName}}, </strong></h2>
            </div>
        </div>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(['route' => 'users.storeprofile', 'method' => 'POST']) }}

         <div class="row">
             <div class="col mt-3">
                 Om jou de beste ervaring te geven willen we graag wat extra informatie van je weten. 
                 <br>Deze informatie kun je altijd later aanpassen in Mijn Portaal.
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-7">
                 {{ Form::label('useracademy', 'Academie') }}
                 {{ Form::select('useracademy', $academies->pluck('name', 'slug'),
                     (!empty($user->academy_slug)) ? $user->academy_slug : null,
                     ['class' => 'select2 w-75', 'placeholder' => 'Geen academie', 'autocomplete' => 'off']) 
                 }}
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-6 mt-2">
                 <a href='{{ $route }}' class="btn btn-square btn-light">Annuleren</a>
             </div>
             <div class="col-6 text-right mt-2">
                 {{ Form::submit('Opslaan', ['class' => 'btn btn-danger btn-avans',]) }}
             </div>
         </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js-includes')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
@endsection

@section('js')
    <script>
        $('.select2').select2({
            theme: "bootstrap4",
        });
    </script>
@endsection
 
