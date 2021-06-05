@extends('layouts.utilisateur')

@section('content')
    <script src="{{asset('js/fiches/fiche.js')}}"></script>
    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">
        @include('includes.utilisateur-sidebar')
        <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header page-header-default">
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Fiches</span> - Nouvelle fiche
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">Nouvelle fiche</li>
                        </ul>

                        <ul class="breadcrumb-elements hidden">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i>
                                    Settings
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content p0">
                    <form id="fiche_forme">
                        <!--section fiche & fiche histrorique-->
                        <div class="col-md-12">
                            <!-- section fiche informations -->
                            <div class="col-lg-9" id="fiche-div">
                            @csrf
                            <!-- Fiche Section-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="content-group border-top-lg border-top-primary">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i
                                                                class="icon-menu-open"></i></a>
                                                    <ul class="breadcrumb">
                                                        <li class="text-bold">
                                                            <i class="icon-file-empty2 position-left"></i>
                                                            Informations de la fiche
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements hidden">
                                                        <li>
                                                            <a href="#" class="legitRipple">
                                                                <i class="icon-comment-discussion position-left"></i>
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

                                                <div class="page-header-content">
                                                    <div class="row pt-15 pb-20">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Provenance </label>
                                                                <select name="provenance_id" id="provenance_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option selected value=""></option>
                                                                    @foreach($provenances as $provenance)
                                                                        <option value="{{$provenance->id}}"> {{$provenance->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger error-msg"
                                                                      id="error_provenance_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    Conseiller :
                                                                </label>
                                                                @if(Auth::user()->isRole('admin') || Auth::user()->isRole('supervisor'))
                                                                    <select name="user_id" id="user_id"
                                                                            class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                        <option selected value=""></option>
                                                                        @foreach($users as $user)
                                                                            <option value="{{$user->id}}">{{$user->nom.' '.$user->prenom}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <input type="text" disabled readonly
                                                                           name="user_fullname"
                                                                           id="user_fullname"
                                                                           class="mt-m15 form-control"
                                                                           value="{{Auth::user()->nom.' '.Auth::user()->prenom}}">

                                                                    <input type="hidden" name="user_id"
                                                                           id="user_id" class="mt-m15 form-control"
                                                                           value="{{Auth::user()->id}}">
                                                                @endif
                                                                <span class="text-danger error-msg" id="error_user_id">
                                                                    <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                               <label class="text-custom-grey text-bold">
                                                                    Date d'Effet
                                                                </label>
                                                                <input type="text" name="date_effet" id="date_effet"
                                                                       class="date-picker-empty mt-m15 form-control" >
                                                                <span class="text-danger error-msg"
                                                                      id="error_date_effet">
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
                                <!-- /fiche Section-->

                                <!-- Prospect  Section-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="content-group border-top-lg border-top-blue">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line ">

                                                    <ul class="breadcrumb pt-15 pb-15">
                                                        <li class="text-bold"><i class="icon-user position-left"></i>
                                                            Prospect
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements hidden">
                                                        <li><a href="#" class="legitRipple"><i
                                                                        class="icon-comment-discussion position-left"></i>
                                                                Support
                                                            </a>
                                                        </li>
                                                        <li><a href="#" class="legitRipple"><i
                                                                        class="icon-comment-discussion position-left"></i>
                                                                Support
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>

                                                <div class="page-header-content pb-20 pt-20">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Civilité </label>
                                                                <select name="civilite_id" id="civilite_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($civilites as $civilite)
                                                                        <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <span class="text-danger error-msg"
                                                                      id="error_civilite_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Nom </label>
                                                                <input type="text" name="nom" id="nom"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg" id="error_nom">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Prénom </label>
                                                                <input type="text" name="prenom" id="prenom"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg" id="error_prenom">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Date de
                                                                    naissance </label>
                                                                <input type="text" name="date_naissance"
                                                                       id="date_naissance"
                                                                       class="date-picker-empty mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_date_naissance">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Régime </label>
                                                                <select name="regime_id" id="regime_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($regimes as $regime)
                                                                        <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                                    @endforeach
                                                                </select>

                                                                <span class="text-danger error-msg"
                                                                      id="error_regime_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Activité </label>
                                                                <input type="text" name="activite" id="activite"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg" id="error_activite">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Situation
                                                                    Familiale </label>
                                                                <select name="situation_familiale_id"
                                                                        id="situation_familiale_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option selected="selected" value=""></option>
                                                                    @foreach($situation_familiales as $sf)
                                                                        <option value="{{$sf->id}}">{{$sf->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger error-msg"
                                                                      id="error_situation_familiale_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Sécurité
                                                                    sociale </label>
                                                                <input data-mask="9-99-99-99-999-999-99" type="text"
                                                                       name="numero_securite_sociale"
                                                                       id="numero_securite_sociale"
                                                                       class="mt-m15 form-control">

                                                                <span class="text-danger error-msg"
                                                                      id="error_numero_securite_sociale">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Affiliation
                                                                    : </label>
                                                                <input data-mask="999-999-999" type="text"
                                                                       name="numero_affiliation"
                                                                       id="numero_affiliation"
                                                                       class="mt-m15 form-control">

                                                                <span class="text-danger error-msg"
                                                                      id="error_numero_affiliation">
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
                                <!-- /prospect Section-->
                                <input type="hidden" id="has_conjoint" name="has_conjoint" value="">

                                <!-- Conjoint  Section-->
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="content-group border-top-lg border-top-blue">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line ">

                                                    <ul class="breadcrumb pt-15 pb-15">
                                                        <li class="text-bold"><i class="icon-user position-left"></i>
                                                            Conjoint
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements">
                                                        <li>
                                                            <button type="button" id="add-conjoint-section"
                                                                    class="btn btn-default btn-icon btn-rounded legitRipple mt-5">
                                                                <i class="icon-minus-circle2"></i>&nbsp;Supprimer
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="page-header-content pb-20 pt-20" style="display: none"
                                                     id="conjoint-section">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Civilité </label>
                                                                <select name="conjoint_civilite_id"
                                                                        id="conjoint_civilite_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($civilites as $civilite)
                                                                        <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_civilite_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Nom </label>
                                                                <input type="text" name="conjoint_nom" id="conjoint_nom"
                                                                       class="mt-m15 form-control">

                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_nom">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Prénom </label>
                                                                <input type="text" name="conjoint_prenom"
                                                                       id="conjoint_prenom"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_prenom">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Date de
                                                                    naissance </label>
                                                                <input type="text" name="conjoint_date_naissance"
                                                                       id="conjoint_date_naissance"
                                                                       class="date-picker-empty mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_date_naissance">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Régime </label>
                                                                <select name="conjoint_regime_id"
                                                                        id="conjoint_regime_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($regimes as $regime)
                                                                        <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_regime_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Activité </label>
                                                                <input type="text" name="conjoint_activite"
                                                                       id="conjoint_activite"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_activite">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Situation
                                                                    Familiale </label>
                                                                <select name="conjoint_situation_familiale_id"
                                                                        id="conjoint_situation_familiale_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option selected="selected" value=""></option>
                                                                    @foreach($situation_familiales as $sf)
                                                                        <option value="{{$sf->id}}">{{$sf->libelle}}</option>
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Sécurité
                                                                    sociale </label>
                                                                <input type="text" data-mask="9-99-99-99-999-999-99"
                                                                       name="conjoint_numero_securite_sociale"
                                                                       id="conjoint_numero_securite_sociale"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_situation_familiale_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Affiliation
                                                                    : </label>
                                                                <input data-mask="999-999-999" type="text"
                                                                       name="conjoint_numero_affiliation"
                                                                       id="conjoint_numero_affiliation"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_conjoint_numero_affiliation">
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
                                <!-- /conjont section-->

                                <!-- Adresse postale section & contact-->
                                <div class="row">
                                    <!-- div adresse postale -->
                                    <div class="col-md-8">
                                        <div class="content-group border-top-lg border-top-blue">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line ">

                                                    <ul class="breadcrumb pt-15 pb-15">
                                                        <li class="text-bold"><i
                                                                    class="icon-location3 position-left"></i>
                                                            Adresse postale
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements hidden">
                                                        <li>
                                                            <button type="button"
                                                                    class="btn btn-default btn-icon btn-rounded legitRipple mt-5">
                                                                <i class="icon-plus-circle2"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="page-header-content pb-20 pt-6">
                                                    <div class="row pt-15">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Adresse
                                                                    complète </label>
                                                                <input type="text" name="adresse" id="adresse"
                                                                       class="mt-m15 form-control">

                                                                <span class="text-danger error-msg" id="error_adresse">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Apt /
                                                                    Etage </label>
                                                                <input type="text" name="numero_appartement_etage"
                                                                       id="numero_appartement_etage"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_numero_appartement_etage">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Rés, Bat,
                                                                    Imm </label>
                                                                <input type="text" name="residence_immeuble_batiment"
                                                                       id="residence_immeuble_batiment"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_residence_immeuble_batiment">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° </label>
                                                                <input type="text" name="numero" id="numero"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg" id="error_numero">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">AV. / Rue /
                                                                    Lieu
                                                                    dit </label>
                                                                <input type="text" name="avenue_rue" id="avenue_rue"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_avenue_rue">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Code
                                                                    postal </label>
                                                                <input type="text" name="code_postal" id="code_postal"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_code_postal">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Ville</label>
                                                                <!--<input type="text" name="ville" id="ville"
                                                                       class="mt-m15 form-control">-->
                                                                <select name="ville_id" id="ville_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm"
                                                                        style="    padding: 8px;">
                                                                </select>
                                                                <span class="text-danger error-msg" id="error_ville_id">
                                                                      <strong class="text-danger_"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /div adresse postale-->
                                    <!--div contact-->
                                    <div class="col-md-4">
                                        <div class="content-group border-top-lg border-top-blue">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line ">

                                                    <ul class="breadcrumb pt-15 pb-15">
                                                        <li class="text-bold"><i class="icon-phone position-left"></i>
                                                            Contact
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements hidden">
                                                        <li>
                                                            <button type="button" id=""
                                                                    class="btn btn-default btn-icon btn-rounded legitRipple mt-5">
                                                                <i class="icon-plus-circle2"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="page-header-content pb-20 pt-20">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">E-mail </label>
                                                                <input type="email" m name="email" id="email"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg" id="error_email">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Téléphone
                                                                    1 </label>
                                                                <input data-mask="+33 9-99-99-99-99" type="text"
                                                                       name="telephone_1" id="telephone_1"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_telephone_1">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Téléphone
                                                                    2 </label>
                                                                <input data-mask="+33 9-99-99-99-99" type="text"
                                                                       name="telephone_2" id="telephone_2"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_telephone_2">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Téléphone
                                                                    3 </label>
                                                                <input data-mask="+33 9-99-99-99-99" type="text"
                                                                       name="telephone_3" id="telephone_3"
                                                                       class="mt-m15 form-control">
                                                                <span class="text-danger error-msg"
                                                                      id="error_telephone_3">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/div contact-->
                                </div>
                                <!-- /Adresse postale section-->
                            </div>
                            <!-- /section fiche informations-->

                            <!-- section fiche historique -->
                            <div class="col-lg-3" id="fiche_commentaire">
                                <div class="panel panel-flat border-top-lg border-top-primary">
                                    <div class="breadcrumb-line ">
                                        <span class=" breadcrumb text-bold"><i
                                                    class="icon-file-empty2 position-left"></i>Commentaire</span>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <!--<li><a data-action="reload"></a></li>-->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body p-10">
                                        <textarea class="form-control" name="commentaire" id="commentaire"></textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn-block add_fiche btn btn-primary btn-xs rounded0">
                                    <b><i class="icon-database-insert"></i></b>&nbsp;&nbsp;&nbsp;Enregistrer
                                </button>
                            </div>


                            <!-- /section fiche historique -->
                        </div>
                        <!--/section fiche & fiche historique-->

                        <!-- section Enfants-->
                        <div class="col-md-12 bg-grey-700">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="content-group border-top-lg border-top-primary">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i
                                                                class="icon-menu-open"></i></a>
                                                    <ul class="breadcrumb">
                                                        <li class="text-bold"><i class="icon-users4 position-left"></i>
                                                            Enfants
                                                        </li>
                                                    </ul>

                                                    <ul class="breadcrumb-elements">
                                                        <li>
                                                            <a id="add-enfant-section" class="legitRipple"><i
                                                                        class="icon-user-plus position-left"></i>
                                                                Ajouter
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="page-header-content">
                                                    <div class="row pt-15 pb-20">
                                                        <div class="" style="padding: 0;">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="bg-grey-300">
                                                                    <th class="width-130">Nom</th>
                                                                    <th class="width-130">Prénom</th>
                                                                    <th class="width-120">Sexe</th>
                                                                    <th>Date naissance</th>
                                                                    <th class="width-120">Ayant Droit</th>
                                                                    <th>N° Sécu social</th>
                                                                    <th class="pl-5 pr-5">Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="table_enfants_body">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="count_enfants" id="count_enfants" value="0">
                        </div>
                        <!-- /section Enfants-->
                    </form>


                <!-- Footer -->
                @include('includes.footer')
                <!-- /footer -->

                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
@endsection



