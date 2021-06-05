<div class="modal-dialog modal-sm mt-15" style="width:70%">
    <div class="modal-content rounded0">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h5 class="modal-title">Nouveau message</h5>
        </div>
        <div class="modal-body">
            <div class="col-md-12 pl0 pr0">
                <div class="row">
                   @include('emails.include-mail');
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="hidden rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
            <button type="button" class="hidden btn-save-paiement rounded0 btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>

