@if ($tool->questions->isEmpty())
    <b>Er zijn nog geen vragen :(</b>
@else
    @foreach($questions as $question)
        <div class="question">
            <div class="row">
                <div class="col-2 col-md-1 text-center">
                    <div class="btn-group btn-group-vote" id="question-{{ $question->id }}" role="group">
                        {{ Form::button($question->upvotes->count(), ['class' => 'btn btn-secondary btn-count', 'disabled' => 'disabled'], false) }}
                        @if (Auth::check() && $question->upvotes->where('user_id', Auth::id())->count() < 1)
                            {{ Form::button('<i class="fa fa-arrow-up"></i>', ['class' => 'btn btn-secondary btn-vote upvote', 'data-url' => route('questions.upvote', $question->id), 'data-id' => 'question-' . $question->id], false) }}
                        @else
                            {{ Form::button('<i class="fa fa-arrow-up"></i>', ['class' => 'btn btn-secondary btn-vote', 'disabled' => 'disabled'], false) }}
                        @endif
                    </div>
                    @if($loop->first && $question->upvotes->count() > 0)
                        <a data-toggle="tooltip" title="Dit is de beste vraag!"><i class="fa fa-star"></i></a>
                    @endif
                </div>
                <div class="col-10 col-md-11 question-content">
                    <p class="title">{{ $question->title }}</p>
                    <p class="question-uploaded">Geplaatst op {{ $question->created_at->format('d F Y') }} door {{ $question->user->nickname }}</p>
                    <p class="text">{{ $question->text }}</p>
                    <p class="answercount">{{ $question->answers->count() }} Antwoord(en)</p>
                    <hr>
                </div>
            </div>
    
            @foreach($question->answers as $answer)
                <div class="row">
                    <div class="col-12 col-md-11 offset-md-1">
                        <div class="answer">
                            <div class="row">
                                <div class="col-2 col-md-1 text-center">
                                    <div class="btn-group btn-group-vote" id="answer-{{ $answer->id }}" role="group">
                                        {{ Form::button($answer->upvotes->count(), ['class' => 'btn btn-secondary btn-count', 'disabled' => 'disabled'], false) }}
                                        @if (Auth::check() && $answer->upvotes->where('user_id', Auth::id())->count() < 1)
                                            {{ Form::button('<i class="fa fa-arrow-up"></i>', ['class' => 'btn btn-secondary btn-vote upvote', 'data-url' => route('answers.upvote', $answer->id), 'data-id' => 'answer-' . $answer->id], false) }}
                                        @else
                                            {{ Form::button('<i class="fa fa-arrow-up"></i>', ['class' => 'btn btn-secondary btn-vote', 'disabled' => 'disabled'], false) }}
                                        @endif
                                    </div>
                                    @if($loop->first && $answer->upvotes->count() > 0)
                                        <a data-toggle="tooltip" title="Dit is het beste antwoord!"><i class="fa fa-star"></i></a>
                                    @endif
                                </div>
                                <div class="col-10 col-md-11 answer-content">
                                    <p class="text">{{ $answer->text }}</p>
                                    <p class="answer-uploaded">Geplaatst op {{ $question->created_at->format('d F Y') }} door {{ $question->user->nickname }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 col-md-11 offset-md-1">
                {{ Form::open(['route' => ['answer.store', $tool->slug, $question]] ) }}
                    <p><strong>Geef een reactie</strong></p>
                    {{ Html::ul($errors->answers->all()) }}
                    <div class="form-group">
                        {{ Form::textarea('text', Input::old('description'), ['class' => 'form-control', 'rows'=>'4', 'placeholder' => 'Typ hier je reactie...']) }}
                    </div>
                    {{ Form::submit('Reactie plaatsen', ['class' => 'btn btn-danger btn-avans float-right']) }}
                {{ Form::close() }}
                </div>
            </div>
            @if (!$loop->last)
                <hr class="mb-4">
            @endif
        </div>
    @endforeach
@endif
{{ Form::open(['route' => ['questions.store' , $tool->slug ]] ) }}
    <hr class="mt-4">
    <h3 class="mb-4">Vraag plaatsen</h3>
    {{ Html::ul($errors->questions->all()) }}
    <div class="form-group">
        {{ Form::text('title', Input::old('titel'), ['class' => 'form-control', 'placeholder' => 'Je vraag']) }}
    </div>
    <div class="form-group">
        {{ Form::textarea('text', Input::old('description'), ['class' => 'form-control', 'rows'=>'8', 'placeholder' => 'Geef wat uitleg over je vraag...']) }}
    </div>
    {{ Form::submit('Vraag plaatsen', ['class' => 'btn btn-danger btn-avans float-right']) }}
{{ Form::close() }}
@section('js')
    @parent
    <script>
        $('.btn-vote').on('click', function (e) {
            upvote($(this).data('url'), $(this).data('id'));
        });

        function upvote(url, id) {
            $.ajax({
                url : url,
                type: 'GET'
            }).done(function (data) {
                $("#" + id + " .btn-count").text(data.votes);
                $("#" + id + " .btn-vote").attr('disabled', 'disabled');
            }).fail(function () {
                alert('Upvote kon niet worden geplaatst.');
            });
        }
    </script>
@endsection
