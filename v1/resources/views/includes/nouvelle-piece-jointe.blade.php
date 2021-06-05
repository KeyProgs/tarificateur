<div id="modal_upload" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div id="modal_upload_dialog" class="modal-dialog modal-sm mt-15" style="width: 80%">
        <div class="modal-content rounded0">
            <div class="modal-body p-10">
                <div class="col-md-12">
                    <div class="row">
                        <form id="upload_form">
                            @csrf
                            <input type="hidden" name="type_id" value="id">
                            <input type="hidden" name="type" value="type">
                            <div class="col-md-12 modal-contenu" id="contrat-modal-body">
                                <div class="content-group border-top-lg border-top-primary">
                                    <div class="panel registration-form">
                                        <div class="panel-body">
                                            <div class="text-center">
                                                <div class="icon-object border-success text-success">
                                                    <i class="icon-file-text3"></i>
                                                </div>
                                                <h5 class="content-group-lg">Fichier informations
                                                    <small class="display-block hidden">All fields are required</small>
                                                </h5>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                                        Fichier
                                                        <input type="file" name="fichier" class="file-styled">
                                                        @if ($errors->has('fichier'))
                                                            <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('fichier') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group has-feedback">
                                            <textarea type="text" class="form-control" name="description" rows="5"
                                                      placeholder="Description">{{old('description')}}</textarea>
                                                        @if($errors->has('description'))
                                                            <span class="text-danger error-msg">
                                                         <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                                    </span>
                                                        @endif
                                                        <div class="form-control-feedback">
                                                            <i class="icon-file-text3 text-muted"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-right mt-20">
                                                <button type="submit"
                                                        class="rounded0 btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                                    <b><i class="icon-plus3"></i></b> Enregistrer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn-upload-file rounded0 btn btn-primary">Enregistrer Le Fichier</button>
            </div>
        </div>
    </div>
</div>
