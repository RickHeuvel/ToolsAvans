<div class="modal fade" id="removeQuestion{{$question->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removeQuestion{{$question->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$question->id}}ModalLabel">Vraag verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Weet u zeker dat u de vraag "{{$question->title}}" wilt verwijderen? Als u dit doet verwijdert u ook alle antwoorden die zijn gesteld op deze vraag.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($question, ['route' => ['questions.destroy', $question->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
