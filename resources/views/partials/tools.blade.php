<div class="row">
    <div class="col-12 col-md-6">
        <p>
            <strong>{{($tools->currentpage()-1)*$tools->perpage()+1}} - 
                @if ($tools->currentpage()*$tools->perpage() > $tools->total())
                    {{$tools->total()}}
                @else
                    {{$tools->currentpage()*$tools->perpage()}}
                @endif van de {{$tools->total()}} tools
            </strong>
        </p>
    </div>
    <div class="col-12 col-md-6">
        <div class="float-right">
            @if (!empty($selectedCategories))
                {{$tools->appends(['categories' => implode(',', $selectedCategories)])->links()}}
            @else
                {{$tools->links()}}
            @endif   
        </div>
    </div>
</div>
@foreach($tools as $tool)
    <div class="row">
        <div class="col-12">
            <div class="tool mb-4">
                <div class="row">
                    <div class="col-12 col-md-3">
                        @if (!empty($tool->logo_filename))
                            <div class="p-3">
                                <img src="{{ route('tools.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9 pl-0">
                        <div class="tool-body">
                            <h2>{{$tool->name}}</h2>
                            <p class="tool-description">{{$tool->description}}</p>
                            <div class="right-bottom">
                                <a href="{{$tool->url}}" class="btn btn-danger btn-avans">Bezoek tool</a>
                                <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Meer informatie</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach