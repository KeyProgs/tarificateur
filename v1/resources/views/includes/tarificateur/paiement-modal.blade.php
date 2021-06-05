<div class="modal-dialog modal-sm mt-15" style="width:70%">
    <div class="modal-content rounded0">
        <div class="modal-body">
            <div class="col-md-12 pl0 pr0">
                <div class="row">
                    @php
                        $compte = $fiche->compte;
                        if(!is_null($fiche->personne->conjoint())){
                               $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
                        }else{
                               $conjoint = null;
                        }
                    @endphp
                    <form id="form_paiement">
                        @csrf
                        <input type="hidden" name="fiche_id" value="{{$fiche->id}}">
                        @if($compte != null)
                            <input type="hidden" name="compte_id" value="{{$compte->id}}">
                        @endif
                        <div class="col-md-12 modal-contenu" id="paiement-modal-body">
                            <div class="content-group border-top-lg border-top-primary">
                                <div class="page-header page-header-default">
                                    <!--section Paiement-->
                                    <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                        <a class="breadcrumb-elements-toggle"><i
                                                    class="icon-menu-open"></i></a>
                                        <ul class="breadcrumb">
                                            <li class="text-bold">
                                                <i class="icon-coins position-left"></i>
                                                Compte de paiement
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
                                            <div class="col-md-12" id="compte-paiement-div">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nom_tt" class="text-custom-grey text-bold">
                                                                Nom :
                                                            </label>
                                                            <input type="text" name="nom_tt" id="nom_tt"
                                                                   class="mt-m15 form-control"
                                                                   @if($compte!=null)
                                                                   value="{{$compte->nom}}"
                                                                    @endif >
                                                            <span class="text-danger error-msg" id="error_nom_tt">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="prenom_tt" class="text-custom-grey text-bold">Prénom</label>
                                                            <input type="text" name="prenom_tt" id="prenom_tt"
                                                                   class="mt-m15 form-control" @if($compte!=null)
                                                                   value="{{$compte->prenom}}"
                                                                    @endif>
                                                            <span class="text-danger error-msg"
                                                                  id="error_prenom_tt">
                                                              <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="tarif_code_postal"
                                                                   class="text-custom-grey text-bold">
                                                                Code Postale
                                                            </label>
                                                            <input type="text" name="code_postal_tt" id="code_postal_tt"
                                                                   class="mt-m15 form-control"
                                                                   @if($compte!=null)
                                                                   value="{{$compte->code_postal_tt}}"
                                                                    @endif>
                                                            <span class="text-danger error-msg"
                                                                  id="error_code_postal_tt">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ville_id_tt" class="text-custom-grey text-bold">
                                                                Ville
                                                            </label>
                                                            <select name="ville_id_tt" id="ville_id_tt"
                                                                    class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                @if($compte!=null && $compte->ville_tt != null )
                                                                    <option value="{{$compte->ville_id_tt}}">{{$compte->ville_tt->name}}</option>
                                                                @endif
                                                            </select>
                                                            <span class="text-danger error-msg" id="error_ville_id_tt">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="tarif_code_postal"
                                                                   class="text-custom-grey text-bold">
                                                                Adresse
                                                            </label>
                                                            <input type="text" name="adresse_tt" id="adresse_tt"
                                                                   class="mt-m15 form-control"
                                                                   @if($compte!=null)
                                                                   value="{{$compte->adresse_tt}}"
                                                                    @endif
                                                            >
                                                            <span class="text-danger error-msg"
                                                                  id="error_adresse_tt">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!--/section Paiement-->

                                    <!--section Banque-->
                                    <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                        <a class="breadcrumb-elements-toggle"><i
                                                    class="icon-menu-open"></i></a>
                                        <ul class="breadcrumb">
                                            <li class="text-bold">
                                                <i class="icon-city position-left"></i>
                                                Banque
                                            </li>
                                        </ul>

                                        <ul class="breadcrumb-elements hidden">
                                            <li class="mt-10">
                                                <button type="button" class="text-bold close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="page-header-content">
                                        <div class="row pt-15 pb-20">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="banque_nom" class="text-custom-grey text-bold">
                                                            Nom Banque :
                                                        </label>
                                                        <input type="text" name="banque_nom" id="banque_nom"
                                                               class="mt-m15 form-control"
                                                               @if($compte != null)
                                                               value="{{$compte->banque->nom}}"
                                                                @endif>
                                                        <div class="bg-grey-custom" id="banque-live-search-nom">

                                                        </div>
                                                        <span class="text-danger error-msg"
                                                              id="error_banque_nom">
                                                              <strong class="text-danger"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bic_compte"
                                                               class="text-custom-grey text-bold">BIC</label>
                                                        <input type="text" name="bic_compte" id="bic_compte"
                                                               class="mt-m15 form-control"
                                                               @if($compte != null)
                                                               value="{{$compte->bic}}"
                                                                @endif>
                                                        <span class="text-danger error-msg" id="error_bic_compte">
                                                              <strong class="text-danger"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="iban_compte"
                                                               class="text-custom-grey text-bold">IBAN</label>
                                                        <input type="text" name="iban_compte" id="iban_compte"
                                                               class="mt-m15 form-control"
                                                               @if($compte != null)
                                                               value="{{$compte->iban}}"
                                                                @endif
                                                        >
                                                        <span class="text-danger error-msg" id="error_iban_compte">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="banque_code_postal"
                                                               class="text-custom-grey text-bold">
                                                            @if($has_mode_paiement)
                                                                Mode Paiement </label>
                                                        <select name="mode_id" id="mode_id"
                                                                class="mt-m15 bootstrap-select form-control form-control-sm">
                                                            @if( $compte->devis->mode != null)
                                                                <option value="{{$compte->devis->mode->id}}">{{$compte->devis->mode->mode}}</option>
                                                            @endif
                                                        </select>
                                                        <span class="text-danger error-msg"
                                                              id="error_mode_id">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        @else
                                                            Code Postal </label>
                                                            <input type="text" name="code_postal_compte"
                                                                   id="code_postal_compte"
                                                                   class="mt-m15 form-control">
                                                            <span class="text-danger error-msg"
                                                                  id="error_code_postal_compte">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                        @endif


                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ville_id_compte" class="text-custom-grey text-bold">
                                                            Ville
                                                        </label>
                                                        <select name="ville_id_compte" id="ville_id_compte"
                                                                class="mt-m15 bootstrap-select form-control form-control-sm">
                                                            @if($compte != null && $compte->ville != null)
                                                                <option value="{{$compte->ville_id}}">{{$compte->ville->name}}</option>
                                                            @endif
                                                        </select>
                                                        <span class="text-danger error-msg" id="error_ville_id_compte">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="adresse_compte" class="text-custom-grey text-bold">
                                                            Adresse
                                                        </label>
                                                        <input type="text" name="adresse_compte" id="adresse_compte"
                                                               class="mt-m15 form-control"
                                                               @if($compte != null)
                                                               value="{{$compte->adresse}}"
                                                                @endif>
                                                        <span class="text-danger error-msg"
                                                              id="error_adresse_compte">
                                                            <strong class="text-danger"></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/section Banque-->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn-save-paiement rounded0 btn btn-primary">Enregistrer</button>
        </div>
    </div>
</div>