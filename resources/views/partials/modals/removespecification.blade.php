<div class="modal fade" id="{{$specification->slug}}Modal" tabindex="-1" role="dialog" aria-labelledby="{{$specification->slug}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$specification->slug}}ModalLabel">Specificatie verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($specificationGroups->where('specification_slug', $specification->slug)->count() > 0)
                    Op dit moment zijn er 
                    <a href="#" data-toggle="tooltip" title="" data-original-title="{{ $tools->whereIn('slug', $specificationGroups->where('specification_slug', $specification->slug)->pluck('tool_slug', $specification->tool_slug))->pluck('name')->implode(', ') }}">
                        {{$specificationGroups->where('specification_slug', $specification->slug)->count()}} tool(s)
                    </a> met deze specificatie,<br>
                    deze moet u eerst een andere specificatie toewijzen voordat u deze specificatie kunt verwijderen.
                @else
                    Weet u zeker dat u de specificatie {{$specification->name}} wilt verwijderen?
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($specification, ['route' => ['specifications.destroy', $specification->slug], 'method' => 'DELETE']) }}
                    @if($specificationGroups->where('specification_slug', $specification->slug)->count() > 0)
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans', 'disabled' => 'disabled']) }}
                    @else
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                    @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>