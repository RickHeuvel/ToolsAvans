<div class="modal fade" id="{{$tagCategory->slug}}Modal" tabindex="-1" role="dialog" aria-labelledby="{{$tagCategory->slug}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$tagCategory->slug}}ModalLabel">Tag categorie verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if(array_key_exists($tagCategory->slug, $tagCategoryGroups->toArray()) && $tagCategoryGroups[$tagCategory->slug]->count() > 0)
                    Op dit moment zijn er 
                    <a href="#" data-toggle="tooltip" title="" data-original-title="{{ $tagCategoryGroups[$tagCategory->slug]->pluck('name')->implode(', ') }}">
                        {{$tagCategoryGroups[$tagCategory->slug]->count()}} tags
                    </a> met deze categorie,<br>
                    deze moet u eerst een andere categorie toewijzen voordat u deze categorie kunt verwijderen.
                @else
                    Weet u zeker dat u de categorie {{$tagCategory->name}} wilt verwijderen?
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($tagCategory, ['route' => ['tagcategories.destroy', $tagCategory->slug], 'method' => 'DELETE']) }}
                    @if(array_key_exists($tagCategory->slug, $tagCategoryGroups->toArray()) && $tagCategoryGroups[$tagCategory->slug]->count() > 0)
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans', 'disabled' => 'disabled']) }}
                    @else
                        {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                    @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>