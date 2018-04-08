<div class="modal fade text-left" id="reviewmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="review">Bedankt!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(array('url' => 'tools/' . $tool->slug . '/addreview')) }}
                <div class="modal-body">
                    <p><strong>Bedankt voor je rating!</strong></p>
                    <p>Zou je toevallig ook nog een review achter willen laten? dit zou ons als ToolHub community enorm helpen.</p>

                    <div class="form-group">
                        {{ Form::label('title', 'Titel') }}
                        {{ Form::text('title', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('review', 'Beschrijving') }}
                        {{ Form::textarea('description', '', array('class' => 'form-control', 'rows=5')) }}
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Plaatsen', array('class' => 'btn btn-danger btn-avans')) }}
                    <a class="btn btn-light" data-dismiss="modal">Annuleren</a>                  
                </div>       
            {{ Form::close() }}   
        </div>
    </div>
</div>
