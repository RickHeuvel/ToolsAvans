@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
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
                                            <img src="{{ route('tool.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-md-9 pl-0">
                                    <div class="tool-body">
                                        <h2>{{$tool->name}}</h2>
                                        <p>{{$tool->description}}</p>
                                        <div class="right-bottom">
                                            <a href="{{ URL::to('tools/' . $tool->slug . '/edit') }}" class="btn btn-danger btn-avans">Aanpassen</a>
                                            <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $tools->render() }}
        @else
            <p>U heeft nog geen tools toegevoegd, voeg uw eerste tool toe door <a href="{{route('tools.create')}}">hier</a> te klikken!</p>
        @endif

    </div> 
@endsection
