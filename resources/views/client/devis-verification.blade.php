@extends('layouts.client')

@section('content')
    @php extract($data);@endphp


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h4><i class="icon-arrow-left52 position-left"></i> <span
                                        class="text-semibold">{{$compagnie->nom}}</span>
                                - {{$gamme->nom}}</h4>
                        </div>

                        <div class="heading-elements">
                            <a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">
                                {{$formule->nom}} : {{$devis->cotisation}} €/mois
                                <b> <i class="icon-menu7"></i></b>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">

                    <!-- Basic setup -->
                    <div class="panel panel-white rounded0">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                Souscription Contrat D'assurance :  {{$formule->nom}} : {{$devis->cotisation}} €/mois
                            </h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <form class="stepy-basic" action="#" method="post">
                            @csrf
                            <fieldset title="1">
                                <legend class="text-semibold">Client information</legend>
                                <div class="row pt-20 pb-0">
                                    <div class="page-title p0 pb-10">
                                        <div class="col-md-12">
                                            <div class="col-md-1">
                                                <h6 class="text-uppercase pt-15 text-custom-grey text-bold">
                                                    Prospect
                                                </h6>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Nom
                                                    </label>
                                                    <input type="text" name="nom" id="nom" readonly
                                                           value="{{$fiche->personne->nom}}"
                                                           class="mt-m15 form-control">
                                                    <span class="text-danger error-msg" id="error_nom">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Prénom
                                                    </label>
                                                    <input readonly type="text" name="prenom" id="prenom"
                                                           value="{{$fiche->personne->prenom}}"
                                                           class="mt-m15 form-control">
                                                    <span class="text-danger error-msg" id="error_prenom">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        N° Sécurité sociale
                                                    </label>
                                                    <input type="hidden" name="prospect_id"
                                                           value="{{$fiche->personne->id}}">
                                                    <input type="text" readonly data-mask="9-99-99-99-999-999-99"
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
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Date Naissance
                                                    </label>
                                                    <input type="text" readonly name="date_naissance"
                                                           id="date_naissance"
                                                           class="mt-m15 form-control"
                                                           value="{{$fiche->personne->date_naissance}}">
                                                    <span class="text-danger error-msg" id="error_date_naissance">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold"> Régime </label>
                                                    <input type="text" readonly name="date_naissance"
                                                           id="date_naissance"
                                                           class="mt-m15 form-control"
                                                           value="{{$fiche->personne->regime->libelle}}">
                                                    <span class="text-danger error-msg" id="error_date_naissance">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="heading-elements-toggle">
                                            <i class="icon-more"></i>
                                        </a>
                                    </div>


                                </div>
                                @php
                                    {{
                                        if(!is_null($fiche->personne->conjoint())){
                                            $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
                                        }else{
                                            $conjoint = null;
                                        }
                                        $enfants = $fiche->personne->enfants();
                                                    $enfants_counter=0;
                                     }}
                                @endphp

                                @if(!empty($conjoint))
                                    <div class="row pt-20 pb-0">
                                        <div class="page-title p0 pb-10">
                                            <div class="col-md-12">
                                                <div class="col-md-1">
                                                    <h6 class="text-uppercase pt-15 text-custom-grey text-bold">
                                                        CONJOINT
                                                    </h6>

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">
                                                            Nom
                                                        </label>
                                                        <input readonly type="text" name="nom" id="conjoint_nom"
                                                               value="{{$conjoint->nom}}"
                                                               class="mt-m15 form-control">
                                                        <span class="text-danger error-msg" id="error_conjoint_nom">
                                                          <strong class="text-danger"></strong>
                                                </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">
                                                            Prénom
                                                        </label>
                                                        <input readonly type="text" name="prenom" id="conjoint_prenom"
                                                               value="{{$conjoint->prenom}}"
                                                               class="mt-m15 form-control">
                                                        <span class="text-danger error-msg" id="error_conjoint_prenom">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">
                                                            N° Sécurité sociale
                                                        </label>
                                                        <input type="hidden" name="conjoint_id"
                                                               value="{{$conjoint->id}}">
                                                        <input type="text" readonly data-mask="9-99-99-99-999-999-99"
                                                               name="conjoint_numero_securite_sociale"
                                                               id="conjoint_numero_securite_sociale"
                                                               value="{{$conjoint->numero_securite_sociale}}"
                                                               class="mt-m15 form-control">
                                                        <span class="text-danger error-msg"
                                                              id="error_conjoint_numero_securite_sociale">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold">
                                                            Date Naissance
                                                        </label>
                                                        <input type="text" readonly name="conjoint_date_naissance"
                                                               id="conjoint_date_naissance"
                                                               class="mt-m15 form-control"
                                                               value="{{$conjoint->date_naissance}}">
                                                        <span class="text-danger error-msg"
                                                              id="error_conjoint_date_naissance">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="text-custom-grey text-bold"> Régime </label>
                                                        <input type="text" readonly name="conjoint_regime"
                                                               id="conjoint_regime"
                                                               class="mt-m15 form-control"
                                                               value="{{$conjoint->regime!=null?$conjoint->regime->libelle:''}}">
                                                        <span class="text-danger error-msg" id="error_conjoint_regime">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif



                                @if($fiche->personne->enfants()!=null)
                                    <div class="row pt-20 pb-0">
                                        <div class="page-title p0 pb-10">
                                            <div class="col-md-12">
                                                <div class="col-md-1">
                                                    <h6 class="text-uppercase pt-15 text-custom-grey text-bold">
                                                        ENFANTS
                                                    </h6>
                                                </div>
                                                <div class="col-md-4">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </fieldset>

                            <fieldset title="2">
                                <legend class="text-semibold">Récap d'offre</legend>

                                <div class="row pt-20 pb-0">
                                    <div class="page-title p0 pb-10">
                                        <div class="col-md-12">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Compagnie
                                                    </label>
                                                    <input type="text" name="nom" id="nom" readonly
                                                           value="{{$formule->gamme->compagnie->nom}}"
                                                           class="mt-m15 form-control">
                                                    <span class="text-danger error-msg" id="error_nom">
                                                      <strong class="text-danger"></strong>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Gamme
                                                    </label>
                                                    <input readonly type="text" name="prenom" id="prenom"
                                                           value="{{$formule->gamme->nom}}"
                                                           class="mt-m15 form-control">
                                                    <span class="text-danger error-msg" id="error_prenom">
                                                          <strong class="text-danger"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-custom-grey text-bold">
                                                        Formule
                                                    </label>
                                                    <input type="hidden" name="formule_id" value="{{$formule->id}}">
                                                    <input type="text" readonly name="" id=""
                                                           value="{{$formule->nom}}"
                                                           class="mt-m15 form-control">
                                                    <span class="text-danger error-msg" id="">
                                                          <strong class="text-danger"></strong>
                                                </span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                </div>
                            </fieldset>
                            @php
                                $compte = $fiche->compte;
                            @endphp
                            @if($compte!=null)
                                <fieldset title="3">
                                    <legend class="text-semibold">Details compte</legend>

                                    <div class="row" id="compte_details">


                                    </div>
                                </fieldset>
                            @endif

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i
                                        class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /basic setup -->


                    <!-- Footer -->
                    @include('includes.footer')
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

        <script type="text/javascript">
            $(document).ready(function () {
                $.ajax({
                    url: app_url + "get-paiement-infos/{{$fiche->id}}/mode_true",
                    type: "GET",
                    cache: false,
                    success: function (data) {
                        $('#compte_details').html(data);
                        $('.bootstrap-select').selectpicker('refresh');
                        $('#btn-save-paiement').remove();
                        $('.modal-footer').hide();
                        $('.modal-body').addClass("p0");
                        $('.modal-dialog').css("width", "90% !important;");
                    }
                });
            });


        </script>

    </div>
    <!-- /page container -->

@endsection

