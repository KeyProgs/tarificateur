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
                <div class="page-header page-header-default ">
                    <div class="page-header-content hidden">
                        <div class="page-title">
                            <h4>
                                <i class="icon-files-empty position-left"></i>
                                <span class="text-semibold">Details Fiche

                                </span>

                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="index.html"><i class="icon-home2 position-left"></i> Accueil </a></li>
                            <li class="active">Fiche Details</li>
                        </ul>

                        <ul class="breadcrumb-elements">
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
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    <span class="text-semibold"> {{ Session::get('message') }} .</span>
                                </div>
                        @endif
                        <!--Section fiche informations -->
                            <div class="col-lg-9" id="fiche-div">
                            @csrf
                            <!-- Fiche Section-->
                                <div class="row">
                                    <input type="hidden" id="fiche_id" value="{{$fiche->id}}" name="fiche_id">
                                    <input type="hidden" id="simulation_id" value="{{$fiche->simulation->id}}"
                                           name="simulation_id">
                                    <div class="col-md-12">
                                        <div class="content-group border-top-lg border-top-primary">
                                            <div class="page-header page-header-default">
                                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i
                                                                class="icon-menu-open"></i></a>
                                                    <ul class="breadcrumb">
                                                        <li class="text-bold"><i
                                                                    class="icon-file-empty2 position-left"></i>
                                                            Informations de la fiche
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

                                                <div class="page-header-content">
                                                    <div class="row pt-15 pb-20">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Provenance </label>
                                                                <select name="provenance_id" id="provenance_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($provenances as $provenance)
                                                                        <option @if($fiche->provenance->id == $provenance->id) selected
                                                                                @endif value="{{$provenance->id}}"> {{$provenance->libelle}}</option>
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
                                                                <label class="text-custom-grey text-bold">Conseillerrr
                                                                    : </label>
                                                                <select name="user_id" id="user_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($users as $user)
                                                                        <option @if($fiche->user_id == $user->id) selected
                                                                                @endif value="{{$user->id}}">{{$user->nom.' '.$user->prenom}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <span class="text-danger error-msg" id="error_user_id">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    Date d'effet
                                                                </label>
                                                                <input type="text" name="date_effet" id="date_effet"
                                                                       class="date-picker mt-m15 form-control"
                                                                       value="{{$fiche->simulation->date_effet}}">
                                                                <span class="text-danger error-msg" id="error_date_effet">
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
                                    <input type="hidden" value="{{$fiche->personne->id}}" name="personne_id">
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
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Civilité </label>
                                                                <select name="civilite_id" id="civilite_id"
                                                                        class="mt-m15 bootstrap-select form-control form-control-sm">
                                                                    <option value=""></option>
                                                                    @foreach($civilites as $civilite)
                                                                        <option @if($fiche->personne->civilite->id == $civilite->id) selected
                                                                                @endif value="{{$civilite->id}}">{{$civilite->libelle}}</option>
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->nom}}">
                                                                <span class="text-danger error-msg" id="error_nom">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Prénom </label>
                                                                <input type="text" name="prenom" id="prenom"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->prenom}}">
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
                                                                <input type="date" name="date_naissance"
                                                                       id="date_naissance"
                                                                       value="{{$fiche->personne->date_naissance}}"
                                                                       class="mt-m15 form-control">
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
                                                                        <option @if($fiche->personne->regime->id == $regime->id) selected
                                                                                @endif value="{{$regime->id}} ">{{$regime->libelle}}</option>
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->activite}}">
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

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Sécurité
                                                                    sociale </label>
                                                                <input data-mask="9-99-99-99-999-999-99" type="text"
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


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Affiliation
                                                                    : </label>
                                                                <input data-mask="999-999-999" type="text"
                                                                       name="numero_affiliation"
                                                                       id="numero_affiliation"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->numero_affiliation}}">

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
                                @php
                                    {{
                                        if(!empty($fiche->personne->conjoint())){
                                            $conjoint = \App\Personne::find($fiche->personne->conjoint()[0]->id);
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
                            <!-- Conjoint Section-->
                                <div class="row">
                                    <input type="hidden" id="conjoint_id"
                                           value="@if(!empty($conjoint)) {{$conjoint->id}} @endif" name="conjoint_id">
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
                                                                    @if(!empty($conjoint)) data-conjoint-id="{{$conjoint->id}}"
                                                                    @else data-conjoint-id="" @endif
                                                                    class="lowercase btn btn-default btn-icon btn-rounded  mt-5">
                                                                @if(empty($conjoint))
                                                                    <i class="icon-plus-circle2"></i>&nbsp;Ajouter
                                                                @else
                                                                    <i class="icon-minus-circle2"></i>&nbsp;Supprimer
                                                                @endif
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="page-header-content pb-20 pt-20"
                                                     @if(!$conjoint) style="display: none; @endif"
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
                                                                        @if($conjoint)
                                                                            <option @if($conjoint->civilite->id == $civilite->id) selected
                                                                                    @endif value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                        @else
                                                                            <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                        @endif
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
                                                                       class="mt-m15 form-control"
                                                                       value="@if(!empty($conjoint)) {{$conjoint->nom}} @endif">
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
                                                                       id="conjoint_prenom" class="mt-m15 form-control"
                                                                       value="@if(!empty($conjoint)) {{$conjoint->prenom}} @endif">
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
                                                                <input type="date" name="conjoint_date_naissance"
                                                                       id="conjoint_date_naissance"
                                                                       class="mt-m15 form-control"
                                                                       @if(!empty($conjoint))
                                                                       value="{{$conjoint->date_naissance}}">
                                                                @endif
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
                                                                        @if(!empty($conjoint))
                                                                            {{$conjoint->date_naissance}}
                                                                            <option @if($conjoint->regime->id == $regime->id) selected
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
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
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

                                                        <div class="col-md-6">
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold"> N° Sécurité
                                                                    sociale </label>
                                                                <input type="text" data-mask="9-99-99-99-999-999-99"
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


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">N° Affiliation
                                                                    : </label>
                                                                <input data-mask="999-999-999" type="text"
                                                                       name="conjoint_numero_affiliation"
                                                                       id="conjoint_numero_affiliation"
                                                                       class="mt-m15 form-control"
                                                                       value="@if(!empty($conjoint)) {{$conjoint->numero_affiliation}} @endif">
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
                                    <input type="hidden" value="{{$fiche->personne->details->id}}" name="details_id">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->adresse}}">
                                                                <span class="text-danger error-msg" id="error_adresse">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    N° Apt / Etage
                                                                </label>
                                                                <input type="text" name="numero_appartement_etage"
                                                                       id="numero_appartement_etage"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->numero_appartement_etage}}">
                                                                <span class="text-danger error-msg"
                                                                      id="error_numero_appartement_etage">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    Rés, Bat, Imm
                                                                </label>
                                                                <input type="text" name="residence_immeuble_batiment"
                                                                       id="residence_immeuble_batiment"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->residence_immeuble_batiment}}">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->numero}}">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->avenue_rue}}">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->code_postal}}">
                                                                <span class="text-danger error-msg"
                                                                      id="error_code_postal">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">Ville</label>
                                                                <input type="text" name="ville" id="ville"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->ville}}">
                                                                <span class="text-danger error-msg" id="error_ville">
                                                                      <strong class="text-danger"></strong>
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
                                                                <input type="email" name="email" id="email"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->email}}">
                                                                <span class="text-danger error-msg" id="error_email">
                                                                      <strong class="text-danger"></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="text-custom-grey text-bold">
                                                                    Téléphone 1 </label>
                                                                <input data-mask="+33 9-99-99-99-99" type="text"
                                                                       name="telephone_1" id="telephone_1"
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->telephone_1}}">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->telephone_2}}">
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
                                                                       class="mt-m15 form-control"
                                                                       value="{{$fiche->personne->details->telephone_3}}">
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

                            <div class="col-lg-3" id="fiche_historique">
                                <div class="panel panel-flat rounded0 p-10 border-top-lg border-top-primary">
                                    <select class="select   form-control form-control-sm" name="etat_id"
                                            id="etat_id">
                                        @php
                                            {{
                                               $user = \App\User::findOrFail(\Illuminate\Support\Facades\Auth::user()->id);
                                               $userGroupeEtats = $user->role->etat_groupe;
                                               foreach($userGroupeEtats as $userGroupeEtat) {
                                                       if(sizeof($userGroupeEtat->groupe_etat->fiche_etats)>0){
                                                       $listEtats = $userGroupeEtat->groupe_etat->fiche_etats;
                                                       $optionsHtml = '';
                                                           foreach($listEtats as $etat){
                                                           if($fiche->etat_id == $etat->id){
                                                           $optionsHtml.='<option selected value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           }else{
                                                              //$optionsHtml.='<option selected value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           $optionsHtml.='<option  value="'.$etat->id.'">'.$etat->libelle.'</option>';
                                                           }
                                                           //$etatsHtml.='<li><a href="'.url("fiches/etat"). '/' . $etat->id .'"><span><span class="badge bg-teal-400 pull-right">'.$etat->countFiches($etat->id).'</span> </span>'.$etat->libelle.'</a></li>';
                                                           }
                                                           echo '<optgroup label="'.$userGroupeEtat->groupe_etat->valeur.'">
                                                                                   '.$optionsHtml.'
                                                                 </optgroup>';
                                                       }
                                               }
                                            }}
                                        @endphp
                                    </select>
                                    <div class="form-group mt-15 mb0">
                                        <input type="checkbox" @if(!is_null($fiche->date_rappel)) checked
                                               @endif value="0" name="has_date_rappel" id="has_date_rappel"
                                               class="mt-5">
                                        &nbsp;
                                        <label for="date_rappel" class="text-custom-grey text-bold mt-m12">
                                            Date Rappel
                                        </label>
                                        <div id="date_rappel_div"
                                             class="@if(is_null($fiche->date_rappel)) custom-hidden @endif">
                                            <input type="datetime-local" name="date_rappel" id="date_rappel"
                                                   class="mt-m15 form-control"
                                                   value="{{date('Y-m-d\TH:i',strtotime(str_replace('-','/',$fiche->date_rappel)))}}">
                                            <span class="text-danger error-msg" id="error_date_rappel">
                                            <strong class="text-danger"></strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-flat border-top-lg border-top-primary">
                                    <div class="breadcrumb-line ">
                                        <span class=" breadcrumb text-bold"><i
                                                    class="icon-file-empty2 position-left"></i>Fiche Historique</span>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                                <!--<li><a class="close-fiche-historique"><i class="icon-cross"></i></a></li>-->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body p-10" id="fiche_historique_body">
                                        @foreach($fiche->historique as $historique)
                                            @if(empty($historique->description))
                                                <ul class="media-list">
                                                    <li class="media">
                                                        <div class="media-left pr-5"><a href="#"
                                                                                        class="btn border-primary text-primary btn-flat btn-icon btn-sm"><i
                                                                        class="icon-file-text3"></i></a></div>
                                                        <div class="media-body">
                                                            <a href="#">{{ $historique->action->action }}</a>
                                                            <div class="text-size-base media-annotation ">{{ $historique->created_at->format('d/m/Y H:i') . ' ' . $historique->user->prenom . " " . $historique->user->nom }}</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @else
                                                <ul class="media-list chat-list">
                                                    <li class="media">
                                                        <div class="media-left">
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="media-content media-content-1 bg-blue-400 ">{{ $historique->description }}
                                                            </div>
                                                            <span class="media-annotation display-block">{{ $historique->created_at->format('d/m/Y H:i') . ' ' . $historique->user->prenom . " " . $historique->user->nom }}</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            @endif
                                        <!--<li class="media reversed">
                                                        <div class="media-body">
                                                            <div class="media-content">Satisfactorily strenuously while
                                                                sleazily
                                                            </div>
                                                            <span class="media-annotation display-block mt-10">2 hours ago</span>
                                                        </div>

                                                        <div class="media-right">

                                                        </div>
                                            </li>-->
                                        @endforeach

                                    </div>
                                    <div class="panel-body p-10">
                                        <textarea placeholder="Commentaire" class="form-control" name="commentaire"
                                                  id="commentaire"></textarea>
                                    </div>
                                </div>

                                <button type="button" class="btn-block update_fiche btn btn-primary btn-xs rounded0"><b><i
                                                class="icon-database-refresh"></i></b>&nbsp;&nbsp;&nbsp;Enregistrer
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
                                                <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle">
                                                        <i class="icon-menu-open"></i></a>
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
                                                                @php
                                                                    {{
                                                                    $count_enfants = 0 ;
                                                                    $enfants_prospect = $fiche->personne->enfants();
                                                                        if(!empty($conjoint)){
                                                                          $enfants_conjoint = $conjoint->enfants();
                                                                        }
                                                                    }}
                                                                @endphp
                                                                @include('includes.fiche-includes.tr-enfant', ['enfants' => $enfants_prospect,'ayant_droit'=>'prospect'])
                                                                @if(!empty($conjoint))
                                                                    @include('includes.fiche-includes.tr-enfant', ['enfants' => $enfants_conjoint,'ayant_droit'=>'conjoint','conjoint'=>'true'])
                                                                @endif
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
                            @php
                                {{global $count_enfants;}}
                            @endphp
                            <input type="hidden" name="count_enfants" id="count_enfants" value="{{$count_enfants}}">
                        </div>
                        <!-- /section Enfants-->
                    </form>

                    <!-- section tarificateur -->
                    <div class="col-md-12 bg-grey-700">
                        <div class="col-md-12">
                            <div class="panel panel-flat border-top-lg border-top-primary">
                                <div class="breadcrumb-line bg-light">
                                        <span class=" breadcrumb text-bold"><i
                                                    class="icon-coins text-size-large position-left"></i>Tarificateur</span>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li class="float-right"><a data-action="collapse"></a></li>

                                            <ul class="breadcrumb-elements float-left">
                                                <li>
                                                    <button id="setTarifValues" type="button" class="btn rounded0 btn-info btn-xs mt-m9"><b><i
                                                        class="icon-coin-euro "></i></b>Tarificateur
                                                    </button>
                                                </li>
                                            </ul>

                                            <!--
                                            <li><a data-action="reload"></a></li>
                                            <li><a class="close-fiche-historique"><i class="icon-cross"></i></a>
                                            </li>
                                            -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body p-10">

                                    <div class="col-md-12">
                                        @php
                                            {{
                                               $types_assurance = \App\Type_assurance::all();
                                               $user_id = \Illuminate\Support\Facades\Auth::user()->id;
                                               $user_assurance_permissions = new \App\User_type_assurance();
                                               $user_assurance_permissions->get_user_type_assurance();
                                               $user_types_assurance_array = $user_assurance_permissions->get_user_type_assurance();//array
                                               $user_types_assurance = \Illuminate\Support\Facades\Auth::user()->user_type_assurance;
                                               $compagniesIds = [];
                                               $formulesIds = [];
                                            }}
                                        @endphp

                                        <div class="tabbable">
                                            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                               <?php $i = 1;?>
                                                @foreach($types_assurance as $type_assurance)
                                                    <li @if($i==1) class="active" @endif>
                                                        <a href="#highlighted-justified-tab{{$i}}"
                                                           data-toggle="tab">{{$type_assurance->nom}}</a>
                                                    </li>
                                                  <?php $i++?>
                                                @endforeach
                                            </ul>

                                            <div class="tab-content" id="treeview-checkbox-demo">
                                               <?php $i = 1?>
                                                @foreach($types_assurance as $type_assurance)
                                                    <div class="tab-pane @if($i==1) active @endif"
                                                         id="highlighted-justified-tab{{$i}}">
                                                       <?php
                                                       if(in_array($type_assurance->id, $user_types_assurance_array)) {
                                                          echo '<ul>';
                                                          $gammes = $type_assurance->gammes;
                                                          foreach($gammes as $gamme) {
                                                             $formules = $gamme->formules;
                                                             if(sizeof($gamme->formules) != 0) {

                                                                if(!in_array($gamme->compagnie_id, $compagniesIds)) {
                                                                   // ---- echo '<ul>';
                                                                   echo '<li>' . $gamme->compagnie->nom . '<ul>';
                                                                }

                                                                echo '<li>' . $gamme->nom . '<ul>';
                                                                foreach($formules as $formule) {
                                                                   echo '<li data-value="' . $formule->id . '">' . $formule->nom . '</li>';
                                                                   array_push($formulesIds, $formule->id);
                                                                }
                                                                echo '</ul></li>';

                                                                if(!in_array($gamme->compagnie_id, $compagniesIds)) {
                                                                   array_push($compagniesIds, $gamme->compagnie_id);
                                                                   echo '</ul></li>';
                                                                }
                                                             }
                                                          }
                                                          echo '</ul>';
                                                       } else {
                                                          echo "<br><span class='p-10 text-size-large'>vous n'êtes pas autorisé à cette option</span><br><br>";
                                                       }
                                                       ?>

                                                    </div>
                                                  <?php $i++?>
                                                @endforeach
                                            </div>
                                        </div>


                                        <input type="text" name="getTarifValues" id="getTarifValues">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /section tarificateur-->

                    <!--script tarificateur -->
                    <script>


                    </script>
                    <!--script /tarificateur-->

                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a
                                href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                    </div>
                    <!-- /footer -->
                </div>
                <!-- /content area -->
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->
    @include('includes.tarificateur.tarificateur-modal')
@endsection