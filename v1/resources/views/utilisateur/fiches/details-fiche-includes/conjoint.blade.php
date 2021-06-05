<!-- Conjoint Section-->
<div class="col-md-6">
    @php
        {{
            if(!is_null($fiche->personne->conjoint())){
                $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
            }else{
            $conjoint = null;
            }
         }}
    @endphp

    @if(!empty($conjoint))
        <input type="hidden" id="has_conjoint" name="has_conjoint" value="1">
    @else
        <input type="hidden" id="has_conjoint" name="has_conjoint" value="">
    @endif
    <div class="row">
        <input type="hidden" id="conjoint_id"
               value="{{$conjoint != null ? $conjoint->id : ''}}"

               name="conjoint_id">
        <div class="col-md-12 ">
            <div class="content-group border-top-lg border-top-blue">
                <div class="page-header page-header-default p0">
                    <div class="breadcrumb-line ">

                        <ul class="breadcrumb pt-10 pb-14">
                            <li class="text-bold"><i
                                        class="icon-user position-left"></i>
                                Conjoint
                            </li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li>
                                <button type="button" id="add-conjoint-section"
                                        @if(!empty($conjoint)) data-conjoint-id="{{$conjoint->id}}"
                                        @else data-conjoint-id="" @endif
                                        class="lowercase btn btn-sm btn-icon btn-outline-secondary btn-rounded">
                                    @if(empty($conjoint))
                                        <i class="icon-plus-circle2"></i>&nbsp;
                                        Ajouter
                                    @else
                                        <i class="icon-minus-circle2"></i>&nbsp;
                                        Supprimer
                                    @endif
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="page-header-content pb-20 pt-20"
                         @if(!$conjoint) style="display: none; @endif"
                         id="conjoint-section">
                        <div class="row col-md-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Civilité </label>

                                    <select name="conjoint_civilite_id"
                                            id="conjoint_civilite_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($civilites as $civilite)
                                            @if($conjoint)
                                                @if(!empty($conjoint->civilite))
                                                    <option @if($conjoint->civilite->id == $civilite->id) selected
                                                            @endif value="{{$civilite->id}}">{{$civilite->valeur}}</option>
                                                @else
                                                    <option value="{{$civilite->id}}">{{$civilite->valeur}}</option>
                                                @endif
                                            @else
                                                <option value="{{$civilite->id}}">{{$civilite->valeur}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_civilite_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Nom </label>
                                    <input type="text" name="conjoint_nom"
                                           id="conjoint_nom"
                                           class="mt-m15 form-control"
                                           value="@if(!empty($conjoint)) {{$conjoint->nom}} @endif">
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_nom">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Prénom </label>
                                    <input type="text" name="conjoint_prenom"
                                           id="conjoint_prenom"
                                           class="mt-m15 form-control"
                                           value="@if(!empty($conjoint)) {{$conjoint->prenom}} @endif">
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_prenom">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Date</label>
                                    <input type="text"
                                           name="conjoint_date_naissance"
                                           id="conjoint_date_naissance"
                                           class="date-picker mt-m15 form-control"
                                           @if(!empty($conjoint))
                                           value="{{Helper::getDateFormat($conjoint->date_naissance)}}">
                                    @endif
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_date_naissance">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Régime </label>
                                    <select name="conjoint_regime_id"
                                            id="conjoint_regime_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($regimes as $regime)
                                            @if(!empty($conjoint))
                                                {{$conjoint->date_naissance}}
                                                <option @if ($conjoint->regime_id == $regime->id) selected
                                                        @endif value="{{$regime->id}}">{{$regime->libelle}}</option>
                                            @else
                                                <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_regime_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Activité </label>
                                    <input type="text" name="conjoint_activite"
                                           id="conjoint_activite"
                                           class="mt-m15 form-control"
                                           value="@if(!empty($conjoint)) {{$conjoint->activite}} @endif">
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_activite">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold"> N°
                                        Sécurité
                                        sociale </label>
                                    <input type="text"
                                           data-mask="9-99-99-99-999-999-99"
                                           name="conjoint_numero_securite_sociale"
                                           id="conjoint_numero_securite_sociale"
                                           class="mt-m15 form-control"
                                           value="@if(!empty($conjoint)) {{$conjoint->numero_securite_sociale}} @endif">
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_situation_familiale_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="text-custom-grey text-bold">Situation
                                        Familiale </label>
                                    <select name="conjoint_situation_familiale_id"
                                            id="conjoint_situation_familiale_id"
                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach($situation_familiales as $sf)
                                            @if(!empty($conjoint))
                                                <option @if($conjoint->situation_familiale_id == $sf->id) selected
                                                        @endif value="{{$sf->id}}">
                                                    {{$sf->libelle}}
                                                </option>
                                            @else
                                                <option value="{{$sf->id}}">{{$sf->libelle}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-msg"
                                          id="error_conjoint_situation_familiale_id">
                                                     <strong class="text-danger"></strong>
                                               </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Conjont section-->