@extends('layouts.master')
@section('title')
    <title>Tool toevoegen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tool toevoegen</li>
            </ol>
        </nav>

        <hr class="mt-0">

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Tool toevoegen</strong></h2>
            </div>
        </div>

        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::open(['route' => 'tools.store', 'files' => true]) }}

        <div class="form-group">
            {{ Form::label('name', 'Naam van de Tool *') }}
            {{ Form::text('name', Input::old('name'), ['class' => 'form-control']) }}
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
        <div class="row">
            <div class="col">
                <div class="form-group">
                  {{ Form::label('url', 'Url *') }}
                  {{ Form::text('url', Input::old('url'), ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('category', 'Categorie *') }}
                    {{ Form::select('category', $categories,old('category'),['placeholder' => 'Selecteer een categorie...','class' => 'custom-select form-control']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Beschrijving *') }}
            {{ Form::textarea('description', Input::old('description'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('specifications', 'Specificaties *') }}
            @foreach($specifications as $specification)
                @if($specification->default == 1 && is_null($specification->category))
                <div class="row">
                    <div class="col specification-label">
                        <label>{{ $specification->name }}</label>
                    </div>
                    <div class="col">
                        <input class="form-control mb-2" type="text" name="specifications[{{ $specification->slug }}]">
                    </div>
                </div>
                @endif
            @endforeach
            <div id="specifications">
            </div>
            <input class="btn btn-avans mt-2" type="button" value="Voeg nog een specifcatie toe" onClick="addSpecification()">
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
                <a href="{{ route('portal') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        {{ Form::close() }}
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        function addSpecification(){
            var newdiv = document.createElement('div');
            var divid = Math.random();
            var selectid = Math.random();
            var inputid = Math.random();
            newdiv.innerHTML = "<div id='" + divid + "' class='row mb-2'><div class='col'><select id='"+ selectid + "' onChange='setInputName(" + selectid + "," + inputid + ")' class='custom-select'><option>Selecteer een specificatie</option>@foreach ($specifications as $specification)<option value='{{ $specification->slug }}'>{{ $specification->name }}</option>@endforeach</select></div><div class='col'><input id='"+ inputid+"' class='form-control' type='text'></div><div class='text-right'><a class=\"btn btn-avans\" onClick='removeSpecification(" + divid + ")'><i class='fa fa-trash'></i></a></div></div>"
            document.getElementById('specifications').appendChild(newdiv);
        }

        function setInputName(selectid, inputid){
            var specification = document.getElementById(selectid);
            var specificationValue = specification.options[specification.selectedIndex].value;
            var specificationInput = document.getElementById(inputid);
            specificationInput.setAttribute('name', 'specifications[' + specificationValue + ']');
        }

        function removeSpecification(divid){
            var element = document.getElementById(divid);
            element.parentNode.removeChild(element);
        }
     </script>
@endsection
