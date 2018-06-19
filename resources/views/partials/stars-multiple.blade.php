@if (!empty($userReview))
    <div class="starrr {{$tool->slug}} average-rating"></div>
    <div class="starrr {{$tool->slug}} user-rating"></div>
@else
    <div class="starrr {{$tool->slug}} average-rating"></div>
@endif

@section('review-js-' . $tool->slug)
    <script>
        $( document ).ready(function() {
            @if(!empty($userReview))
                @if (!$tool->reviews->isEmpty())
                    $('.average-rating.{{$tool->slug}}').starrr({
                        rating: {{ $tool->reviews->avg('rating') }},
                        readOnly: true
                    });
                    $('.average-rating.{{$tool->slug}}').addClass('readOnly');
                @else
                    $('.average-rating.{{$tool->slug}}').starrr({
                        readOnly: true
                    });
                    $('.average-rating.{{$tool->slug}}').addClass('readOnly');
                @endif
                $('.user-rating.{{$tool->slug}}').starrr({
                    rating: {{ $userReview->rating }}
                });
                setModal('.user-rating', '{{$tool->slug}}', '{{route("tools.createrating", ["slug" => $tool->slug])}}', {{ $userReview->rating }});
            @else
                @if (!$tool->reviews->isEmpty())
                    @if(Auth::check())
                        $('.average-rating.{{$tool->slug}}').starrr({
                            rating: {{ $tool->reviews->avg('rating') }}
                        });
                        setModal('.average-rating', '{{$tool->slug}}', '{{route("tools.createrating", ["slug" => $tool->slug])}}', {{ $tool->reviews->avg('rating') }});
                    @else
                        $('.average-rating.{{$tool->slug}}').starrr({
                            rating: {{ $tool->reviews->avg('rating') }},
                        }).click(function() {
                            location.href = '{{route("login")}}'
                        });
                    @endif
                @else
                    @if(Auth::check())
                        $('.average-rating.{{$tool->slug}}').starrr();
                        setModal('.average-rating', '{{$tool->slug}}', '{{route("tools.createrating", ["slug" => $tool->slug])}}', 0);
                    @else
                        $('.average-rating.{{$tool->slug}}').starrr().click(function() {
                            location.href = '{{route("login")}}'
                        });
                    @endif
                @endif
            @endif
        });
    </script>
@endsection

@if (request()->ajax())
    @yield('review-js-' . $tool->slug)
@else
    @section('js')
    @parent
        @yield('review-js-' . $tool->slug)
    @endsection
@endif