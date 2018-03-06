<div class="row">
    <div class="col-12 col-md-4">
        <p><strong>{{($tools->currentpage()-1)*$tools->perpage()+1}} - {{$tools->currentpage()*$tools->perpage()}} van de {{$tools->total()}} tools</strong></p>
    </div>
    <div class="col-12 col-md-8">
        @if (!empty($selectedCategories))
            {{$tools->appends(['categories' => implode(',', $selectedCategories)])->links()}}
        @else
            {{$tools->links()}}
        @endif        
    </div>
</div>
@foreach($tools as $tool)
    @if (!empty($tool->thumbnail))
        <img class="img-fluid" src="{{ route('tool.image', ['filename' => $tool->thumbnail]) }}" /><br>
    @endif
    Name: {{$tool->name}}<br>
    Category: {{$tool->category->name}}<br>
    Description: {{$tool->description}}<br>
    URL: {{$tool->url}}<br>
    Username: {{$tool->user->name}}<br>
    <a href="{{ URL::to('tools/' . $tool->id) }}">Bekijk tool</a>
    <hr>
@endforeach