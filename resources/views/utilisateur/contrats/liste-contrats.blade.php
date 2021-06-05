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
                            <li><a href="#"><i class="icon-home2 position-left"></i> Accueil
                                </a>
                            </li>
                            <li class="active">Contrats</li>
                        </ul>

                        <ul class="breadcrumb-elements hidden">
                            <li><a href="#"><i class="icon-comment-discussion position-left"></i>Support</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-gear position-left"></i> Settings <span class="caret"></span>
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
                    <div class="col-md-12">
                        <!--section liste des contrats-->

                        <div class="col-lg-12" id="fiches-div">
                            <div class="row">
                                <div class="panel panel-flat">

                                    <div class="col-md-offset-3 col-md-6 form-group">
                                        <form>
                                            <label class="col-md-2 text-bold control-label mt-15">Date Contrat</label>

                                            <div class="col-md-6">
                                                <input id="date" type="text" class="date-picker-no-day form-control"
                                                       placeholder="Choisir une date">
                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" onclick="window.location.href"
                                                        class="mt-5 btn-search-date btn-block  btn btn-primary btn-xs rounded0">
                                                    Chercher
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                    <div id="table-fiches-body">
                                        <table id="fiches" class="table table-hover table-striped" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>N° Contrat</th>
                                                <th>Conseiller</th>
                                                <th>Formule</th>
                                                <th>Prospect</th>
                                                <th>Cotisation</th>
                                                <th>Date d'envoi</th>
                                                <th>Status fiche</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/section liste des contrats-->
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
            $('.btn-search-date').on('click', function () {
                var date = $('#date').val();
                getData(date);
            });
            getData();
            function getData(date = null) {
                var ajaxUrl = "{{url('/liste-contrats-json/')}}";
                if (date != null) {
                    ajaxUrl = ajaxUrl + "/" + date;
                }
                $('#fiches').DataTable({
                    "destroy": true,
                    "ordering": false,
                    "pageLength": 10,
                    "stateSave": true,
                    "columnDefs": [
                        {
                            "defaultContent": "-",
                            "targets": "_all"
                        }
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": ajaxUrl,
                    language: {
                        search: '<span>Filtrer:</span> _INPUT_',
                        searchPlaceholder: 'Tapez pour filtrer',
                        lengthMenu: '<span>Afficher:</span> _MENU_',
                        paginate: {
                            'first': 'First',
                            'last': 'Last',
                            'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                        }
                    },
                    "columns": [
                        {data: 'numero_contrat', name: 'numero_contrat'},
                        {data: 'conseiller', name: 'conseiller'},
                        {data: 'formule', name: 'formule'},
                        {data: 'prospect', name: 'prospect'},
                        {data: 'cotisation', name: 'cotisation'},
                        {data: 'date_envoi', name: 'date_envoi'},
                        {data: 'codification', name: 'codification'},
                        {data: 'action', name: 'action'}

                    ],
                    order: [[0, 'asc']]
                });
            }
        });
    </script>
@endsection



