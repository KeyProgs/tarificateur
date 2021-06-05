@php
    {{
        $formule = null;
        if(!is_null($fiche->personne->conjoint())){
            $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
        }else{
            $conjoint = null;
        }
     }}
@endphp
<div class="modal-content rounded0">
    <div class="modal-body p-10">
        <div class="col-md-12">
            <div class="row">
                <form id="contrat_form">
                    @csrf
                    <input type="hidden" name="fiche_id" id="fiche_id" value="{{$fiche->id}}">

                    @if($formule_id != null)
                        <input type="hidden" name="formule_id" value="{{$formule_id}}">
                        @php
                        $formule = \App\Formule::find($formule_id);
                        @endphp
                        <input type="hidden" name="compagnie_id" value="{{$formule->gamme->compagnie->id}}">
                        <input type="hidden" name="gamme_id" value="{{$formule->gamme->id}}">
                    @endif
                    @if($has_check_etat != "true")
                        @if($devis != null)
                            <input type="hidden" name="devis_id" value="{{$devis->id}}">
                        @endif
                    @endif


                    <div class="col-md-12 modal-contenu" id="contrat-modal-body">
                        <div class="content-group border-top-lg border-top-primary">
                            <div class="page-header page-header-default">
                                <!--section prospect & conjoint & enfants-->
                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle">
                                        <i class="icon-menu-open"></i></a>
                                    <ul class="breadcrumb formule-breadcrumb">
                                        @if($has_check_etat == "true")
                                            @include('includes.tarificateur.compagnie-gamme-formule')


                                        @endif
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
                                    <div class="row pt-20 pb-0">
                                        <div class="page-title p0 pb-10">
                                            <div class="col-md-12">
                                                <div class="col-md-8">
                                                    @if($has_check_etat === "true")
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="text-custom-grey text-bold">
                                                                        N° Contrat
                                                                    </label>

                                                                    <input type="text"
                                                                           name="numero_contrat"
                                                                           id="numero_contrat" value=""
                                                                           class="mt-m15 form-control">
                                                                    <span class="text-danger error-msg"
                                                                          id="error_numero_contrat">
                                                          <strong class="text-danger"></strong>
                                                             </span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="text-custom-grey text-bold">
                                                                        Cotisation
                                                                    </label>

                                                                    <input type="text" name="cotisation" id="cotisation"
                                                                           value=""
                                                                           class="mt-m15 form-control">
                                                                    <span class="text-danger error-msg"
                                                                          id="error_cotisation">
                                                                      <strong class="text-danger"></strong>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mt-10">
                                                                <i class="icon-user position-left"></i>
                                                                <span class="text-semibold">{{$fiche->personne->nom." ".$fiche->personne->prenom}}
                                                                    &nbsp;({{\Carbon\Carbon::parse($fiche->personne->date_naissance)->diff(\Carbon\Carbon::now())->format("%y ans")}}
                                                                    )
                                                            </span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    N° Sécurité sociale
                                                                </label>
                                                                <input type="hidden" name="prospect_id"
                                                                       value="{{$fiche->personne->id}}">
                                                                <input type="text" data-mask="9-99-99-99-999-999-99"
                                                                       name="tarif_numero_securite_sociale"
                                                                       id="tarif_numero_securite_sociale"
                                                                       value="{{$fiche->personne->numero_securite_sociale}}"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_tarif_numero_securite_sociale">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($conjoint))
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="mt-10">
                                                                    <i class="icon-user position-left"></i>
                                                                    <span class="text-semibold">{{$conjoint->nom." ".$conjoint->prenom}}
                                                                        &nbsp;({{\Carbon\Carbon::parse($conjoint->date_naissance)->diff(\Carbon\Carbon::now())->format("%y ans")}}
                                                                        )
                                                                </span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="text-custom-grey text-bold">
                                                                        N° Sécurité sociale conjoint
                                                                    </label>
                                                                    <input type="hidden" name="conjoint_id"
                                                                           value="{{$conjoint->id}}">
                                                                    <input type="text"
                                                                           data-mask="9-99-99-99-999-999-99"
                                                                           name="tarif_numero_securite_sociale_conjoint"
                                                                           id="tarif_numero_securite_sociale_conjoint"
                                                                           class="mt-m15 form-control"
                                                                           value="{{$conjoint->numero_securite_sociale}}">
                                                                    <span class="text-danger error-msg"
                                                                          id="error_date_effet">
                                                                          <strong class="text-danger"></strong>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @php
                                                        $enfants = $fiche->personne->enfants();
                                                        $enfants_counter=0;
                                                    @endphp
                                                    @if($fiche->personne->enfants()!=null)
                                                        @foreach($enfants as $enfant)
                                                            @php
                                                                $enfants_counter++;
                                                            @endphp
                                                            <div class="form-group">
                                                                <label>Enfant {{$enfants_counter}} : Ayant droit
                                                                    <b>{{ucfirst($enfant->ayant_droit)}}</b>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                        </div>


                                    </div>
                                </div>
                                <!--/section prospect & conjoint & enfants-->

                                <!--section Compte Paiement-->
                                <div class="breadcrumb-line" style="border-bottom: 1px solid lightgray;">
                                    <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                                    <ul class="breadcrumb">
                                        <li class="text-bold">
                                            <i class="icon-coins position-left"></i>
                                            Paiement (
                                            @if($fiche->compte != null)
                                                <b class="paiement-banque-nom-section"> {{$fiche->compte->banque->nom}} </b>
                                            @endif
                                            )
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
                                        <div class="col-md-12" id="">
                                            <div class="col-md-2 p0">

                                                <b>Mode de paiement</b><select name="mode_id" id="mode_id"
                                                                               class="form-control">
                                                    @foreach($modes_paiement as $mode)
                                                        <option value="{{$mode->id}}">{{$mode->mode}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error-msg" id="mode_id">
                                                              <strong class="text-danger"></strong>
                                                    </span>

                                            </div>
                                            <div class="col-md-2">
                                                <b class="paiement-compte-Prelevement">
                                                    Date prélévement <select name="date_prelevement"
                                                                             id="date_prelevement"
                                                                             class="form-control">
                                                        @php $Prelevements=array(1,5,10); @endphp
                                                        @foreach($Prelevements as $prelevement)
                                                            <option value="{{$prelevement}}">{{$prelevement}}</option>
                                                        @endforeach
                                                    </select>
                                                </b>
                                            </div>
                                            <div class="col-md-4">
                                                @if($fiche->compte != null)
                                                    <b class="paiement-compte-infos">{{$fiche->compte->nom." ".$fiche->compte->prenom}} </b>
                                                    --
                                                @endif
                                                <b class="paiement-compte-iban">
                                                    @if($fiche->compte != null)
                                                        {{$fiche->compte->iban}}
                                                    @endif
                                                </b>
                                            </div>
                                            <div class="col-md-3">
                                                @if($fiche->compte != null)
                                                    <b class="paiement-banque-nom-section"> {{$fiche->compte->banque->nom}} </b>
                                                @endif
                                            </div>

                                            <div class="col-md-1">
                                                <i id="update-paiement-infos" title="Modifier"
                                                   class="cursor-pointer text-warning-600 icon-pencil3"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--/section Compte Paiement-->

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="rounded0 btn btn-link" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn-save-devis rounded0 btn btn-primary">Enregistrer</button>
        <button type="button" class="btn-save-send-devis rounded0 btn btn-primary">Enregistrer et envoyer</button>
    </div>
</div>