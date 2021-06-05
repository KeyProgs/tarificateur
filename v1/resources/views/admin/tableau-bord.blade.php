@extends('layouts.utilisateur')
<?php  use App\Http\Controllers\AdminController;?>
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

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">tableau de bord</li>
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
                <div class="content">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-body rounded0">
                                <div class="media no-margin">
                                    <div class="media-body">
                                        <b class="no-margin text-semibold text-uppercase">fiches</b>
                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Total
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{$data['countFiches']}}
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Mauvaise
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{$data['countFichesMauvaise']}}
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="no-margin text-bold">
                                                Net
                                            </p>
                                            <p style="float: right" class="no-margin text-bold">
                                                {{$data['countFiches'] - $data['countFichesMauvaise']}}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-file-empty icon-3x text-indigo-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-body rounded0">
                                <div class="media no-margin">
                                    <div class="media-body">
                                        <b class="no-margin text-semibold text-uppercase">Contrats</b>
                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Total
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{$data['countDevis']}}
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Chute
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{$data['countDevisChute'] }}
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="no-margin text-bold">
                                                Net
                                            </p>
                                            <p style="float: right" class="no-margin text-bold">
                                                {{$data['countDevis'] -$data['countDevisChute'] }}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-file-check icon-3x text-indigo-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-body rounded0">
                                <div class="media no-margin">
                                    <div class="media-body">
                                        <b class="no-margin text-semibold text-uppercase">chiffre d'affaire</b>
                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Total
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{number_format($data['chiffreAffaireDevis'],2)}}€
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Chute
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{number_format($data['chiffreAffaireDevisChute'],2) }}€
                                            </p>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="no-margin text-bold">
                                                Net
                                            </p>
                                            <p style="float: right" class="no-margin text-bold">
                                                {{number_format($data['chiffreAffaireDevis']-$data['chiffreAffaireDevisChute'],2) }}
                                                €
                                            </p>
                                        </div>

                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-coin-euro icon-3x text-indigo-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="panel panel-body rounded0">
                                <div class="media no-margin">
                                    <div class="media-body">
                                        <b class="no-margin text-semibold text-uppercase">ratios</b>
                                        <br>
                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="text-bold no-margin">
                                                Total
                                            </p>
                                            <p style="float: right" class="no-margin">
                                                {{number_format($data['brute'],2)}}%
                                            </p>
                                        </div>
                                        <br><br>
                                        <div class="col-md-12 no-padding">
                                            <p style="float: left" class="no-margin text-bold">
                                                Net
                                            </p>
                                            <p style="float: right" class="no-margin text-bold">
                                                {{number_format($data['net'],2)}}%
                                            </p>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="media-right media-middle">
                                        <i class="icon-stats-growth icon-3x text-indigo-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('includes.admin.tableaudetaille')

                    <!-- /main content -->
                </div>
                <!-- /page content -->
            </div>
            <!-- /page container -->
@endsection



