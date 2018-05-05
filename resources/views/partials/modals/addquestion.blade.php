<div class="modal fade text-left" id="{{$tool->slug}}addquestion" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="question">Vraag stellen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => ['questions.store' , $tool->slug ]] ) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{ Form::label('title', 'Titel *') }}
                        {{ Form::text('title', Input::old('titel'), ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('text', 'Beschrijving *') }}
                        {{ Form::textarea('text', Input::old('description'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Plaatsen', ['class' => 'btn btn-danger btn-avans']) }}
                    <a class="btn btn-light" data-dismiss="modal">Annuleren</a>                  
                </div>       
            {{ Form::close() }}   
        </div>
    </div>
</div>
