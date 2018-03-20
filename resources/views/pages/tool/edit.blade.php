@extends('layouts.master')
@section('title')
    <title>Tool wijzigen | ToolHub</title>
@endsection

@section('content')
  <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('portal') }}">Mijn Portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tool wijzigen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">            
                <h2 class="mb-0"><strong>Tool wijzigen</strong></h2>
            </div>
        </div>
        
        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($tool, array('route' => array('tools.update', $tool->slug), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}
        <div class="form-group">
            {{ Form::label('name', 'Naam van de Tool *') }}
            {{ Form::text('name', $tool->name, array('class' => 'form-control')) }}
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ Form::label('fileupload', 'Upload hier het logo van de tool *') }}
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo">
                        <label class="custom-file-label" for="customFile"></label>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to change to label of the filebrowser to the name of the uploaded file -->
        <script>
            $('.custom-file-input').on('change', function() { 
                let fileName = $(this).val().split('\\').pop(); 
                $(this).next('.custom-file-label').addClass("selected").html(fileName); 
            });
        </script>

        <div class="row">
            <div class="col">
                <div class="form-group">
                  {{ Form::label('url', 'Url *') }}
                  {{ Form::text('url', $tool->url, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('category', 'Categorie *') }}
                    <select name="category" class="custom-select">
                        @foreach ($categories as $category)
                            @if (!strcmp($tool->category->name,$category))
                                <option value="{{ $category }}" selected>{{ $category }}</option>
                            @else
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Beschrijving *') }}
            {{ Form::textarea('description', $tool->description, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload 2 tot 5 screenshots *') }}<br>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="images[]" multiple>
                <label class="custom-file-label" for="customFile"></label>
            </div>
        </div>

        <!-- Script to change to lable of the filebrowser to the name of the uploaded file -->
        <script>
            $('.custom-file-input').on('change', function() { 
                let fileName = $(this).val().split('\\').pop(); 
                $(this).next('.custom-file-label').addClass("selected").html(fileName); 
            });
        </script> 

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{route('portal')}}" class="btn btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Wijzigen', array('class' => 'btn btn-danger btn-avans')) }}
            </div>
        </div>

        {{ Form::close() }}
    </div> 
@endsection
