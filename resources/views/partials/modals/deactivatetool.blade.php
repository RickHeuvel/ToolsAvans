<div class="modal fade" id="{{$route}}{{$tool->slug}}DeactivateModal" tabindex="-1" role="dialog" aria-labelledby="{{$route}}{{$tool->slug}}DeactivateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tool deactiveren</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Weet u zeker dat u de tool {{$tool->name}} wilt deactiveren?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-square btn-light" data-dismiss="modal">Annuleren</button>
                <a href="{{ route('tools.deactivate', $tool->slug) }}" class="btn btn-danger btn-avans">Deactiveren</a>
            </div>
        </div>
    </div>
</div>
