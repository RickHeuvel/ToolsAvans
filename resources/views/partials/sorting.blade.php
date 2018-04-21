<div class="btn-group w-100 float-right sort-dropdown">
    <button type="button" class="btn btn-outline-dark w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="{{ $sortOptions->where('active', 'true')->first()->icon }}"></i> {{ $sortOptions->where('active', 'true')->first()->name }}
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        @foreach($sortOptions->where('active', '!=' , 'true') as $sortOption)
            <button class="dropdown-item" data-sort-type="{{ $sortOption->type }}" data-sort-direction="{{ $sortOption->direction }}" type="button"><i class="{{ $sortOption->icon }}"></i> {{ $sortOption->name }}</button>
        @endforeach
    </div>
</div>