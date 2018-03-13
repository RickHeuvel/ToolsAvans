<div class="row">
    <div class="col-12 col-md-6">
        <p><strong>{{($tools->currentpage()-1)*$tools->perpage()+1}} - {{$tools->currentpage()*$tools->perpage()}} van de {{$tools->total()}} tools</strong></p>
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
                                <img src="{{ route('tool.image', ['filename' => $tool->logo_filename]) }}" class="img-fluid" />
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-9 pl-0">
                        <div class="tool-body">
                            <h2>{{$tool->name}}</h2>
                            <p>{{$tool->description}}</p>
                            <div class="right-bottom">
                                <a href="{{ URL::to('tools/' . $tool->slug) }}" class="btn btn-danger btn-avans">Bekijken</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach