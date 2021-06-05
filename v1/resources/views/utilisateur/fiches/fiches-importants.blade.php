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
                                <span class="text-semibold">Gestion des fiches (haute priorité) </span>
                            </h4>
                        </div>
                        @include('includes.utilisateur-page-header')
                    </div>

                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left"></i> Accueil
                                </a></li>
                            <li class="active">fiches haute priorité</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li>
                                <input type="search" class="form-control" placeholder="N° Télephone">
                            </li>
                            <li>
                                <a href="#"><i class="icon-phone2 position-left"></i>Appeler</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-alarm position-left"></i> Rappels <span class="caret"></span>
                                </a>
                                @php
                                    $ef = new \App\Fiche_etat();
                                @endphp
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{url('/fiches/etat/21/-1')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,-1)}}</span> </span>
                                            Rappels en retard
                                        </a>
                                    </li>
                                    <li><a href="{{url('/fiches/etat/21/0')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,0)}}</span> </span>
                                            Rapples
                                            du jour</a></li>
                                    <li><a href="{{url('/fiches/etat/21/1')}}">
                                            <span><span class="badge bg-teal-400 pull-right">{{$ef->count(21,1)}}</span> </span>
                                            Rappeles programmés</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{url('/fiches/etat/21')}}">
                                            Tout Les Rappels</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content p0">
                    <div class="col-md-12">
                        <!--section liste des fiches-->
                        <div class="col-lg-12" id="fiches-div">
                            <div class="row">
                                <div class="panel panel-flat">
                                    <div class="datatable-header">

                                        <div class="input-group col-md-4">
                                            <input type="text" id="search-text" class="form-control"
                                                   placeholder="Rechercher">
                                            <span class="input-group-btn">
													<button id="search-btn" class="btn btn-primary btn-sm rounded0"
                                                            type="button">
                                                        Trouverr
                                                    </button>
											</span>
                                        </div>

                                        <div class="dataTables_length" id="fiches_length"><label><span>Afficher:</span>
                                                <select name="fiches_length" aria-controls="fiches" class="">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select></label></div>
                                    </div>
                                    <div>
                                        <table id="fiches" class="table table-hover table-striped" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Prospect</th>
                                                <th>Adresse</th>
                                                <th>Contact</th>
                                                <th>Etat</th>
                                                <!--<th class="hidden">Note</th>-->
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody id="table-fiches-body">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--/section liste des fiches-->
                    </div>
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

    <script type="text/javascript">


        $(document).ready(function () {

            function getFichesData(count) {
                $.ajax({
                    url: app_url + "fiches-haute-priorite-ajax-data/" + count,
                    type: "GET",
                    data: {'_token': _token},
                    cache: false,
                    success: function (data) {
                        if (data) {
                            var tableFichesBody = $('#table-fiches-body');
                            //tableFichesBody.html('');
                            tableFichesBody.append(data);
                        }
                    },
                    error: function () {
                        alert('Une erreur est survenue dans le script de cette page !')
                    }
                });
            }

            var PER_PAGE = 0;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                    PER_PAGE += 10;
                    getFichesData(PER_PAGE);
                }
            });
            getFichesData(PER_PAGE);






            $("#search-btn").on('click', function () {
                getFichesData('false', {input: "search-text"});
            });

            $('#search-text').keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    getFichesData('false', {input: "search-text"});
                }
            });
            $('#search-text-all').keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    getFichesData('true', {input: "search-text-all"});
                }
            });
        });
    </script>
@endsection



