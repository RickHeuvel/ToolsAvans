@foreach($tools as $tool)
    <div class="row tool-graph">
        <div class="col-5 nopadding">
            @if (!empty($tool->logo_filename))
                <a href="{{ route('tools.show', $tool->slug) }}">
                    <img src="{{ route('tools.image', $tool->logo_filename) }}" class="img-fluid" />
                </a>
            @endif
        </div>
        <div class="col-7 tool-body nopadding">
            <div class="row">
                <div class="col pt-1">
                    <a class="tool-name-link" href="{{ route('tools.show', $tool->slug) }}">
                        <h6>{{ $tool->name }}</h6>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="tool-views">{{ number_format($tool->views->count()) }} weergaven</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="tool-reviews">{{ number_format($tool->reviews->count()) }} beoordelingen</p>
                </div>
            </div>
            <div class="row">
                <div class="col tool-button">
                    <button class="btn btn-avans" data-tool="{{ $tool->slug }}">Bekijk statistieken</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@if (!$tools->isEmpty())
    @include('partials.pagination')
@else
    <p>
        Geen tools gevonden :(<br>
    </p>
@endif

