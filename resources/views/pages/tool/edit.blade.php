@extends('layouts.master')
@section('title')
    <title>ToolHub</title>
@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('portal') }}">Mijn Portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tool wijzigen</li>
            </ol>
        </nav>
        <h1>Tool wijzigen</h1>
        {{ Html::ul($errors->all()) }}

        {{ Form::model($tool, array('route' => array('tools.update', $tool->slug), 'method' => 'PUT','enctype' => 'multipart/form-data')) }}

               
        <div class="form-group">
            {{ Form::label('name', 'Naam van de Tool') }}
            {{ Form::text('name', $tool->name, array('class' => 'form-control')) }}
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                        {{ Form::label('fileupload', 'Upload hier het logo van de tool') }}
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="logo">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                </div>
            </div>
            <div class="col">
                {{ Form::label('status', 'Status') }}
                    <select name="status" class="custom-select">
                        @foreach ($statuses as $status)
                            @if (!strcmp($tool->status,$status))
                                <option  value="{{ $status }}" selected>{{ $status }}</option>
                            @else
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                  {{ Form::label('url', 'Url') }}
                  {{ Form::text('url', $tool->url, array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('category', 'Categorie') }}
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
                {{ Form::label('description', 'Beschrijving') }}
                {{ Form::textarea('description', $tool->description, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload hier plaatje 1 van de tool') }}
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-1">
                <label class="custom-file-label" for="customFile"></label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload hier plaatje 2 van de tool') }}
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-2">
                <label class="custom-file-label" for="customFile"></label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload hier plaatje 3 van de tool') }}
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-3">
                <label class="custom-file-label" for="customFile"></label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload hier plaatje 4 van de tool') }}
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-4">
                <label class="custom-file-label" for="customFile"></label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('fileupload', 'Upload hier plaatje 5 van de tool') }}
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-5">
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

        <a href="{{ url('portal')}}" class="btn btn" >Annuleren</a>
        {{ Form::submit('Wijzigen', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div> 
@endsection
