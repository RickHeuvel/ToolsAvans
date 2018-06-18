<div class="modal fade" id="removeAnswer{{$answer->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removeAnswer{{$answer->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$answer->id}}ModalLabel">Antwoord verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Weet u zeker dat u het antwoord "{{$answer->text}}" wilt verwijderen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($answer, ['route' => ['answers.destroy', $answer->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
