<div class="modal fade text-left" id="{{$id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="review">Review plaatsen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(auth()->check() && !auth()->user()->isEmployee())
                @if($tool->reviews->where('tool_slug', $tool->slug)->where('user_id', Auth::id())->count() > 0)
                    @php($review = $tool->reviews->where('tool_slug', $tool->slug)->where('user_id', Auth::id())->first())
                    {{ Form::model($review ,['route' => ['tools.review.store', $tool->slug]]) }}
                        <div class="modal-body text-center">
                            <div class="alert alert-info mb-4" role="alert">
                                <h4 class="alert-heading">Rating is aangepast!</h4>
                                {{ (!empty($review->title)) ? 'Zou je toevallig ook je review willen aanpassen? Dan kun je hieronder op de knop drukken.' : 'Zou je toevallig ook een review achter willen laten? dit zou ons als ToolHub community enorm helpen.' }}
                            </div>
                            <p>Jouw rating:</p>
                            <div class="tool-rating">
                                <div class="starrr mb-4"></div>
                            </div>
                            <div class="form-group">
                                {{ Form::text('title', $review->title, ['class' => 'form-control', 'placeholder' => 'Titel']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::textarea('description', $review->description, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Beschrijving']) }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-link mr-auto" data-dismiss="modal">Nee, bedankt</a>
                            {{ Form::submit('Aanpassen', ['class' => 'btn btn-danger btn-avans']) }}
                        </div>       
                    {{ Form::close() }} 
                @else
                    {{ Form::open(['route' => ['tools.review.store', $tool->slug]]) }}
                        <div class="modal-body text-center">
                            <div class="alert alert-success mb-4" role="alert">
                                <h4 class="alert-heading">Bedankt voor je rating!</h4>
                                Zou je toevallig ook een review achter willen laten? dit zou ons als ToolHub community enorm helpen.
                            </div>
                            <p>Jouw rating:</p>
                            <div class="tool-rating">
                                <div class="starrr mb-4"></div>
                            </div>
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
                @endif
            @else
                <div class="modal-body text-center">
                    @if($tool->teacherReviews->where('tool_slug', $tool->slug)->where('user_id', Auth::id())->count() > 0)
                        <div class="alert alert-info mb-4" role="alert">
                            <h4 class="alert-heading">Rating is aangepast!</h4>
                            Zou je toevallig ook je review willen aanpassen? Dan kun je hieronder op de knop drukken.
                        </div>
                    @else
                        <div class="alert alert-success mb-4" role="alert">
                            <h4 class="alert-heading">Bedankt voor je rating!</h4>
                            Zou je toevallig ook een review achter willen laten? dit zou ons als ToolHub community enorm helpen. Je kan de rating ook nog aanpassen als je wilt.
                        </div>
                    @endif
                    <p>Jouw rating:</p>
                    <div class="tool-rating">
                        <div class="ratingreview starrr mb-4"></div>
                    </div>
                    <br>
                    @if($tool->teacherReviews->where('tool_slug', $tool->slug)->where('user_id', Auth::id())->count() > 0)
                        <a href="{{ route('tools.teacherreview.edit', $tool->slug) }}" class="btn btn-danger btn-avans">Klik om je review te updaten</a>
                    @else
                        <a href="{{ route('tools.teacherreview.create', $tool->slug) }}" class="btn btn-danger btn-avans">Klik hier om een review toe te voegen!</a>
                    @endif
                </div>
                <div class="modal-footer"></div>
            @endif
        </div>
    </div>
</div>
