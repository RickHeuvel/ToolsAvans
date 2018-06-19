<div class="modal fade" id="{{$category->slug}}Modal" tabindex="-1" role="dialog" aria-labelledby="{{$category->slug}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$category->slug}}ModalLabel">Categorie verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($category->tools->count() > 0)
                    Op dit moment zijn er 
                    <a href="#" data-toggle="tooltip" title="" data-original-title="{{ $category->tools->pluck('name')->implode(', ') }}">
                        {{ $category->tools->count() }} tool(s)
                    </a> met deze categorie,<br>
                    deze moet u eerst een andere categorie toewijzen voordat u deze categorie kunt verwijderen.
                @else
                    Weet u zeker dat u de categorie {{ $category->name }} wilt verwijderen?
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                {{ Form::model($category, ['route' => ['categories.destroy', $category->slug], 'method' => 'DELETE']) }}
                @if($category->tools->count() > 0)
                    {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans', 'disabled' => 'disabled']) }}
                @else
                    {{ Form::submit('Verwijderen', ['class' => 'btn btn-danger btn-avans']) }}
                @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
