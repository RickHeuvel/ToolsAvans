@if (!Auth::check())
    <div class="starrr average-rating" data-toggle="tooltip" data-placement="left" title="Login om een rating achter te laten!"></div>
@elseif (empty($userReview))
    <div class="starrr average-rating" data-toggle="tooltip" data-placement="left" title="Klik op een ster om een rating achter te laten!"></div>
@elseif (!empty($userReview))
    <div class="starrr average-rating"></div>
    <div class="starrr user-rating"></div>
@else
    <div class="starrr average-rating"></div>
@endif

@section('review-js')
    <script>
        $( document ).ready(function() {
            @if(!empty($userReview))
                @if (!$tool->reviews->isEmpty())
                    $('.average-rating').starrr({
                        rating: {{ $tool->reviews->avg('rating') }},
                        readOnly: true
                    });
                    $('.average-rating').addClass('readOnly');
                @else
                    $('.average-rating').starrr({
                        readOnly: true
                    });
                    $('.average-rating').addClass('readOnly');
                @endif
                $('.user-rating').starrr({
                    rating: {{ $userReview->rating }}
                });
                setModal('.user-rating', {{ $userReview->rating }});
            @else
                @if (!$tool->reviews->isEmpty())
                    @if(Auth::check())
                        $('.average-rating').starrr({
                            rating: {{ $tool->reviews->avg('rating') }}
                        });
                        setModal('.average-rating', {{ $tool->reviews->avg('rating') }});
                    @else
                        $('.average-rating').starrr({
                            rating: {{ $tool->reviews->avg('rating') }},
                        }).click(function(){
                            location.href = '{{route("login")}}'
                        });
                    @endif
                @else
                    @if(Auth::check())
                        $('.average-rating').starrr();
                        setModal('.average-rating', 0);
                    @else
                        $('.average-rating').starrr().click(function(){
                            location.href = '{{route("login")}}'
                        });
                    @endif
                @endif
                enableTooltip();
            @endif

            function setModal(stars, defaultValue) {
                $(stars).on('starrr:change', function(e, value) {
                    $.ajax({
                        url : '{{route("tools.createrating", ["slug" => $tool->slug])}}',
                        type: 'GET',
                        data: { rating: value },
                    }).done(function (data) {
                        disableUrl();
                        $('#review-with-rating .tool-rating').empty();
                        $('#review-with-rating .tool-rating').append('<div class="starrr mb-4"></div>');
                        $('#review-with-rating .starrr').starrr({
                            rating: (value !== undefined) ? value : defaultValue,
                            readOnly: true
                        });
                        $('#review-with-rating .starrr').addClass('readOnly');
                        disableTooltip();
                        $('#review-with-rating').modal('show');
                        $(stars).parent().html(data);
                    }).fail(function () {
                        alert('Rating kon niet worden geplaatst.');
                    });
                })
            }
        });
    </script>
@endsection
@if (request()->ajax())
    @yield('review-js')
@else
    @section('js')
        @parent
        @yield('review-js')
    @endsection
@endif