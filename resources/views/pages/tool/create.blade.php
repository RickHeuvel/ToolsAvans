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

        {{ Form::open(['route' => 'tools.store', 'files' => true, 'id' => 'create-tool']) }}

        <div class="row">
            <div class="col-lg-3 col-md-4">
                {{ Form::label('logo', 'Logo *') }}
                <div id="logo-uploader"class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="form-group">
                    {{ Form::label('name', 'Naam van de Tool *') }}
                    {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ Form::label('url', 'Url *') }}
                    {{ Form::text('url', old('url'), ['class' => 'form-control']) }}
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
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
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

        {{ Form::label('images', 'Plaatjes * minimaal 2, maximaal 7') }}
        <div id="image-uploader" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal') }}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Toevoegen', ['class' => 'btn btn-danger btn-avans', 'id' => 'submit-all']) }}
            </div>
        </div>

        <input hidden id="images" name="images" value="">
        <input hidden id="logo" name="logo" value="">

        {{ Form::close() }}
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        /* specifications */
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

    Dropzone.autoDiscover = false;

    var logo = '';
    var images = [];
    var imagesOriginalFilenames = [];

    // The only way to remove an thumbnail from dropzone when it errored is to call click on the removeLink of the file
    // This will trigger the removedfile event.
    // But when you do not want to do the stuff that's done when removing an uploaded image we need to bypass that block of code
    // I found keeping a bool of wether the remove was triggered by error to be probably the only and easiest solution
    var error = false;

    $('div#logo-uploader').dropzone({
        url: '{{ route('tools.uploadImage') }}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        addRemoveLinks: true,
        parallelUploads: 1,
        paramName: 'image',
        maxFiles: 1,
        maxFilesize: 1.5,
        acceptedFiles: '.jpeg,.png,.jpg,.gif',
        dictDefaultMessage: 'Upload hier het logo',
        dictFallbackMessage: 'Je browser is te oud, deze zal niet optimaal werken',
        dictFileTooBig: 'Dit logo is te groot, hij mag maximaal 1,5MB zijn',
        dictInvalidFileType: 'Dit bestands type is niet ondersteund, gebruik jpeg, png, jpg of gif',
        dictResponseError: 'Er ging iets fout op de server',
        dictCancelUpload: 'Stop upload',
        dictUploadCanceled: 'Upload gestopt',
        dictRemoveFile: 'Verwijder logo',
        dictMaxFilesExceeded: 'Je mag maar 1 logo gebruiken',


        success: function(file, response) {
            logo = response;
            fillHiddenInput();
        },
        removedfile: function(file) {
            if (!error) {
                removeFileFromServer(logo);
                logo = '';
                fillHiddenInput();
            }

            error = false;
            // Removing the thumbnail, dropzone doesn't do this for you
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        error: function(file, errorMessage) {
            error = true;
            file._removeLink.click();
            alert(errorMessage);
            console.log(errorMessage);        },
    });

    $('div#image-uploader').dropzone({
        url: '{{ route('tools.uploadImage') }}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        addRemoveLinks: true,
        parallelUploads: 8,
        paramName: 'image',
        maxFiles: 7,
        maxFilesize: 1.5,
        acceptedFiles: '.jpeg,.png,.jpg,.gif',
        dictDefaultMessage: 'Upload hier de plaatjes',
        dictFallbackMessage: 'Je browser is te oud, deze zal niet optimaal werken',
        dictFileTooBig: 'Dit plaatje is te groot, hij mag maximaal 1,5MB zijn',
        dictInvalidFileType: 'Dit bestands type is niet ondersteund, gebruik jpeg, png, jpg of gif',
        dictResponseError: 'Er ging iets fout op de server',
        dictCancelUpload: 'Stop upload',
        dictUploadCanceled: 'Upload gestopt',
        dictRemoveFile: 'Verwijder plaatje',
        dictMaxFilesExceeded: 'Je mag maximaal maar 7 plaatjes gebruiken',

        success: function(file, response) {
            images.push(response);
            imagesOriginalFilenames.push(file.name);
            fillHiddenInput();
        },
        removedfile: function(file) {
            if (!error) {
                var index = imagesOriginalFilenames.indexOf(file.name);
                removeFileFromServer(images[index]);

                images.splice(index, 1);
                imagesOriginalFilenames.splice(index, 1);
                fillHiddenInput();
            }

            error = false;
            // Removing the thumbnail, dropzone doesn't do this for you
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        error: function(file, errorMessage) {
            error = true;
            file._removeLink.click();
            alert(errorMessage);
            console.log(errorMessage);
        },
    });

    function fillHiddenInput() {
        $('#images').val(JSON.stringify(images));
        $('#logo').val(logo);
    }
    function removeFileFromServer(filename) {
        $.ajax({
                type: 'post',
                url: '{{ route('tools.removeImage') }}',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    filename: filename
                },
                error: function(response) {
                    console.log(response);
                }
        });
    }
    </script>
@endsection
