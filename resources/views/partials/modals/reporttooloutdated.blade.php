<div class="modal fade text-left" id="ReportToolOutdatedModal" tabindex="-1" role="dialog" aria-labelledby="ReportToolOutdatedModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Meld als verouderd</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Html::ul($errors->all()) }}

                {{ Form::open(['route' => ['tools.reportOutdated', $tool->slug]]) }}
                <form>
                    <div class="form-group">
                        {{ Form::label('feedback', 'Feedback: ') }}
                        {{ Form::textarea('feedback', '', ['class' => 'form-control']), 'rows=5' }}
                    </div>
                    <div class="modal-footer">
                        {{ Form::submit('Meld als verouderd', ['class' => 'btn btn-danger btn-avans']) }}
                        <a class="btn btn-square btn-light" data-dismiss="modal">Annuleren</a>
                    </div>
                </form>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
