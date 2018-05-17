<div class="modal fade" id="{{$tag->slug}}Modal" tabindex="-1" role="dialog" aria-labelledby="{{$tag->slug}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$tag->slug}}ModalLabel">Tag verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($tagGroups->where('slug', $tag->slug)->count() > 0)
                    Op dit moment zijn er 
                    <a href="#" data-toggle="tooltip" title="" data-original-title="{{ $allTools->whereIn('slug', $tagGroups->where('slug', $tag->slug)->pluck('slug'))->pluck('name')->implode(', ') }}">
                        {{$tagGroups->where('slug', $tag->slug)->count()}} tool(s)
                    </a> met deze tag,<br>
                    deze moet u eerst een andere tag toewijzen voordat u deze tag kunt verwijderen.
                @else
                    Weet u zeker dat u de tag {{$tag->name}} wilt verwijderen?
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($tag, ['route' => ['tags.destroy', $tag->slug], 'method' => 'DELETE']) }}
                    @if($tagGroups->where('slug', $tag->slug)->count() > 0)
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans', 'disabled' => 'disabled']) }}
                    @else
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                    @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
