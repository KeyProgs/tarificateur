<div class="modal-dialog modal-sm mt-15" style="width:70%">
    <div class="modal-content rounded0">
        <div class="modal-body">
            <div class="col-md-12 pl0 pr0">
                <div class="row">
                    @php
                        $resiliations = $fiche->resiliations;
                    @endphp
                    <form id="form_resiliation">
                        @csrf
                        <input type="hidden" name="fiche_id" value="{{$fiche->id}}">

                        <div class="col-md-12 modal-contenu" id="resiliation-modal-body">
                            <div class="content-group border-top-lg border-top-primary">
                                <div class="page-header page-header-default">
                                    <!--Section Resiliation-->
                                    <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                        <a class="breadcrumb-elements-toggle"><i
                                                    class="icon-menu-open"></i></a>
                                        <ul class="breadcrumb">
                                            <li class="text-bold">
                                                <i class="icon-coins position-left"></i>
                                                Résiliation informations
                                            </li>
                                        </ul>

                                        <ul class="breadcrumb-elements">
                                            <li class="mt-10">
                                                <button type="button" class="text-bold close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="page-header-content">
                                        <div class="row pt-15 pb-20">
                                            <div class="col-md-12" id="resiliation-div">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="resiliation_id"
                                                                   class="text-custom-grey text-bold">
                                                                Résiliation :
                                                            </label>
                                                            <select name="resiliation_id" id="resiliation_id"
                                                                    class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                <option value="">Nouvelle résiliation</option>
                                                                @if($resiliations != null )
                                                                    @foreach($resiliations as $resiliation)
                                                                        <option value="{{$resiliation->id}}">{{$resiliation->organisme}}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <span class="text-danger error-msg"
                                                                  id="error_resiliation_id">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="organisme_resiliation"
                                                                   class="text-custom-grey text-bold">Organisme</label>
                                                            <input type="text" name="organisme_resiliation"
                                                                   id="organisme_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_organisme_resiliation">
                                                              <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="motif"
                                                                   class="text-custom-grey text-bold">Motif</label>
                                                            <input type="text" name="motif_resiliation"
                                                                   id="motif_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_motif_resiliation">
                                                              <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date_echeance_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Date echeance
                                                            </label>
                                                            <input type="text" name="date_echeance_resiliation"
                                                                   id="date_echeance_resiliation"
                                                                   class="date-picker mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_date_echeance_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="numero_police_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Numéro police
                                                            </label>
                                                            <input type="text" name="numero_police_resiliation"
                                                                   id="numero_police_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_numero_police_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telephone_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Téléphone
                                                            </label>
                                                            <input type="text" name="telephone_resiliation"
                                                                   id="telephone_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_telephone_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="code_postal_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Code Postal
                                                            </label>
                                                            <input type="text" name="code_postal_resiliation"
                                                                   id="code_postal_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_code_postal_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ville_id_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Ville
                                                            </label>
                                                            <select name="ville_id_resiliation"
                                                                    id="ville_id_resiliation"
                                                                    class="mt-m15 bootstrap-select form-control form-control-sm">
                                                            </select>
                                                            <span class="text-danger error-msg"
                                                                  id="error_ville_id_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="adresse_resiliation"
                                                                   class="text-custom-grey text-bold">
                                                                Adresse
                                                            </label>
                                                            <input type="text" name="adresse_resiliation"
                                                                   id="adresse_resiliation"
                                                                   class="mt-m15 form-control" value="">
                                                            <span class="text-danger error-msg"
                                                                  id="error_adresse_resiliation">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!--/Section Resiliation-->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn-save-resiliation rounded0 btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>