<!-- Prospect  Section-->
<div class="col-md-6">

    <div class="row">
        <input type="hidden" value="{{$fiche->personne->id}}" name="personne_id">
        <div class="col-md-12">
            <div class="content-group border-top-lg border-top-blue">
                <div class="page-header page-header-default p0">
                    <div class="breadcrumb-line ">

                        <ul class="breadcrumb pt-10 pb-14">
                            <li class="text-bold"><i
                                        class="icon-user position-left"></i>
                                Prospect
                            </li>
                        </ul>

                        <ul class="breadcrumb-elements hidden">
                            <li>
                                <a href="#" class="legitRipple"><i
                                            class="icon-comment-discussion position-left"></i>
                                    Support
                                </a>
                            </li>
                            <li>
                                <a href="#" class="legitRipple"><i
                                            class="icon-comment-discussion position-left"></i>
                                    Support
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="page-header-content pb-20 pt-20">
                        <div class="row col-md-12 ">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Civilité </label>
                                    <select name="civilite_id" id="civilite_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($civilites as $civilite)
                                            <option @if(@$fiche->personne->civilite->id == @$civilite->id) selected
                                                    @endif value="{{$civilite->id}}">{{$civilite->valeur}}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger error-msg"
                                          id="error_civilite_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Nom </label>
                                    <input type="text" name="nom" id="nom"
                                           class="mt-m15 form-control"
                                           value="{{$fiche->personne->nom}}">
                                    <span class="text-danger error-msg"
                                          id="error_nom">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Prénom </label>
                                    <input type="text" name="prenom" id="prenom"
                                           class="mt-m15 form-control"
                                           value="{{$fiche->personne->prenom}}">
                                    <span class="text-danger error-msg"
                                          id="error_prenom">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Date
                                    </label>
                                    <input type="text" name="date_naissance"
                                           id="date_naissance"
                                           value="{{Helper::getDateFormat($fiche->personne->date_naissance)}}"
                                           class="date-picker mt-m15 form-control">
                                    <span class="text-danger error-msg"
                                          id="error_date_naissance">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Régime </label>
                                    <select name="regime_id" id="regime_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($regimes as $regime)
                                            <option @if(@$fiche->personne->regime->id == @$regime->id) selected
                                                    @endif value="{{$regime->id}} ">{{$regime->libelle}}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger error-msg"
                                          id="error_regime_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Activité </label>
                                    <input type="text" name="activite" id="activite"
                                           class="mt-m15 form-control"
                                           value="{{$fiche->personne->activite}}">
                                    <span class="text-danger error-msg"
                                          id="error_activite">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">N°
                                        Sécurité
                                        sociale </label>
                                    <input data-mask="9-99-99-99-999-999-99"
                                           type="text"
                                           name="numero_securite_sociale"
                                           id="numero_securite_sociale"
                                           class="mt-m15 form-control"
                                           value="{{$fiche->personne->numero_securite_sociale}}">

                                    <span class="text-danger error-msg"
                                          id="error_numero_securite_sociale">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Situation
                                        Familiale </label>
                                    <select name="situation_familiale_id"
                                            id="situation_familiale_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($situation_familiales as $sf)
                                            @if($fiche->personne->situationFamiliale)
                                                <option @if($fiche->personne->situationFamiliale->id == $sf->id) selected
                                                        @endif value="{{$sf->id}}">{{$sf->libelle}}</option>
                                            @else
                                                <option value="{{$sf->id}}">{{$sf->libelle}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-msg"
                                          id="error_situation_familiale_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /prospect Section-->