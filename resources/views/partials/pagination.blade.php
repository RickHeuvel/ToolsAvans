@if ($tools instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-12 col-md-6">
            <p>
                <strong>{{ ($tools->currentpage() - 1) * $tools->perpage() + 1 }} -
                    @if ($tools->currentpage() * $tools->perpage() > $tools->total())
                        {{ $tools->total() }}
                    @else
                        {{ $tools->currentpage() * $tools->perpage() }}
                    @endif van de {{$tools->total() }} tools
                </strong>
            </p>
        </div>
        <div class="col-12 col-md-6">
            <div class="float-right">
                {{ $tools->appends([
                        'categories' => (!empty($selectedCategories)) ? implode('+', $selectedCategories) : null, 
                        'specifications' => (!empty($selectedSpecifications)) ? implode('+', $selectedSpecifications) : null, 
                        'statuses' => (!empty($selectedStatuses)) ? implode('+', $selectedStatuses) : null,
                        'sort' => (!empty($selectedSortOptions)) ? $selectedSortOptions : null
                    ])->links() }}
            </div>
        </div>
    </div>
@endif