<div class="modal fade" id="removeReview{{$review->id}}Modal" tabindex="-1" role="dialog" aria-labelledby="removeReview{{$review->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$review->id}}ModalLabel">Review verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Weet u zeker dat u de review "{{$review->title}}"" wilt verwijderen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($review, ['route' => ['reviews.destroy', $review->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
