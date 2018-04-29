<div class="modal fade text-left" id="{{$id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="review">Review plaatsen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['route' => ['tools.addreview', $tool->slug]]) }}
                <div class="modal-body text-center">
                    <div class="alert alert-success mb-4" role="alert">
                        <h4 class="alert-heading">Bedankt voor je rating!</h4>
                        Zou je toevallig ook een review achter willen laten? dit zou ons als ToolHub community enorm helpen. Je kan de rating ook nog aanpassen als je wilt.
                    </div>
                    <p>Jouw rating:</p>
                    <div class="ratingreview starrr mb-4"></div>
                    <div class="form-group">
                        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Titel']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Beschrijving']) }}
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link mr-auto" data-dismiss="modal">Nee, bedankt</a>
                    {{ Form::submit('Plaatsen', ['class' => 'btn btn-danger btn-avans']) }}
                </div>       
            {{ Form::close() }}   
        </div>
    </div>
</div>
