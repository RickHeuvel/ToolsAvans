@if ($tool->questions->isEmpty())
    <p>Er zijn nog geen vragen :(</p>
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
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <a data-toggle="modal" data-target="#removeQuestion{{$question->id}}Modal" class="btn btn-danger btn-avans">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        @include('partials.modals.removequestion')
                    @endif
                    <p class="question-uploaded">Geplaatst op {{ $question->created_at->format('d F Y') }} door {{ $question->user->getRole() }} {{ $question->user->nickname }}</p>
                    <p class="text">{{ $question->text }}</p>
                    <p class="answercount">{{ $question->answers->count() }} Antwoord(en)</p>
                    <hr>
                </div>
            </div>

            @foreach($question->answers as $answer)
                <div class="row">
                    <div class="col-12 col-md-11 offset-md-1">
                        <div class="answer {{ ($loop->first) ? '' : 'collapse answer-collapse-' . $question->id }}">
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
                                    @if (Auth::check() && Auth::user()->isAdmin())
                                        <a data-toggle="modal" data-target="#removeAnswer{{$answer->id}}Modal" class="btn btn-danger btn-avans">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        @include('partials.modals.removeanswer')
                                    @endif
                                    <p class="answer-uploaded">Geplaatst op {{ $answer->created_at->format('d F Y') }} door {{ $answer->user->getRole() }} {{ $answer->user->nickname }}</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 col-md-11 offset-md-1 text-center">
                    @if($loop->first && $question->answers->count() > 1)
                        <div aria-expanded="true" data-toggle="collapse" class="answer-collapse-button tag-list" href=".answer-collapse-{{$question->id}}" title="Laat meer antwoorden zien">
                            <u>Laat meer antwoorden zien({{$question->answers->count() - 1}})</u>
                            <u class="d-none">Laat minder antwoorden zien</u>
                        </div>
                        <hr>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-11 offset-md-1">
                    @if(Auth::check())
                    {{ Form::open(['route' => ['answer.store', $tool->slug, $question]] ) }}
                        <p><strong>Geef een reactie</strong></p>
                        {{ Html::ul($errors->answers->all()) }}
                        <div class="form-group">
                            {{ Form::textarea('text', Input::old('description'), ['class' => 'form-control', 'rows'=>'4', 'placeholder' => 'Typ hier je reactie...']) }}
                        </div>
                        {{ Form::submit('Reactie plaatsen', ['class' => 'btn btn-danger btn-avans float-right']) }}
                    {{ Form::close() }}
                    @else
                        <a class="text-muted" href="{{route('login')}}">Je moet inloggen om te kunnen reageren! klik hier om in te loggen.</a>
                    @endif
                </div>
            </div>
            @if (!$loop->last)
                <hr>
            @endif
        </div>
    @endforeach
@endif
<hr>
@if(Auth::check())
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
@else
    <a class="text-muted" href="{{route('login')}}">Je moet inloggen om een vraag te kunnen plaatsen, klik hier om in te loggen.</a>
 @endif
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
        $(document).ready(function(){
            $('.answer-collapse-button').click(function(){
                $(this).children().toggleClass("d-none");
            });
        });
    </script>
@endsection
