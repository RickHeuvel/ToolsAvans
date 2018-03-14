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

        <div class="row">
            <div class="col-12 col-md-6">            
                <h2 class="mb-0"><strong>{{auth()->user()->nickname}}</strong></h2>
            </div>
            <div class="col-12 col-md-6 text-right">
                <a href="{{ URL::to('tools/create') }}" class="btn btn-danger btn-avans">Nieuwe tool toevoegen</a>
            </div>
        </div>
        <hr>

        @if(count($tools) > 0)
            @foreach($tools as $tool)
                <div class="row">
                    <div class="col-12">
                        <div class="tool mb-4">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    @if (!empty($tool->logo_filename))
                                        <div class="p-3">
                                            <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-md-9 pl-0">
                                    <div class="tool-body">
                                        <h2>{{$tool->name}}</h2>
                                        <p class="tool-description">{{$tool->description}}</p>
                                        <div class="right-bottom">
                                            <a data-toggle="modal" data-target="#{{$tool->slug}}Modal" class="btn btn-danger btn-avans">Verwijderen</a>
                                            <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                            <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="{{$tool->slug}}Modal" tabindex="-1" role="dialog" aria-labelledby="{{$tool->slug}}ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="{{$tool->slug}}ModalLabel">Tool verwijderen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Weet u zeker dat u de tool {{$tool->name}} wilt verwijderen?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Annuleren</button>
                                <a href="{{ URL::to('tools/' . $tool->slug . '/deactivate') }}" class="btn btn-danger btn-avans">Verwijderen</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>U heeft nog geen tools toegevoegd, voeg uw eerste tool toe door <a href="{{route('tools.create')}}">hier</a> te klikken!</p>
        @endif

    </div> 
@endsection
