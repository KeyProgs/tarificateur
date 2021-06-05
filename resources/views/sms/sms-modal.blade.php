<div id="modal_sms" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm mt-15" style="width:50%">
        <div class="modal-content rounded0">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Envoyer un sms</h5>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>N° Téléphone : </label>
                            <input type="text" name="numero_sms" id="numero_sms" placeholder="N° Téléphone"
                                   class="form-control" value="{{$fiche->personne->details->telephone_1}}">
                        </div>
                    </div>
                    <div class="row pt-20">
                        <div class="col-sm-12">
                            <label>Message : </label>
                            <textarea rows="6" type="text" name="message_sms" id="numero_sms" placeholder="Message"
                                      class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn-send-sms rounded0 btn btn-primary">Envoyer</button>
            </div>
        </div>
    </div>
</div>


