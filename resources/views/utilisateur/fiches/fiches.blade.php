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


                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <a href="{{url('/fiches/etat/1')}}"><i class="icon-home2 position-left" style="font-size: 15px;"></i> Accueil
                                </a></li>
                            <li class="active">{{$etat->libelle}}</li>
                        </ul>

                        <ul class="breadcrumb-elements">
                            <li>
                                <input type="search" class="form-control" placeholder="N° Télephone">
                            </li>
                            <li>
                                <a href="#" style="     "><i class="icon-phone2 position-left" ></i>Appeler</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #065809; font-weight: bold;" >
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
                                <div class="panel panel-flat" style="background-color: #f1F1e8;">
                                    <div class="datatable-header">

                                        <div class="input-group col-md-4">
                                            <input type="text" id="search-text" class="form-control"
                                                   placeholder="Rechercher">
                                            <span class="input-group-btn">
													<button id="search-btn" class="btn btn-primary btn-sm rounded0"
                                                            type="button">
                                                        Trouver
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
                                    <div id="table-fiches-body">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--/section liste des fiches-->

                        <!-- Section fiche historique -->
                        <div class="col-lg-3" id="fiche_historique"  style="position: fixed; right: 0%; width: 20%; top: 20%;">

                        </div>
                        <!-- /section fiche historique -->
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
        var ALLETAT='false';

        function getFichesData(alletat, data) {
            ALLETAT=alletat;
           // alert(alletat);
            var input1 = $('#'+data['input']).val();
            //alert(input1);
            $.ajax({
                url: app_url + "/table-fiches-etat/{{$etat->id}}/{{$rappel}}?alletat=" + alletat,
                type: "GET",
                data: {'_token': _token, 'etat_id':{{$etat->id}}, 'input1': input1, 'alletat': alletat},
                cache: false,
                success: function (data) {
                    if (data) {
                        var tableFichesBody = $('#table-fiches-body');
                        tableFichesBody.html('');
                        tableFichesBody.append(data);
                    }
                },
                error: function () {
                    alert(' Une erreur est survenue dans le script de cette page !')

                }
            });
        }

        $(document).ready(function () {
            //var btn-data = $('#search-btn').val();

            getFichesData('false', {input:"search-text"});
            //onclick pagination link append data

            $('#fiches-div').on('click', '.page-link', function () {
                if ($(this).attr("href")) {
                    var baseUrl = $(this).attr('href');
                    baseUrl = baseUrl.replace("//table", "/table");
                    var input1 = $('#search-text').val();
                    $.ajax({
                        url: baseUrl,
                        type: "GET",
                        data: {'_token': _token, 'etat_id':{{$etat->id}}, 'input1': input1, 'alletat': ALLETAT},
                        cache: false,
                        success: function (data) {
                            if (data) {
                                var tableFichesBody = $('#table-fiches-body');
                                tableFichesBody.html('');
                                tableFichesBody.append(data);
                            }
                        },
                        error: function () {
                            alert(' Une erreur est survenue dans le script de cette page !')
                        }
                    });
                    return false;
                }
            });


            $("#search-btn").on('click', function () {
                getFichesData('false', {input:"search-text"});
            });

            $('#search-text').keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    getFichesData('false', {input:"search-text"});
                }
            });
            $('#search-text-all').keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    getFichesData('true', {input:"search-text-all"});
                }
            });
        });
    </script>
@endsection

