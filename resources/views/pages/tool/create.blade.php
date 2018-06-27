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
                <div class="row">
                    <div class="col">
                        {{ Form::label('logo', 'Logo *') }}
                    </div>
                    <div class="col">
                        <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Upload hier het logo van de tool.">?</span>
                    </div>
                </div>
                <div id="logo-uploader"class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    {{ Form::label('name', 'Naam van de Tool *') }}
                                </div>
                                <div class="col" align="right">
                                    <span class="badge badge-pill badge-light" align="right" data-toggle="tooltip" data-placement="top" title="Vul hier de naam van de tool in.">?</span>
                                </div>
                            </div>
                            {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {{ Form::label('url', 'Url *') }}
                        </div>
                        <div class="col" align="right">
                            <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Vul hier de url als volgt in http://www.website.nl">?</span>
                        </div>
                    </div>
                    {{ Form::text('url', old('url'), ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            {{ Form::label('category', 'Categorie *') }}
                        </div>
                        <div class="col" align="right">
                            <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Selecteer de categorie waar te tool bij hoort.">?</span>
                        </div>
                    </div>
                    {{ Form::select('category', $categories,old('category'),['placeholder' => 'Selecteer een categorie...','class' => 'select2 w-100']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{ Form::label('description', 'Beschrijving *') }}
                </div>
                <div class="col" align="right">
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Geef een uitgebreide beschrijving van de tool.">?</span>
                </div>
            </div>
            {{ Form::textarea('description', old('description'), ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{ Form::label('tags', 'Tags *') }}
                </div>
                <div class="col" align="right">
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Selecteer de tags die bij deze tool passen.">?</span>
                </div>
            </div>
            {{ Form::select('tag-dropdown', $tags,old('tags'),['class' => 'select2 w-100 tags-dropdown', 'multiple' => 'multiple', 'name' => 'tags[]']) }}
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{ Form::label('academies', 'Academies *') }}
                </div>
                <div class="col" align="right">
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Selecteer academies waar deze tool relevant voor is.">?</span>
                </div>
            </div>
            {{ Form::select('tag-dropdown', $academies, old('academies'), ['class' => 'select2 w-100 tags-dropdown', 'multiple' => 'multiple', 'name' => 'academies[]']) }}
        </div>

        <div class="row">
            <div class="col">
                {{ Form::label('images', 'Plaatjes * minimaal 2, maximaal 7') }}
            </div>
            <div class="col" align="right">
                <span class="badge badge-pill badge-light" data-toggle="tooltip" data-placement="top" title="Upload hier minimaal 2 en maximaal 7 afbeeldingen van de tool.">?</span>
            </div>
        </div>
        <div id="image-uploader" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{ route('portal', '#mytools') }}" class="btn btn-square btn-light">Annuleren</a>
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

@section('js-includes')
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
@endsection

@section('js')
    <script>
    /* category select2*/
    $('.select2').select2({
        theme: "bootstrap4",
        width: "resolve",
    });

    /*Dropzone*/
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
