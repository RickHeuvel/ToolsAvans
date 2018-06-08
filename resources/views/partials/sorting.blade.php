<div class=" w-100 sort-dropdown">
    <div class="btn-group" id="sort-type">
        <button type="button" class="btn btn-outline-dark w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{
                $selectedSortType == 'views_count' 
                    ? 'Weergaven' 
                : ($selectedSortType == 'created_at' 
                    ? 'Datum' 
                : ($selectedSortType == 'name' 
                    ? 'Naam' 
                : 'Score'))
            }}
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item {{ $selectedSortType == 'views_count' ? 'active' : '' }}" data-sort-type="views_count" type="button">Weergaven</button>
            <button class="dropdown-item {{ $selectedSortType == 'created_at' ? 'active' : '' }}" data-sort-type="created_at" type="button">Datum</button>
            <button class="dropdown-item {{ $selectedSortType == 'name' ? 'active' : '' }}" data-sort-type="name" type="button">Naam</button>
            <button class="dropdown-item {{ $selectedSortType == 'rating' ? 'active' : '' }}" data-sort-type="rating" type="button">Score</button>
        </div>
    </div>
    <div class="btn-group" id="sort-direction">
        <button type="button" class="btn btn-outline-dark w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa {{ $selectedSortDirection == 'asc' ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item {{ $selectedSortDirection == 'asc' ? 'active' : '' }}" data-sort-direction="asc" type="button"><i class="fa fa-arrow-up"></i></button>
            <button class="dropdown-item {{ $selectedSortDirection == 'desc' ? 'active' : '' }}" data-sort-direction="desc" type="button"><i class="fa fa-arrow-down"></i></button>
        </div>
    </div>
</div>
