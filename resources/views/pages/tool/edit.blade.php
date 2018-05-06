@extends('layouts.master')
@section('title')
    <title>Tool aanpassen | ToolHub</title>
@endsection

@section('content')
    <div class="container mt-4 pb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal') }}">Mijn portaal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tool aanpassen</li>
            </ol>
        </nav>

        <hr class="mt-0">
        @if ($tool->feedback != null && !$tool->feedback->fixed)
            <div class="alert alert-info" role="alert">
                @if (Auth::check() && Auth::user()->isStudent() && !$tool->feedback->fixed)
                    <h5 class="alert-heading">Je hebt feedback ontvangen op je tool</h5>
                    <p>Update de tool met de feedback verwerkt om hem opnieuw op te sturen voor keuring</p>
                    <hr>
                @endif
                <h5>Feedback:</h5>
                {{ $tool->feedback->feedback }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <h2 class="mb-0"><strong>Tool aanpassen</strong></h2>
            </div>
        </div>

        <hr>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($tool, ['route' => ['tools.update', $tool->slug], 'method' => 'PUT', 'files' => true]) }}

        <div class="row">
            <div class="col-lg-3 col-md-4">
                {{ Form::label('logo', 'Logo *') }}
                <div id="logo-uploader" class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {{ Form::label('name', 'Naam van de Tool *') }}
                    {{ Form::text('name', $tool->name, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col">
                  {{ Form::label('url', 'Url *') }}
                  {{ Form::text('url', $tool->url, ['class' => 'form-control']) }}
                </div>
                <div class="col">
                    {{ Form::label('category', 'Categorie *') }}
                    {{ Form::select('category', $categories,old('category'),['placeholder' => 'Selecteer een categorie...','class' => 'custom-select form-control']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags *') }}
            @foreach($toolTags as $toolTag)
                <div id="{{ $toolTag->tag->slug }}" class="row">
                    <div class="col tag-label">
                        <label>{{ $toolTag->tag->name }}</label>
                        <input type="hidden" value="{{ $toolTag->tag->slug }}" name="tags[]"/>
                    </div>
                    @if(!$toolTag->tag->default)
                        <a onClick="removeSpecification('{{ $toolTag->tag->slug }}')"><i class="fas fa-trash-alt"></i></a>
                    @endif
                </div>
            @endforeach
            @foreach($tags as $tag)
                @if($tag->default && !$toolTags->pluck('tag_slug')->contains($tag->slug))
                <div class="row">
                    <div class="col tag-label">
                        <label>{{ $tag->name }}</label>
                        <input type="hidden" value="{{ $tag->slug }}" name="tags[]"/>
                    </div>
                </div>
                @endif
            @endforeach
            <div id="tags">
            </div>
            <input id="addTag" class="btn btn-avans mt-2" type="button" value="Voeg nog een tag toe">
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Beschrijving *') }}
            {{ Form::textarea('description', $tool->description, ['class' => 'form-control']) }}
        </div>

        {{ Form::label('images', 'Plaatjes * minimaal 2, maximaal 7') }}
        <div id="image-uploader" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </div>

        <div class="row">
            <div class="col-6 mt-2">
                <a href="{{route('portal')}}" class="btn btn-square btn-light">Annuleren</a>
            </div>
            <div class="col-6 text-right mt-2">
                {{ Form::submit('Aanpassen', ['class' => 'btn btn-danger btn-avans']) }}
            </div>
        </div>

        <input hidden id="images" name="images" value="">
        <input hidden id="logo" name="logo" value="">

        {{ Form::close() }}
    </div>
@endsection

@section('js')
    <script>
        
        /* Tags */

        var addTagButton = document.querySelector('#addTag');
        addTagButton.addEventListener('click', function(){
            addTag();
        });

        function addTag(){
            var newdiv = document.createElement('div');
            var divid = Math.random();
            var selectid = Math.random(); 
            newdiv.innerHTML = "<div id='" + divid + "' class='row mb-2 text-right'><div class='col'><select name='tags[]' id='" + selectid + "' class='custom-select'><option value='null'>Selecteer een tag</option>@foreach ($tags as $tag)<option value='{{ $tag->slug }}'>{{ $tag->name }}</option>@endforeach</select></div><div class='col-md-2'><a class=\"btn btn-avans\" onClick='removeTag(" + divid + ")'><i class='fa fa-trash'></i></a><div>"
            document.querySelector('#tags').appendChild(newdiv);
        }

        function removeTag(divid){
            var element = document.getElementById(divid);
            element.parentNode.removeChild(element);
        }

        /* Dropzone */

        Dropzone.autoDiscover = false;

        var imgURI = '{{ route('tools.image', '') }}' + '/';
        var logo = '{{ $tool->logo_filename }}';
        var images = [];
        var imagesOriginalFilenames = [];
        @foreach($tool->images as $toolImage)
            images.push('{{ $toolImage->image_filename }}');
            imagesOriginalFilenames.push('{{ $toolImage->image_filename }}');
        @endforeach

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
            dictDefaultMessage: 'Upload hier het nieuwe logo',
            dictFallbackMessage: 'Je browser is te oud, deze zal niet optimaal werken',
            dictFileTooBig: 'Dit logo is te groot, hij mag maximaal 1,5MB zijn',
            dictInvalidFileType: 'Dit bestands type is niet ondersteund, gebruik jpeg, png, jpg of gif',
            dictResponseError: 'Er ging iets fout op de server',
            dictCancelUpload: 'Stop upload',
            dictUploadCanceled: 'Upload gestopt',
            dictRemoveFile: 'Verwijder logo',
            dictMaxFilesExceeded: 'Je mag maar 1 logo gebruiken',

            init: function() {
                var logoUploader = this;

                // accepted: true let's dropzone include the mock in the current amount of images
                // otherwise the maxFiles will not take into account the preloaded images
                var logoMock = { name: logo, size: 1000, accepted: true, dataURL: imgURI + logo };
                logoUploader.emit("addedfile", logoMock);
                logoUploader.createThumbnailFromUrl(logoMock,
                    logoUploader.options.thumbnailWidth, logoUploader.options.thumbnailHeight, logoUploader.options.thumbnailMethod,
                    true, function(thumbnail) {
                        logoUploader.emit('thumbnail', logoMock, thumbnail);
                    }
                );
                logoUploader.emit("complete", logoMock);
                logoUploader.files.push(logoMock);
            },
            success: function(file, response) {
                logo = response;
                fillHiddenInput();
            },
            removedfile: function(file) {
                if (!error) {
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
                console.log(errorMessage);
            },
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
            dictDefaultMessage: 'Upload hier de nieuwe plaatjes',
            dictFallbackMessage: 'Je browser is te oud, deze zal niet optimaal werken',
            dictFileTooBig: 'Dit plaatje is te groot, hij mag maximaal 1,5MB zijn',
            dictInvalidFileType: 'Dit bestands type is niet ondersteund, gebruik jpeg, png, jpg of gif',
            dictResponseError: 'Er ging iets fout op de server',
            dictCancelUpload: 'Stop upload',
            dictUploadCanceled: 'Upload gestopt',
            dictRemoveFile: 'Verwijder plaatje',
            dictMaxFilesExceeded: 'Je mag maximaal maar 7 plaatjes gebruiken',

            init: function() {
                var imageUploader = this;

                for (i = 0; i < images.length; i++) {
                    // accepted: true let's dropzone include the mock in the current amount of images
                    // otherwise the maxFiles will not take into account the preloaded images
                    let imageMock = { name: images[i], size: 1000, accepted: true, dataURL: imgURI + images[i] };
                    imageUploader.emit("addedfile", imageMock);
                    imageUploader.createThumbnailFromUrl(imageMock,
                        imageUploader.options.thumbnailWidth, imageUploader.options.thumbnailHeight, imageUploader.options.thumbnailMethod,
                        true, function(thumbnail) {
                            imageUploader.emit('thumbnail', imageMock, thumbnail);
                        }
                    );
                    imageUploader.emit("complete", imageMock);
                    imageUploader.files.push(imageMock);
                }
            },
            success: function(file, response) {
                images.push(response);
                imagesOriginalFilenames.push(file.name);
                fillHiddenInput();
            },
            removedfile: function(file) {
                if (!error) {
                    var index = imagesOriginalFilenames.indexOf(file.name);

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
        // Calling it once on js load so that the preloaded images get put into the hidden input
        fillHiddenInput();
     </script>
@endsection
