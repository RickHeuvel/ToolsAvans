<div class="modal fade" id="{{$tool->slug}}DenyModal" tabindex="-1" role="dialog" aria-labelledby="{{$tool->slug}}DenyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$tool->slug}}DenyModalLabel">Tool verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Weet u zeker dat u de tool {{$tool->name}} wilt afkeuren?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Annuleren</button>
                <a href="{{ route('tools.rejectTool', $tool->slug) }}" class="btn btn-danger btn-avans">Afkeuren</a>
            </div>
        </div>
    </div>
</div>
