<div class="modal fade text-left" id="{{$tool->slug}}RequestChangesModal" tabindex="-1" role="dialog" aria-labelledby="{{$tool->slug}}RequestChangesModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Wijzigingen aanvragen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Html::ul($errors->all()) }}

                {{ Form::open(['route' => ['tools.requestToolChanges', $tool->slug]]) }}
                <form>
                    <div class="form-group">
                        {{ Form::label('feedback', 'Feedback: ') }}
                        {{ Form::textarea('feedback', '', ['class' => 'form-control']), 'rows=5' }}
                    </div>
                    <div class="modal-footer">
                        {{ Form::submit('Vraag wijzigingen aan', ['class' => 'btn btn-danger btn-avans']) }}
                        <a class="btn btn-light" data-dismiss="modal">Annuleren</a>
                    </div>
                </form>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
